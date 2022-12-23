<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Post;
use App\PostComment;
use App\PostLike;
use App\PostRating;
use App\NetworkPost;
use App\Network;
use App\UserNetwork;
use App\CommentRating;
use App\User;
use Auth;
use DB;

class Offers{	
	public function createOffer(Request $request){
		$postData = $request->all();
		if(Auth::user()->user_type == 'user'){
			return false;
		}
		if(Auth::user()->user_type != 'admin' && Auth::user()->id != $postData['user_id']){
			return false;
		}
		$postData['details'] = htmlentities($postData['details']);
		$postData['type'] = 'offer';
		//$postData['user_id'] = Auth::user()->id;
		$postNetworks = $postData['network_id'];
		unset($postData['network_id']);
		$destinationPath = 'uploads/Offer/';
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
        $id = Post::insertGetId($postData);
		$post = new Post;
		$postObj = $post->find($id);
		foreach($postNetworks as $network){
			$networObj = Network::find($network);
			$postObj->networks()->saveMany([$networObj]);
		}
		return $id;
	}

	public function canEdit(Post $post){
		if(Auth::user()->user_type == 'user'){
			return false;
		}
		if(Auth::user()->user_type == 'admin'){
			return true;
		}
		if(Auth::user()->user_type == 'business' && Auth::user()->id == $post->created_by){
			return true;
		}
		return false;
	}

	public function updateOffer(Request $request,Post $post){
		if(Auth::user()->user_type == 'user'){
			return false;
		}
		if(Auth::user()->user_type != 'admin' && Auth::user()->id != $post->user_id){
			return false;
		}
		//$networks = $post->networks()->get();
		$post->networks()->detach();
		
		$data = $request->all();
		unset($data['_method']);unset($data['_token']);
		$data['details'] = htmlentities($data['details']);
        unset($data['_method']);unset($data['_token']);
        $postNetworks = $data['network_id'];
		unset($data['network_id']);
		
        if ($request->hasFile('image_path')) {
            $destinationPath = 'uploads/Offer/';
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
		$post['type'] = 'offer';
		//$post['user_id'] = Auth::user()->id;
		if($post->save()){
			foreach($postNetworks as $network){
				$networObj = Network::find($network);
				$post->networks()->saveMany([$networObj]);
			}
			return true;
		}
		return false;
	}

	public function deleteOffer(Post $post,$active = 0){
		if($post->type!= 'offer'){
			return false;
		}
		if(Auth::user()->user_type == 'admin'){
			$post->active = $active;
		}else{
			$post->active = 0;
		}
		if($post->save()){
			return true;
		}
		return false;
	}



	public function OfferNetworks(Post $post,$isList = false){
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

	public function getOfferList(){
		$post = new Post();
		if(Auth::user()->user_type  == 'admin'){
	        if(isset($request->keyword)){
	            $post = $post->Where('title', 'like', '%'.$keyword.'%');
	        }
	        if(isset($request->active) && $request->active != -1){
	            $post = $post->Where('active', $request->active);
	        }
	    }
		$post = $post->where('active',1);
		$post = $post->where('type','offer');
		$post = $post->where('user_id',Auth::user()->id);
		$networkList = Auth::user()->userNetworks()->pluck('network_id')->toArray();
		if(!empty($networkList)){
			$post = $post->where('network_id',$networkList);
		}
		$posts = $post->paginate(20);
		$postDataArray = $this->adRelatedData($posts);
		return $postDataArray;
	}

	public function adRelatedData($posts){
		$postDataArray = array();		
		foreach($posts as $post){
	    	$postDataArray[$post->id]['networks'] = $post->networks()->get();
	    	$createdBY = $post->createdBy()->get();
			$postDataArray[$post->id]['createdBY'] = $createdBY;
		}
		$postDataArray['Post'] = $posts;
		return $postDataArray;
	}

	function getOfferData(Post $post){
		$postDataArray = array();
        $createdBY = $post->createdBy()->get();
        $postDataArray['createdBY'] = $createdBY;
        $postDataArray['post'] = $post;
        return $postDataArray;
	}

	public function getOffers($page){
		$user = new User;
		$networkPosts = $businesses = array();
		if(!empty(Auth::user())){
			$businesses = $user->getNotSubcribedBusiness(Auth::user()->id);
		}else{
			$businesses = $user->getBusiness();
		}
		foreach($businesses as $business){
			 $businessOffer = Post::where('user_id',$business->id)->where('posts.active',1)->where('type','offer')->skip($page-1)->take(1)->orderBy('id','desc')->get();	
			 if(!empty($businessOffer[0])){
			 	$networkPosts[] = $businessOffer[0];
			 }
		}
		return  $this->postRelatedData($networkPosts);
	}
	public function postRelatedData($posts){
		$postDataArray = array();		
		foreach($posts as $post){
			$postImages = \DB::table('posts')
            ->Join('post_images', 'posts.id', '=', 'post_images.post_id')
            ->where('posts.id', $post->id)
			->select('post_images.*')
            ->get();
            $postDataArray[$post->id]['PostImages'] = $postImages;
            $postDataArray[$post->id]['createdBY'] = $post->createdBy()->get();
            $postDataArray[$post->id]['networks'] = $post->networks()->with('category')->get();
            $postDataArray[$post->id]['company'] = $post->user()->with('companies')->where('active',1)->first();

		}
		$postDataArray['Post'] = $posts;
		return $postDataArray;
	}
}