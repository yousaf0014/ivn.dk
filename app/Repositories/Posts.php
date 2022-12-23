<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Post;
use App\PostComment;
use App\PostLike;
use App\PostRating;
use App\NetworkPost;
use App\CommentRating;
use Auth;
use DB;
use App\User;
use App\UserNetwork;
use App\UserSubcribeBusiness;
use App\PostTag;
use App\Network;
use App\PostImage;

class Posts{	
	public function getComments($data){
		$offset = ($data['page']-2) *5 + 2;
		$postComments = \DB::table('posts')
        ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
        ->leftJoin('users as commented_user', 'commented_user.id', '=', 'post_user_comments.user_id')
        ->leftJoin('companies as company', 'company.user_id', '=', 'commented_user.id')
		->where('posts.id', $data['post'])
		->where('post_user_comments.active',1)
		->select('post_user_comments.user_id as c_user_id','post_user_comments.id as comment_id','post_user_comments.created_at as c_created_at','commented_user.id as user_id','post_user_comments.id as cid','post_user_comments.*','commented_user.*','company.*','company.name as company_name')
        ->offset($offset)
        ->orderBy('post_user_comments.id','Asc')
        ->groupBy('post_user_comments.id')
        ->limit(5)
        ->get();
        $postDataArray['postComments'] = $postComments;
        $commentIDs = array();
        foreach($postComments as $com){
        	$commentIDs[$com->cid] = $com->cid;
        }
        $postCommentsRatings = \DB::table('posts')
        ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
        ->leftJoin('comment_user_ratings', 'comment_user_ratings.post_comment_id', '=', 'post_user_comments.id')
		->where('posts.id',  $data['post'])
		->whereIn('post_user_comments.id',$commentIDs)
		->select('comment_user_ratings.post_comment_id',DB::raw('sum(comment_user_ratings.rate) as comment_ratings'))
		->groupBy('comment_user_ratings.post_comment_id','post_user_comments.post_id')
        ->get();
        $commnetRatings = array();
        foreach($postCommentsRatings as $rat){
        	$commnetRatings[$rat->post_comment_id] = $rat->comment_ratings;
        }
        $postDataArray['postCommentRatings'] = $commnetRatings;
        return $postDataArray;
	}

	public function createPost(Request $request){
		if(Auth::user()->user_type == 'business'){
			return false;
		}
		if(Auth::user()->user_type != 'admin' && empty(Auth::user())) {
			return false;
		}
		$postData = $request->all();
		$postData['details'] = str_replace('<script>', '', $postData['details']);
		$postData['details'] = str_replace('</script>', '', $postData['details']);
		$postData['details'] = str_replace('<a ', '<a trget="_blank" rel="nofollow" ', $postData['details']);
		$postData['details'] = htmlentities($postData['details']);
		$postData['type'] = 'post';
		$postData['user_id'] = Auth::user()->id;
		$postNetworks = !empty($postData['network_id']) ? $postData['network_id']:array();
		$tags = !empty($postData['tags']) ? $postData['tags']:array();
		unset($postData['network_id']);
		unset($postData['tags']);
		$destinationPath = 'uploads/Post/';
        if ($request->hasFile('image_path')) {        
            $file = $request->file('image_path');        
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);
            $postData['image_path'] = $picture;
            make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
        }
        unset($postData['_method']);unset($postData['_token']);
        $postData['user_id'] = Auth::user()->id;
		$postData['updated_at'] = $postData['created_at'] = date('Y-m-d H:i:s');
		$postData['updated_by'] = $postData['created_by'] = Auth::user()->id;
		

		$id = Post::insertGetId($postData);
		$post = new Post;
		$postObj = $post->find($id);
		foreach($postNetworks as $network){
			$networObj = Network::find($network);
			$postObj->networks()->saveMany([$networObj]);
		}

