<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use App\User;
use App\Category;
use App\Network;
use Carbon\Carbon;
use App\Content;
use App\Country;
use App\Company;
use App\Repositories\Posts;
use App\Repositories\Ads;
use App\Post;
use App\UserNetwork;
use App\Package;
use App\PackageOption;


class CommonController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		 //$this->middleware('auth');
	}

	public function category($category){
		$categoryData = Category::with('network')->where('url',$category)->first();
		if(empty($categoryData)){
			$categoryData = Category::with('network')->where('title',$category)->first();
		}
		$content = New Content;
        $contentData = $content->where('url',$category)->first(); 
        $selectedManu = 'category';
        $title = $category;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        $title_for_layout = $category;
        $description_for_layout = $category;
        $keywords_for_layout = $category;
        $meta_title_content = $category;
        if(!empty($contentData->id)){
	        $title_for_layout = $contentData->title;
	        $description_for_layout = $contentData->page_description;
	        $keywords_for_layout = $contentData->page_keywords;
	        $meta_title_content = $contentData->meta_title_content;
	    }
        return view('common.category',compact('category','categoryData','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));	
	}
	
	public function facebookEmailError(){
		$category = $selectedManu = 'FacebookEmailNotFound';
        $title = $category;
        $title_for_layout = $category;
        $description_for_layout = $category;
        $keywords_for_layout = $category;
        $meta_title_content = $category;
        return view('errors.facebook_email_error',compact('category','title','selectedManu','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));		
	}

	public function network($network,Request $request){
		$network = urldecode($network);
		$networkData = Network::with('posts')->where('url',$network)->first();
		if(empty($networkData)){
			$networkData = Network::with('posts')->where('title',$network)->first();
		}
		$header = $request->header('User-Agent');
        $mobile = false;
        $mobileData = $feed1 = $feed2 = $networks = $otherPosts = array();
        $posts = new Posts;
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
        }

        if(!empty(Auth::user()->id)){
            $networks = $posts->getNonSubscribedNetwork($request,1,false,$mobile);
            $feed2 = $otherPosts = $posts->otherNetworkPosts($networkData,1,$mobile);
        }else{
        	$networks = $posts->getOtherNetworks($networkData,1,$mobile);
        	$feed2 = $otherPosts = $posts->otherNetworkPosts($networkData,1,$mobile);
        }

        $adsObj = new Ads;
        $ads = $adsObj->getAds($request,$mobile); // need to change with respect to business subscribed
        $lastCol = arrangeAdColData($ads,$networks);

        
		$feed1 = $networkPosts = $posts->getNetworkPosts($networkData,1);
		if($mobile){
            $mobileData = arrangeHomeDataForMobile($feed1,$feed2,$lastCol);
        }


		$content = New Content;
        $contentData = $content->where('title',$network)->first(); 
        $selectedManu = 'network';
        $title = $network;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        $title_for_layout = $network;
        $description_for_layout = $network;
        $keywords_for_layout = $network;
        $meta_title_content = $network;
        if(!empty($contentData->id)){
	        $title_for_layout = $contentData->title;
	        $description_for_layout = $contentData->page_description;
	        $keywords_for_layout = $contentData->page_keywords;
	        $meta_title_content = $contentData->meta_title_content;
	    }
	    $userNetwork = '';
	    if(!empty(Auth::user()->id)){
		    $userNetwork = UserNetwork::where('user_id',Auth::user()->id)->where('network_id',$networkData->id)->where('active',1)->first();
		}

	    return view('common.network',compact('mobile','mobileData','userNetwork','otherPosts','lastCol','networkPosts','network','networkData','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));	
	}

	public function loadPages(Request $request){
		$function = $request->option;
		$page = $request->page;
		$postsObj = new Posts;

		$mobile = false;
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
        }

		$postData = array();
		if($request->file == 'network'){
			$networkData = Network::find($request->row);				
			if(!$mobile){
				if($function == 'user'){
					$postData = $postsObj->getNetworkPosts($networkData,$page,$mobile);
				}else if($function == 'other'){
					$postData = $postsObj->otherNetworkPosts($networkData,$page,$mobile);
					
				}else if($function == 'network'){
					/*if(Auth::user()){
						$postData = $postsObj->getNonSubscribedNetwork($request,$page,true,$mobile);
					}else{
						$postData = $postsObj->getOtherNetworks($networkData,$page,$mobile);
					}*/

					$networkForPage = $postsObj->getNonSubscribedNetwork($request,$page,false,$mobile);
	                $adsObj = new Ads;
	                $ads = $adsObj->getAds($request,$mobile,$page); // need to change with respect to business subscribed
	                $postData = arrangeAdColData($ads,$networkForPage); 
				}
			}else{
					$feed1 = $postsObj->getNetworkPosts($networkData,$page,$mobile);
					$feed2 = $postsObj->otherNetworkPosts($networkData,$page,$mobile);				
					$networks = $postsObj->getNonSubscribedNetwork($request,$page,false,$mobile);
	                $adsObj = new Ads;
	                $ads = $adsObj->getAds($request,$mobile,$page); // need to change with respect to business subscribed
	                $lastCol = arrangeAdColData($ads,$networks);
		            $mobileData = arrangeHomeDataForMobile($feed1,$feed2,$lastCol);
		            $file = 'network';
		            $url  = url('network/loadPages').'?row='.$request->row.'&page='.($page+1).'&file='.$file;
		            return view('loadMobilePages',compact('mobileData','page','file','url'));
			}
		}
		if($request->file == 'search'){			
			if(!$mobile){
				if($function == 'search'){
					if(!empty($request->tags) && $request->tags == true){
						$feed1 = $postData = $postsObj->getSearchTags($request,1,$mobile);
					}else{
						$feed1 = $postData = $postsObj->getSearchPosts($request,$page,$mobile );	
					}
				}else if($function == 'other'){
					$postData = $postsObj->getcommentSearchResults($request,$page,$mobile );				
				}else if($function == 'network'){
					$networkForPage = $postsObj->getNonSubscribedNetwork($request,$page,$mobile);
					$adsObj = new Ads;
	                $ads = $adsObj->getAds($request,$mobile,$page); // need to change with respect to business subscribed
	                $postData = arrangeAdColData($ads,$networkForPage); 
				}
			}else{
				$feed2 = $feed1 = array();
	            if(!empty($request->tags) && $request->tags == true){
					$feed1 = $postsObj->getSearchTags($request,1,$mobile);
				}else{
					$feed1 = $postsObj->getSearchPosts($request,$page,$mobile );	
				}
				$feed2 = $postsObj->getcommentSearchResults($request,$page,$mobile );

	            $networks = $postsObj->searchNetworks($request,1,$mobile);
				$adsObj = new Ads;
		        $ads = $adsObj->getAds($request,$mobile); // need to change with respect to business subscribed
	            
	            $lastCol = arrangeAdColData($ads,$networks);
	            $mobileData = arrangeHomeDataForMobile($feed1,$feed2,$lastCol);
	            $file = 'search';
	            $url  = url('search/loadPages').'?search='.urlencode($request->keyword).'&page='.($page+1).'&file='.$file;
	            if($request->file == 'network'){
	            	$url .= 'row='.$request->row;
	            }
	            return view('loadMobilePages',compact('mobileData','page','file','url'));
			}
		}

		$type = $function == 'network'? 'network':'post';
		$tags = !empty($request->tags) ? $request->tags:false;
		$url  = url('network/loadPages').'?search='.urlencode($request->keyword).'&option='.$function.'&page='.($page+1).'&file='.$request->file.'&row='.$request->row.'&tags='.$tags;
        return view('loadPages',compact('postData','type','url'));
	}

	public function search(Request $request){
		$mobile = false;
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
        }
        $request->keyword = trim($request->keyword);
        $postsObj = new Posts;
        $mobileData = $feed1 = array();
        if(!empty($request->tags) && $request->tags == true){
			$feed1 = $postData = $postsObj->getSearchTags($request,1,$mobile);
		}else{
			$feed1 = $postData = $postsObj->getSearchPosts($request,1,$mobile);
		}
		$feed2 = $commentData = $postsObj->getcommentSearchResults($request,1,$mobile);
		
		$businessAdObj = new Ads();
		$businessAdSeach = $businessAdObj->searchAd($request);

		$networks = $postsObj->searchNetworks($request,1,$mobile);
		$adsObj = new Ads;
        $ads = $adsObj->getAds($request,$mobile); // need to change with respect to business subscribed
        $lastCol = arrangeAdColData($ads,$networks);
        if($mobile){
            $mobileData = arrangeHomeDataForMobile($feed1,$feed2,$lastCol);
        }

		$keyword = $request->keyword;		
		$content = new Content;
		$contentData = $content->where('title','search')->first(); 
        $selectedManu = 'search';
        $title = 'search';
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        $title_for_layout = 'search';
        $description_for_layout = 'search';
        $keywords_for_layout = 'search';
        $meta_title_content = 'search';
        if(!empty($contentData->id)){
	        $title_for_layout = $contentData->title;
	        $description_for_layout = $contentData->page_description;
	        $keywords_for_layout = $contentData->page_keywords;
	        $meta_title_content = $contentData->meta_title_content;
	    }
	    $tags = !empty($request->tags) ? $request->tags:false;
		return view('common.search',compact('mobileData','lastCol','businessAdSeach','tags','postData','commentData','mobile','keyword','networks','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));	
	}

	public function postDetails(Post $post){
        $postsObj = new Posts;
        $postData = $postsObj->getPostData($post);

        $content = new Content;
		$contentData = $content->where('title','post Details')->first(); 
        $selectedManu = 'search';
        $title = 'search';
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        $title_for_layout = 'search';
        $description_for_layout = 'search';
        $keywords_for_layout = 'search';
        $meta_title_content = 'search';
        if(!empty($contentData->id)){
	        $title_for_layout = $contentData->title;
	        $description_for_layout = $contentData->page_description;
	        $keywords_for_layout = $contentData->page_keywords;
	        $meta_title_content = $contentData->meta_title_content;
	    }

        return View('common.postDetails',compact('post','postData','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
    }

    public function cookie(Request $request){
    	$request->session()->put('cookie', 1);
    	return 'true';
    }

    public function subscription(){
        $packageObj = new Package;
        $packages = $packageObj->where('active',1)->get();
        $content = New Content;
        $contentData = $content->where('content_for','subscription')->first(); 
        $selectedManu = 'subscription';
        $contentData->contentImage();
        $title = 'Subscription';//$contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        $packageOptionObj = new PackageOption;
        $options =  $packageOptionObj->where('active',1)->get();
        return View('common.subscription',compact('options','packages','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
    }	
}
