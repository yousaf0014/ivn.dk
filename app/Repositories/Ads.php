<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Post;
use App\PostComment;
use App\PostLike;
use App\PostRating;
use App\NetworkPost;
use App\Network;
use App\CommentRating;
use App\UserNetwork;
use App\User;
use App\UserSubcribeBusiness;
use Auth;
use DB;
class Ads{
	public function searchAd(Request $request){
		$keyword = urldecode($request->keyword);
		$recordCount = 1;
		
		$searchResults = \DB::table('posts')
            ->where('posts.active',1)
			->where('type','Ad')
			->join('post_user_tags', 'post_user_tags.post_id', '=', 'posts.id')
			->where('post_user_tags.text',$keyword)
			->select('posts.*')
			->orderBy('posts.id', 'DESC')
			->groupBy('posts.id')
            ->paginate($recordCount,['*'], 'page', 1);	
        if(!empty($searchResults)){
			$searchResults = \DB::table('posts')
	            ->where('active',1)
				->where('type','Ad')
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
	            ->paginate($recordCount,['*'], 'page', 1);	

        }

        if(!empty($searchResults)){
			foreach($searchResults as $post){
				$postData = Post::find($post->id);
				return $this->getAdData($postData);	
			}
		}
		return array();
	}
	public function createAd(Request $request){ /// we need to get the user id as external option if admin is loged in
		$postData = $request->all();
		if(Auth::user()->user_type == 'user'){
			return false;
		}
		if(Auth::user()->user_type != 'admin' && Auth::user()->id != $postData['user_id']){
			return false;
		}
		$postData['details'] = htmlentities($postData['details']);
		$postData['type'] = 'ad';
		$postNetworks = $postData['network_id'];
		unset($postData['network_id']);
		$destinationPath = 'uploads/Ad/';
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
        ///$postData['user_id'] = $postData ////Auth::user()->id;
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

	public function updateAd(Request $request,Post $post){
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
            $destinationPath = 'uploads/Ad/';
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
		$post['type'] = 'ad';
		///// $post['user_id'] = Auth::user()->id;
		if($post->save()){
			foreach($postNetworks as $network){
				$networObj = Network::find($network);
				$post->networks()->saveMany([$networObj]);
			}
			return true;
		}
		return false;
	}

	public function deleteAd(Post $post,$active = 0){
		if($post->type!= 'ad'){
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

	public function AdNetworks(Post $post,$isList = false){
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

	public function getAdList(){
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
		$post = $post->where('type','ad');
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

	function getAdData(Post $post){
		$postDataArray = array();
        $createdBY = $post->createdBy()->get();
        $postDataArray['createdBY'] = $createdBY;
        $postDataArray['post'] = $post;
        return $postDataArray;
	}

	function saveUserAdvert(Post $post){  
		/// user have subscribed for the business so business user is saved as business user id// subscribed user will be save in user_id
		// business user id can be get from advert user id. 
	}

	function getBusinessUnitsHaveAds($businessIDs){
		$businssUnits = \DB::table('posts')
            ->Join('users', 'posts.user_id', '=', 'users.id')
            ->whereIn('posts.user_id',$businessIDs)
            ->where('type','ad')
			->select('users.id')
            ->get();

        $selectediDs =array();
        foreach($businssUnits as $BData){
        	$selectediDs[$BData->id] = $BData->id;
        }
        return $selectediDs;
	}

	public function getAds(Request $request,$mobile = false,$page = 1){ 
		$user = new User;
		$userShowArr = $networkPosts = $businesses = array();
		if(!empty(Auth::user())){
			$businesses = $user->getNotSubcribedBusiness(Auth::user()->id);			
		}else{
			$businesses = $user->getBusiness();			
		}
		$userShowArr = $businessArr = array();
		foreach($businesses as $business){
			$businessArr[$business->id] = $business->id;
		}

		$businessArr = $this->getBusinessUnitsHaveAds($businessArr);
		if($page = 1 || $page = 0){
			$request->session()->pull('user_shown_business',array());	
		}else{
			$userShowArr = $request->session()->pull('user_shown_business',array());
		}	
		foreach($userShowArr as $usB){
			if(isset($businessArr[$usB])){
				unset($businessArr[$usB]);
			}
		}
		$selectdIDs = $bArray = array();
		
		foreach($businessArr as $bA){
			$bArray[] = $bA;
		}
		$recordCount = $mobile == true ? 2:6;
		$businessCounts = count($bArray) - 1;
		if(empty($businessArr)){
			return array();
		}else if(count($businessArr) < $recordCount){
			foreach($businessArr as $bid){
				$selectdIDs[$bid] = $bid;
				$userShowArr[$bid] = $bid;			
			}
		}else{
			while(count($selectdIDs) < $recordCount){
				$rand = rand(0,$businessCounts);
				$selectdIDs[$bArray[$rand]] = $bArray[$rand];
				$userShowArr[$bArray[$rand]] = $bArray[$rand];			
			}
		}
		
		$page = 1;
		$networkPosts = Post::whereIn('user_id',$selectdIDs)->where('active',1)->where('type','ad')->groupBy('user_id')->orderBy('id','ASC')->paginate($recordCount,['*'], 'page', $page);
		if(!empty($userShowArr)){
			$request->session()->put('user_shown_business',$userShowArr);
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

	public function getBusinessAd($user){
		$postObj = new Post;
		$postData = $postObj->where('user_id',$user->id)->where('active',1)->where('type','ad')->first();
		if(empty($postData)){
			return array();
		}
		return $this->getAdData($postData);
	}
}