		foreach ($tags as $key => $value) {
			$tagObj = new PostTag;
			$tagObj->text = $value;
			$tagObj->user_id = Auth::user()->id;
			$postObj->postTag()->save($tagObj);
		}
		return $id;
	}

	public function canEdit(Post $post){
		if(Auth::user()->user_type == 'admin'){
			return true;
		}
		if(Auth::user()->id == $post->created_by){
			$timeLimit = "-1 day";
			$limitTimestamp = strtotime($timeLimit);
			$createdTimestamp = strtotime($post->created_at);
			if($createdTimestamp > $limitTimestamp){
				return true;
			}
		}
		return false;
	}

	public function updatePost(Request $request,Post $post){
		if(Auth::user()->user_type == 'business'){
			return false;
		}
		if(Auth::user()->user_type != 'admin' && empty(Auth::user())){
			return false;
		}
		//$networks = $post->networks()->get();
		$post->networks()->detach();
		$post->postTag()->delete();
		$data = $request->all();
		unset($data['_method']);unset($data['_token']);
		$data['details'] = str_replace('<script>', '', $data['details']);
		$data['details'] = str_replace('</script>', '', $data['details']);
		$data['details'] = str_replace('<a ', '<a trget="_blank" rel="nofollow" ', $data['details']);
		$data['details'] = htmlentities($data['details']);
        unset($data['_method']);unset($data['_token']);
        $postNetworks = array();
        if(!empty($data['network_id'])){
	        $postNetworks = $data['network_id'];
			unset($data['network_id']);
		}
		$tags = array();
		if(!empty($data['tags'])){
			$tags = $data['tags'];
			unset($data['tags']);
		}

        if ($request->hasFile('image_path')) {
            $destinationPath = 'uploads/Post/';
            $file = $request->file('image_path');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);
            $data['image_path'] = $picture;
            make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
        }
		foreach($data as $key=>$val){
			$post->$key = $val;
		}
		$post->type = 'post';
		$post->user_id = Auth::user()->id;
		$post->updated_at =  date('Y-m-d H:i:s');
		$post->updated_by = Auth::user()->id;
		if($post->save()){
			foreach($postNetworks as $network){
				$networObj = Network::find($network);
				$post->networks()->saveMany([$networObj]);
			}

			foreach($tags as $key => $value) {
				$tagObj = new PostTag;
				$tagObj->text = $value;
				$tagObj->user_id = Auth::user()->id;
				$post->postTag()->save($tagObj);
			}
			return true;
		}

		return false;
	}

	public function deletePost(Post $post,$active = 0){
		if($post->type != 'post'){
			return false;
		}
		if(Auth::user()->user_type == 'admin'){
			$post->active = $active;
		}else if(Auth::user()->id == $post->user_id){
			$post->active = 0;
		}
		if($post->save()){
			return true;
		}
		return false;
	}



	public function postNetworks(Post $post,$isList = false){
		$networks = $post->networks()->get();
		if($isList){
			$listArr = array();
			foreach($networks as $net){
				$listArr[$net->id] = $net->id;
			}
			return $listArr;
		}
		return $networks;
	}


	public function getPostTags(Post $post,$isList = false){
		$tags = $post->postTag()->get();
		if($isList){
			$listArr = array();
			foreach($tags as $tag){
				$listArr[$tag->id] = $tag->text;
			}
			return $listArr;
		}
		return $tags;
	}

	public function postRelatedData($posts){
		$postDataArray = array();		
		foreach($posts as $post){
			$postImages = \DB::table('posts')
            ->Join('post_images', 'posts.id', '=', 'post_images.post_id')
            ->where('posts.id', $post->id)
			->select('post_images.*')
			->where('posts.active',1)
            ->get();
            
            $postDataArray[$post->id]['PostImages'] = $postImages;

            $postComments = \DB::table('posts')
            ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
            ->leftJoin('users as commented_user', 'commented_user.id', '=', 'post_user_comments.user_id')
            ->leftJoin('companies as company', 'company.user_id', '=', 'commented_user.id')
			->where('posts.id', $post->id)
			->where('post_user_comments.active',1)
			->groupBy('post_user_comments.id')
			->select('post_user_comments.user_id as c_user_id','post_user_comments.id as comment_id','post_user_comments.created_at as c_created_at','commented_user.id as user_id','post_user_comments.id as cid','post_user_comments.*','commented_user.*','company.*','company.name as company_name')
            ->get();
            $postDataArray[$post->id]['comment_count'] = !empty($postComments) ? $postComments->count():array();


            $postComments = \DB::table('posts')
            ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
            ->leftJoin('users as commented_user', 'commented_user.id', '=', 'post_user_comments.user_id')
            ->leftJoin('companies as company', 'company.user_id', '=', 'commented_user.id')
			->where('posts.id', $post->id)
			->where('post_user_comments.active',1)
			->groupBy('post_user_comments.id')
			->select('post_user_comments.user_id as c_user_id','post_user_comments.id as comment_id','post_user_comments.created_at as c_created_at','commented_user.id as user_id','post_user_comments.id as cid','post_user_comments.*','commented_user.*','company.*','company.name as company_name')
            ->orderBy('post_user_comments.id','ASC')
            ->limit(2)
            ->get();
            $postDataArray[$post->id]['postComments'] = $postComments;
            $commentIDs = array();
            foreach($postComments as $com){
            	$commentIDs[$com->cid] = $com->cid;
            }
            $postCommentsRatings = \DB::table('posts')
            ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
            ->leftJoin('comment_user_ratings', 'comment_user_ratings.post_comment_id', '=', 'post_user_comments.id')
			->where('posts.id', $post->id)
			->whereIn('post_user_comments.id',$commentIDs)
			->select('comment_user_ratings.post_comment_id',DB::raw('sum(comment_user_ratings.rate) as comment_ratings'))
			->groupBy('comment_user_ratings.post_comment_id','post_user_comments.post_id')
            ->get();
            $commnetRatings = array();
            foreach($postCommentsRatings as $rat){
            	$commnetRatings[$rat->post_comment_id] = $rat->comment_ratings;
            }
            $postDataArray[$post->id]['postCommentRatings'] = $commnetRatings;
            

            $postlike = \DB::table('posts')
            ->leftJoin('post_user_likes', 'posts.id', '=', 'post_user_likes.post_id')
            ->leftJoin('users as like_user', 'like_user.id', '=', 'post_user_likes.user_id')
			->where('posts.id', $post->id)
			->select('post_user_likes.*','like_user.*')
            ->get();
            $postDataArray[$post->id]['postlike'] = $postlike;

			$postRatings = \DB::table('post_user_ratings')
            ->where('post_user_ratings.post_id', $post->id)
			->select('post_user_ratings.post_id',DB::raw("sum(rate) as post_rate"))
			->groupBy('post_user_ratings.post_id')
            ->get();
            $postDataArray[$post->id]['postRatings'] = $postRatings;            

            $postTags = \DB::table('posts')
            ->leftJoin('post_user_tags', 'posts.id', '=', 'post_user_tags.post_id')
            ->leftJoin('users as tag_user', 'tag_user.id', '=', 'post_user_tags.user_id')
            ->where('posts.id', $post->id)
			->select('post_user_tags.*','tag_user.*')
            ->get();
            $postDataArray[$post->id]['postTags'] = $postTags;
            $post = Post::find($post->id);
            $postDataArray[$post->id]['createdBY'] = $post->createdBy()->get();
            $postDataArray[$post->id]['networks'] = $post->networks()->with('category')->get();
            $postDataArray[$post->id]['company'] = $post->user()->with('companies')->where('active',1)->first();
            //dd($postDataArray);
		}
		$postDataArray['Post'] = $posts;
		return $postDataArray;
	}
	public function getPostList(){
		$post = new Post();
		if(Auth::user()->user_type  == 'admin'){
	        if(isset($request->keyword)){
	            $post = $post->Where('title', 'like', '%'.$keyword.'%');
	        }
	        if(isset($request->active) && $request->active != -1){
	            $post = $post->Where('active', $request->active);
	        }
	    }else{
			$post = $post->where('active',1);
			$networkList = Auth::user()->userNetworks()->pluck('network_id')->toArray();
			if(!empty($networkList)){
				$post = $post->where('network_id',$networkList);
			}
		}
		$post = $post->where('type','post');
		
		$posts = $post->paginate(20);
		$postDataArray = $this->postRelatedData($posts);
		return $postDataArray;
	}

	function getStickyPost(){
		$postID = 173;
		$post = new Post;
		$postData = $post->find(173);
		return $this->getPostData($postData);
	}

	function getPostData(Post $post){
		$postDataArray = array();
		$postImages = \DB::table('posts')
            ->Join('post_images', 'posts.id', '=', 'post_images.post_id')
            ->where('posts.id', $post->id)
			->select('post_images.*')
            ->get();
            
            $postDataArray['PostImages'] = $postImages;

            $postComments = \DB::table('posts')
            ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
            ->leftJoin('users as commented_user', 'commented_user.id', '=', 'post_user_comments.user_id')
            ->leftJoin('companies as company', 'company.user_id', '=', 'commented_user.id')
			->orderBy('post_user_comments.id','ASC')
			->where('posts.id', $post->id)
			->where('post_user_comments.active',1)
			->groupBy('post_user_comments.id')
			->select('post_user_comments.user_id as c_user_id','post_user_comments.id as comment_id','post_user_comments.created_at as c_created_at','commented_user.id as user_id','post_user_comments.id as cid','post_user_comments.*','commented_user.*','company.*','company.name as company_name')
            ->get();
            $postDataArray['comment_count'] = !empty($postComments) ? $postComments->count():array();

            $postComments = \DB::table('posts')
            ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
            ->leftJoin('users as commented_user', 'commented_user.id', '=', 'post_user_comments.user_id')
            ->leftJoin('companies as company', 'company.user_id', '=', 'commented_user.id')
            ->where('posts.id', $post->id)
            ->where('post_user_comments.active',1)
            ->groupBy('post_user_comments.id')
			->select('post_user_comments.user_id as c_user_id','post_user_comments.id as comment_id','post_user_comments.created_at as c_created_at','commented_user.id as user_id','post_user_comments.id as cid','post_user_comments.*','commented_user.*','company.*','company.name as company_name')
			->limit(2)
			->get();
            $postDataArray['postComments'] = $postComments;        

            $postCommentsRatings = \DB::table('posts')
            ->leftJoin('post_user_comments', 'posts.id', '=', 'post_user_comments.post_id')
            ->leftJoin('comment_user_ratings', 'comment_user_ratings.post_comment_id', '=', 'post_user_comments.id')
			->where('posts.id', $post->id)
			->select('comment_user_ratings.post_comment_id',DB::raw('sum(comment_user_ratings.rate) as comment_ratings'))
			->groupBy('comment_user_ratings.post_comment_id','post_user_comments.post_id')
            ->get();
            $commnetRatings = array();
            foreach($postCommentsRatings as $rat){
            	$commnetRatings[$rat->post_comment_id] = $rat->comment_ratings;
            }
            $postDataArray['postCommentRatings'] = $commnetRatings;
            
            $postlike = \DB::table('posts')
            ->leftJoin('post_user_likes', 'posts.id', '=', 'post_user_likes.post_id')
            ->leftJoin('users as like_user', 'like_user.id', '=', 'post_user_likes.user_id')
			->where('posts.id', $post->id)
			->select('post_user_likes.*','like_user.*')
            ->get();
            $postDataArray['postlike'] = $postlike;

			$postRatings = \DB::table('posts')
            ->leftJoin('post_user_ratings', 'posts.id', '=', 'post_user_ratings.post_id')
            ->where('posts.id', $post->id)
			->select(DB::raw('sum(post_user_ratings.rate) as user_ratings'))
			->groupBy('post_id')
            ->get();
            $postDataArray['postRatings'] = $postRatings;            

            $postTags = \DB::table('posts')
            ->leftJoin('post_user_tags', 'posts.id', '=', 'post_user_tags.post_id')
            ->leftJoin('users as tag_user', 'tag_user.id', '=', 'post_user_tags.user_id')
            ->where('posts.id', $post->id)
			->select('post_user_tags.*','tag_user.*')
            ->get();
            $postDataArray['postTags'] = $postTags;
            $postDataArray['networks'] = $post->networks()->with('category')->get();
            $createdBY = $post->createdBy()->get();
            $postDataArray['createdBY'] = $createdBY;
            $postDataArray['company'] = $post->user()->with('companies')->where('active',1)->first();
            $postDataArray['post'] = $post;
            return $postDataArray;
	}

	public function saveRate(Request $request){
		$data = $request->all();
		$rateObj = new PostRating;
		$post = Post::find($data['post']);
		$rate = $rateObj->where('user_id',Auth::user()->id)->where('post_id',$data['post'])->first();
		if(!empty($rate)){
			if($rate->rate == -1 && $data['rate'] == 1 || $rate->rate == 1 && $data['rate'] == -1){
				$rate->rate = $data['rate'] + $rate->rate;
			}else{
				$rate->rate = $data['rate'];
			}
			
			$rate->user_id = Auth::user()->id;
			$rate->post_id = $data['post'];
			if($rate->save()){
				$outArr = array('rate'=>$this->getPostRate($post),'flag'=>true);
				$this->autodeactivepost($post);
				return $outArr;	
			}
		}else{
			$rateObj->rate = $data['rate'];
			$rateObj->user_id = Auth::user()->id;
			if($post->postRating()->save($rateObj)){
				$outArr = array('rate'=>$this->getPostRate($post),'flag'=>true);
				$this->autodeactivepost($post);
				return $outArr;	
			}
		}
		return false;
	}

	public function getPostRate(Post $post){
		$data = $post->postRating()->get();
		$rate = 0;
		foreach($data as $rateD){
			$rate += $rateD->rate;
		}
		return $rate;
	}

	public function canAddEditComment($comment){
		if(Auth::user()->user_type == 'admin'){
			return true;
		}
		if(empty($comment)){
			return true;
		}
		$comment = PostComment::find($comment);
		if($comment->user_id == Auth::user()->id){
			return true;
		}
		return false;
	}

	public function getComment($comment){
		return PostComment::find($comment);
	}

	public function storeComment(Request $request,Post $post,$comment){
		$data = $request->all();
		$commentObj = new PostComment;
		$destinationPath = 'uploads/Comment/';
		if(!empty($comment)){
			$commentObj = $commentObj->find($comment);
			$commentObj->comment = $data['comment'];
			$commentObj->user_id = Auth::user()->id;
			if ($request->hasFile('image_path')) {
	            $file = $request->file('image_path');
	            $filename = $file->getClientOriginalName();
	            $extension = $file->getClientOriginalExtension();
	            $picture = date('His-').$filename;
	            $file->move($destinationPath, $picture);
	            make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
	            $commentObj->image_path = $picture;
	            $commentObj->updated_at = date('Y-m-d H:i:s');
	            $commentObj->updated_by = Auth::user()->id;
	        }
			if($commentObj->save()){
				return $commentObj->id;	
			}
		}else{
			$commentObj->comment = $data['comment'];
			$commentObj->user_id = Auth::user()->id;
			if ($request->hasFile('image_path')) {
	            $file = $request->file('image_path');
	            $filename = $file->getClientOriginalName();
	            $extension = $file->getClientOriginalExtension();
	            $picture = date('His-').$filename;
	            $file->move($destinationPath, $picture);
	            $commentObj->image_path = $picture;
	            $commentObj->created_at =  $commentObj->updated_at = date('Y-m-d H:i:s');
	            $commentObj->created_by =  $commentObj->updated_by = Auth::user()->id;
	        }
	        $comment = $post->postComment()->save($commentObj);
			if($comment){
				return $comment->id;
			}
		}
		return false;
	}


	public function deleteCommnet(PostComment $comment,$active = 0){
		if(Auth::user()->user_type == 'admin'){
			$comment->active = $active;
		}else if(Auth::user()->id == $comment->user_id){
			$comment->active = 0;
		}
		if($comment->save()){
			return true;
		}
		return false;
	}


	public function saveRateComment(Request $request){
		$data = $request->all();
		$commentRateObj = new CommentRating;
		$commentObj = PostComment::find($data['comment']);
		$rate = $commentRateObj->where('user_id',Auth::user()->id)->where('post_comment_id',$data['comment'])->first();
		if(!empty($rate)){
			if($rate->rate == -1 && $data['rate'] == 1 || $rate->rate == 1 && $data['rate'] == -1){
				$rate->rate = $data['rate'] + $rate->rate;
			}else{
				$rate->rate = $data['rate'];
			}
			
			$rate->user_id = Auth::user()->id;
			$rate->post_comment_id = $data['comment'];
			if($rate->save()){
				$outArr = array('rate'=>$this->ratecomment($commentObj),'flag'=>true);
				return $outArr;	
			}
		}else{
			$commentRateObj->rate = $data['rate'];
			$commentRateObj->user_id = Auth::user()->id;
			if($commentObj->commentRatings()->save($commentRateObj)){
				$outArr = array('rate'=>$this->ratecomment($commentObj),'flag'=>true);
				return $outArr;	
			}
		}
		return false;
	}

	public function ratecomment(PostComment $comment){
		$data = $comment->commentRatings()->get();
		$rate = 0;
		foreach($data as $rateD){
			$rate += $rateD->rate;
		}
		return $rate;
	}

	public function getLatestNews(){
		$userObj = new User;
		$adminData = $userObj->where('user_type','admin')->get();
		$adminArr = array();
		foreach($adminData as $admin){
			$adminArr[$admin->id] = $admin->id;
		}
		$postObj = new Post;
		$posts = $postObj->whereIn('user_id',$adminArr)->where('is_news',1)->limit(2)->orderBy('id', 'DESC')->get(); 
		return $posts;
	}

	public function getNonSubscribedNetwork(Request $request,$page,$rendom = false,$mobile = false){
		$userNetworkArray = array();
		$network = new Network;
		$recordCount = $mobile == true ? 2:6;
		if(!empty(Auth::user()->id)){
			$userId = Auth::user()->id;
			$userNetworkData = UserNetwork::where('user_id',$userId)->get();
			foreach($userNetworkData as $networkD){
				$userNetworkArray[$networkD->network_id] = $networkD->network_id;
			}

			$network1 = $network->whereNotIn('id',$userNetworkArray)->where('active',1)->get();
			if($rendom == true || $page == 0 || $page == 1 ){ /// If page id is 1 means page refresh or page navigated to some other page, So need to reset All Ids
				$request->session()->pull('network_ids',array());
			}
			$networkIDs = $this->randomNumbers($request,$recordCount,$network1,'network',$page);			
			$network = $network->whereIn('id',$networkIDs);
		}else{
			$userNetworkData = Network::where('active',1)->get();
			$networkIDs = $this->randomNumbers($request,$recordCount,$userNetworkData,'network',$page);			
			$network = $network->whereIn('id',$networkIDs);
		}
		$networks = $network->get();		
		return $networks; 
	}

	public function getOtherNetworks(Network $network,$page,$mobile = false){
		$recordCount = $mobile == true ? 2:6;
		return $network->where('id', '!=', $network->id)->where('active',1)->orderBy('id','desc')->paginate($mobile,['*'], 'page', $page);			
	}

	public function randomNumbers(Request $request,$itmesNeededCount,$idData,$type,$page){
		$alreadyUsed = array();
		if(!($page== 0 || $page== 1)){
			$alreadyUsed = $request->session()->pull($type.'_ids',array());
		}
		$idsArr = array();
		$count = 0;
		foreach($idData as $data){
			if(!isset($alreadyUsed[$data->id])){
				$idsArr[$count++] = $data->id;
			}
		}

		$selectedIDs = array();
		$selectCount = $itmesNeededCount < $count ? $itmesNeededCount:$count;
		$randMax = ($itmesNeededCount > $count ? $itmesNeededCount:$count) - 1;
		if(empty($idsArr)){
			return array();
		}else if($itmesNeededCount > count($idsArr)){
			foreach($idsArr as $selected){
				$alreadyUsed[$selected] = $selectedIDs[$selected] = $selected;	
			}
		}else{
			while(count($selectedIDs) <  $selectCount){
				$selected = rand(0,$randMax);
				$alreadyUsed[$idsArr[$selected]] = $selectedIDs[$idsArr[$selected]] = $idsArr[$selected];
			}
		}
		$request->session()->put($type.'_ids', $alreadyUsed);
		return $selectedIDs;
	}

	public function getNonSubscribedBusiness(){
		$userObj = new User;
		$count = $userObj->where('user_type','business')->where('active',1)->count();
		if(!empty(Auth::user()->id)){
			$userId = Auth::user()->id;
			$userBusinessData = UserSubcribeBusiness::where('user_id',$userId)->get();
			$userBusinessArray = array();
			foreach($userBusinessData as $business){
				$userBusinessArray[$business->business_id] = $business->business_id;
			}
			$userObj = $userObj->whereNotIn('id',$userBusinessArray);
			$count = $count - count($userBusinessArray);
		}
		$page = rand(1,$count) -1;
		return $userObj->where('user_type','business')->where('active',1)->offset($page)->first();
	}

	public function getNetworkPosts(Network $network,$page,$mobile = false){
		$records = $mobile == true ? 2:6; 
		$networkPosts = $network->posts()->where('posts.active',1)->where('type','post')->orderBy('id','desc')->paginate($records,['*'], 'page', $page);
		return  $this->postRelatedData($networkPosts);
	}

	public function getUserNetworkPosts($page,$flag = true,$mobile = false){ /// flag will return user subscribed netwoorks if true, else other networks user have not subscribed
		$network = new Network;
		$posts = New Post;
		if(!empty(Auth::user()->id)){
			$userId = Auth::user()->id;
			$userNetworkArray = array();
			$userNetworkData = UserNetwork::where('user_id',$userId)->get();
			foreach($userNetworkData as $networkD){
				$userNetworkArray[$networkD->network_id] = $networkD->network_id;
			}
			$networkPostIDs = NetworkPost::wherein('network_id',$userNetworkArray)->get();
			$postIds = array();
			foreach($networkPostIDs as $pdata){
				$postIds[$pdata->post_id] = $pdata->post_id;
			}
			if($flag == true){
				if(!empty($postIds)){
					$posts = $posts->whereIn('id',$postIds);
				}else{
					return array();
				}
			}else if(!empty($posts)){
				$posts = $posts->whereNotIn('id',$postIds);
			}
		}else if($flag == true && empty(Auth::user())){
			return array();
		}
		$records = $mobile == true ? 2:6;
		$networkPosts = $posts->where('posts.active',1)->where('type','post')->orderBy('id','desc')->paginate($records,['*'], 'page', $page);
		return  $this->postRelatedData($networkPosts);
	}


	public function otherNetworkPosts(Network $network,$page,$mobile = false){
		$post = new Post;
		$networkPosts = $network->posts()->get();
		$postIDs = array();
		foreach($networkPosts as $post){
			$postIDs[$post->id] = $post->id;
		}
		$records = $mobile == true ? 3:6;
		$posts = $post->whereNotIn('id',$postIDs)->where('type','post')->where('active',1)->orderBy('id','desc')->paginate($records,['*'], 'page', $page);
		return $this->postRelatedData($posts);
	}

	public function getUserPosts($page,$userID,$mobile = false){
		$post = new Post;
		$post = $post->where('active',1);
		$post = $post->where('type','post');
		$post = $post->where('user_id',$userID);
		$records = $mobile == true ? 3:6;
		$posts = $post->orderBy('id','desc')->paginate($records,['*'], 'page', $page);
		return $this->postRelatedData($posts);	
	}

	public function getUserCommentedPosts($page, User $user, $mobile = false){
		$records = $mobile == true ? 3:6;
		$posts = $user->commentedPosts()->where('posts.active',1)->where('post_user_comments.active',1)->groupBy('post_user_comments.post_id')->paginate($records,['*'], 'page', $page);
		return $this->postRelatedData($posts);	
	}

	public function getUserNetworks($page, User $user, $mobile = false){
		if(!empty($user->id)){
			$userId = $user->id;
			$userNetworkArray = array();
			$records = $mobile == true ? 3:6;
			$userNetworkData = UserNetwork::where('user_id',$userId)->where('active',1)->groupBy('network_id')->get();
			$networkArr = array();
			foreach($userNetworkData as $uND){
				$networkArr[$uND->network_id] = $uND->network_id;
			}
			return Network::whereIn('id',$networkArr)->paginate($records,['*'], 'page', $page);
		}
		return array();
	}

	public function autodeactivepost(Post $post){
		//check -5 rating and make inactive post
		$rate = $this->getPostRate($post);
		if($rate <= -5){
			$post->active = 0;
			$post->save();
		}
		return;
	}

	public function reportPost(Request $request){
		$post = Post::find($request->post);
	}

	public function getSearchPosts(Request $request,$page,$mobile = false){
		$keyword = $request->keyword;
		$recordCount = $mobile == true ? 2:6;
		$searchResults = \DB::table('posts')
            ->where('active',1)
			->where('type','post')
			->where(function ($query)use ($keyword) {
                $query->orWhere('title', 'like', '%'.$keyword.'%')
                      ->orWhere('details', 'like', '%'.$keyword.'%');
            })
			->select('posts.*',DB::raw("IF(
            								`title` LIKE '%{$keyword}%',  20, 
											        IF(`title` LIKE '%{$keyword}%', 10, 0)
									      )
									      + IF(`details` LIKE '%{$keyword}%', 5,  0)
									    AS `weight`"))
			->orderBy('weight', 'DESC')
            ->paginate($recordCount,['*'], 'page', $page);	
        $posts = $this->postRelatedData($searchResults);
		return $posts;
	}

	public function getSearchTags(Request $request,$page,$mobile = false){ //// need to change the function for the tags
		$keyword = $request->keyword;
		$recordCount = $mobile == true ? 2:6;

		$searchResults = \DB::table('posts')
            ->where('posts.active',1)
			->where('type','post')
			->join('post_user_tags', 'post_user_tags.post_id', '=', 'posts.id')
			->where('post_user_tags.text',$keyword)
			->select('posts.*')
			->orderBy('posts.id', 'DESC')
			->groupBy('posts.id')
            ->paginate($recordCount,['*'], 'page', $page);	
        $posts = $this->postRelatedData($searchResults);
		return $posts;
	}

	public function getcommentSearchResults(Request $request,$page,$mobile = false){
		$postArr = array();
        if($request->tags ==  true){
	        $postArr = $this->getTagSearchResults($request,$page,$mobile);
	    }	
        $count = count($postArr);
		$recordCount = $mobile == true ? 2 - $count:6 - $count;
		$keyword = $request->keyword;
		$searchResults = \DB::table('post_user_comments as postComment')
			->Join('posts as post', 'post.id', '=', 'postComment.post_id')
            ->where('postComment.active',1)
            ->where('post.active',1)
			->where('comment', 'like', '%'.$keyword.'%')                   
			->select('postComment.post_id',DB::raw("IF(
            								`comment` LIKE '%{$keyword}%',  20, 
											        IF(`comment` LIKE '%{$keyword}%', 10, 0)
									      )
									    AS `weight`"))
			->orderBy('weight', 'DESC')
			->groupBy('postComment.post_id')
            ->paginate($recordCount,['*'], 'page', $page);	

        foreach($searchResults as $res){
        	$postArr[] = Post::find($res->post_id);
        }

        $posts = $this->postRelatedData($postArr);
		return $posts;
	}

	public function getTagSearchResults(Request $request,$page,$mobile = false){
		$recordCount = $mobile == true ? 1:3;
		$keyword = $request->keyword;
		$searchResults = \DB::table('post_user_tags as postTags')
			->Join('posts as post', 'post.id', '=', 'postTags.post_id')
            ->where('post.active',1)
            ->where('postTags.active',1)
			->where('text', 'like', '%'.$keyword.'%')                   
			->select('postTags.post_id',DB::raw("IF(
            								`text` LIKE '%{$keyword}%',  20, 
											        IF(`text` LIKE '%{$keyword}%', 10, 0)
									      )
									    AS `weight`"))
			->orderBy('weight', 'DESC')
			->groupBy('postTags.post_id')
            ->paginate($recordCount,['*'], 'page', $page);	

        $postArr = array();
        foreach($searchResults as $res){
        	$postArr[] = Post::find($res->post_id);
        }
        return $postArr;
	}

	public function searchNetworks(Request $request,$page,$mobile = false){
		$recordCount = $mobile == true ? 2:6;
		$keyword = $request->keyword;
		$networks = \DB::table('networks')
            ->where('active',1)
			->where(function ($query)use ($keyword) {
                $query->orWhere('title', 'like', '%'.$keyword.'%')
                      ->orWhere('details', 'like', '%'.$keyword.'%');
            })
			->select('networks.*',DB::raw("IF(
            								`title` LIKE '%{$keyword}%',  20, 
											        IF(`title` LIKE '%{$keyword}%', 10, 0)
									      )
									      + IF(`details` LIKE '%{$keyword}%', 5,  0)
									    AS `weight`"))
			->orderBy('weight', 'DESC')
            ->paginate($recordCount,['*'], 'page', $page);

        return $networks;	
	}

	public function canUserSubscribeBusiness(){
		if(Auth::user()->user_type != 'user'){
			return false;
		}
		if(Auth::user()->user_subscription == 'level1'){
			return false;
		}

		if(Auth::user()->user_subscription == 'level2'){
			$userSubcribeBusinessObj = new UserSubcribeBusiness;
			$userId = Auth::user()->id;
			$userBusinessData = UserSubcribeBusiness::where('user_id',$userId)->where('active',1)->count();
			if(config('constants.Level_ONE_BUSINESS_COUNT') < $userBusinessData){
				return false;
			}
		}
		return true;
	}
}