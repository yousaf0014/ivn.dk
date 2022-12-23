<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\User;
use App\Category;
use Carbon\Carbon;
use App\Content;
use App\Country;
use App\Company;
use App\Network;
use App\Post;
use App\PostComment;
use App\Repositories\Posts;
use App\Repositories\Ads;
use App\Package;
use App\Subscription;
use App\Repositories\Reepay;
use App\Repositories\Billy;
use Mail;
use App\UserAdvert;
use App\PackageOption;
use App\Repositories\SandGrid;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
         $this->middleware('auth');
    }

    public function index(Request $request){
        $header = $request->header('User-Agent');
        $mobile = false;
        $postsObj = new Posts;
        $news = $postsObj->getLatestNews();
        $networks = $postsObj->getNonSubscribedNetwork($request,0,true);
        $business = $postsObj->getNonSubscribedBusiness();
        $content = New Content;
        $contentData = $content->where('content_for','user_home')->first(); 
        $selectedManu = 'home';
        $contentData->contentImage();
        $title = 'home';
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        return view('user.index',compact('business','networks','news','company','countries','user','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content')); 
    }


    public function viewprofile($userID = null){
        $user = Auth::user();
        if(!empty($userID)){
            $user = User::find($userID);
        }
        if(empty($user)){
            return back();
        }
        $companyInfo = $user->companies()->where('active',1)->first();
        $mobile = false;
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
        }
        $mobileData = array();
        $postsObj = new Posts;
        $feed1 = $postsObj->getUserPosts(1,$user->id,$mobile);
        $feed2 = $postsObj->getUserCommentedPosts(1,$user,$mobile);
        $feed3 = $postsObj->getUserNetworks(1,$user,$mobile);
        if($mobile){
           $mobileData = $this->__makeProfileMobileArray($feed1,$feed2,$feed3); 
        }

        $content = New Content;
        $contentData = $content->where('content_for','user_profile')->first(); 
        $selectedManu = 'home';
        $title = 'User Profile';
        if(!empty($contentData)){
            $contentData->contentImage();        
            $title_for_layout = $contentData->title;
            $description_for_layout = $contentData->page_description;
            $keywords_for_layout = $contentData->page_keywords;
            $meta_title_content = $contentData->meta_title_content;
        }else{
            $title_for_layout = 'User Profile';
            $description_for_layout = 'User Profile';
            $keywords_for_layout = 'User Profile';
            $meta_title_content = 'User Profile';
        }
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        return view('user.viewprofile',compact('mobile','mobileData','feed1','feed2','feed3','companyInfo','user','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
    }
    function __makeProfileMobileArray($feed1,$feed2,$feed3){
        $colArr = array();
        $index = 0;
        if(!empty($feed1['Post'][0])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][0];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][0]->id]) ? $feed1[$feed1['Post'][0]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][0])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][0];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][0]->id]) ? $feed2[$feed2['Post'][0]->id]:array();
            $index++;
        }
        if(!empty($feed3[0])){
            $colArr[$index]['data'] = $feed3[0];
            $colArr[$index]['type'] = 'network';
            $index++;
        }
        if(!empty($feed1['Post'][1])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][1];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][1]->id]) ? $feed1[$feed1['Post'][1]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][1])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][1];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][1]->id]) ? $feed2[$feed2['Post'][1]->id]:array();
            $index++;
        }
        if(!empty($feed3[1])){
            $colArr[$index]['data'] = $feed3[1];
            $colArr[$index]['type'] = 'network';
            $index++;
        }
        if(!empty($feed1['Post'][2])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][2];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][2]->id]) ? $feed1[$feed1['Post'][2]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][2])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][2];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][2]->id]) ? $feed2[$feed2['Post'][2]->id]:array();
            $index++;
        }
        if(!empty($feed3[2])){
            $colArr[$index]['data'] = $feed3[2];
            $colArr[$index]['type'] = 'network';
            $index++;
        }
        return $colArr;
    }

    public function loadprofilePages(Request $request){
        $function = $request->option;
        $user = User::find($request->user);
        $page = $request->page;
        $postsObj = new Posts;
        $postData = array();
        $mobile = false;
        $controller = '';
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
            $feed1 = $postsObj->getUserPosts($page,$user->id,$mobile);
            $feed2 = $postsObj->getUserCommentedPosts($page,$user,$mobile);
            $feed3 = $postsObj->getUserNetworks($page,$user,$mobile);
            $mobileData = $this->__makeProfileMobileArray($feed1,$feed2,$feed3);
            $url  = url('user/loadprofilePages').'?page='.($page+1).'&file='.$request->file.'&user='.$request->user;
            return view('loadMobilePages',compact('mobileData','url'));
        }else{
            if($request->file == 'userProfile'){
                if($function == 'user'){
                    $postData = $postsObj->getUserPosts($page,$user->id,$mobile);
                }else if($function == 'user_comments'){
                    $postData = $postsObj->getUserCommentedPosts($page,$user,$mobile);                   
                }else if($function == 'network'){
                    $postData = $postsObj->getUserNetworks($page,$user,$mobile);                    
                }
            }

            $type = $function == 'network'? 'network':'post';
            $url  = url('user/loadprofilePages').'?option='.$function.'&page='.($page+1).'&file='.$request->file.'&user='.$request->user;
            return view('loadPages',compact('postData','type','controller','url'));
        }
    }
    /**
     * List users
     * @return unknown
     */
    public function editProfile()
    {
        $user = Auth::user();
        $company = Auth::user()->companies()->where('active',1)->get();
        $company = $company->isEmpty() ? array():$company[0]; 
        $countryObj = New Country;
        $countries = $countryObj->get();
        $content = New Content;
        $contentData = $content->where('content_for','profile_edit')->first(); 
        $selectedManu = 'Profile';
        $contentData->contentImage();
        $title = $contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $mobile = false;
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))){
            $mobile = true;
        }

        $currentPath = \Route::getFacadeRoot()->current()->uri();
        return view('user.editProfile',compact('company','countries','mobile','user','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
    }

    public function updateprofile(Request $request){
        $data = $request->all();
        $user = User::find(Auth::user()->id);
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        if(!empty($data['password'])){
            $user->password = bcrypt($data['password']);
        }
        $user->address = $data['address'];
        $user->housenumber = $data['housenumber'];
        $user->address2 = $data['address2'];
        $user->zipcode = $data['zipcode'];
        $user->city = $data['city'];
        $user->mobile = $data['mobile'];
        $user->country = $data['country'];
        $user->date_of_birth = $data['year'].'-'.$data['month'].'-'.$data['day'];
        $user->gender = $data['gender'];
        $user->job_title = $data['job_title'];
        $user->primary_occupation = $data['primary_occupation'];
        $user->entrepreneurial_status = $data['entrepreneurial_status'];
        $destinationPath = 'uploads/profile/';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);    
               $user->profile_image = $picture;
            if(!empty($data['width']) && !empty($data['height'])){
                cropImage($destinationPath, $destinationPath.'r', $picture, $data['x'], $data['y'], $data['width'], $data['height']);            
                $user->profile_image = 'r'.$picture;
            }
        }
        $user->save();
        $companyObj = new Company;
        $oldData = $companyObj->where('active',1)->where('user_id',$user->id)->get();
        if(!$oldData->isEmpty()){
            $oldData[0]->active = 0;
            $oldData[0]->save();
        }
        $companyObj->name = $data['c_name'];
        $companyObj->type = $data['c_type'];
        $companyObj->cvr = $data['c_cvr'];
        $companyObj->address1 = $data['c_address'];
        $companyObj->house_no = $data['c_house_no'];
        $companyObj->address2 = $data['c_adress2'];
        $companyObj->zip = $data['c_zip'];
        $companyObj->city = $data['c_city'];
        $companyObj->email = $data['c_email'];
        $companyObj->url = $data['c_url'];
        $companyObj->entrepreneurial_status = $data['c_Entrepreneurial_status'];
        $companyObj->job_type = !empty($data['c_job_type']) ? $data['c_job_type']:'';
        $companyObj->created_by = Auth::user()->id;
        $companyObj->updated_by = Auth::user()->id;
        $companyObj->created_at = date('Y-m-d H:i:s');
        $companyObj->updated_at = $companyObj->created_at;
        $user->companies()->save($companyObj);
        return redirect('editProfile');
    }

    public function post(Request $request){
        $postsObj = new Posts;
        if($postsObj->createPost($request)){
            flash('Successfully Saved.','success');
        }else{
            flash('Error in Saving.','error');
        }
        return back();
    }

    public function ratepost(Request $request){
        $postsObj = new Posts;
        $outArr = $postsObj->saveRate($request);
        if($outArr['flag'] !== false){
             return "{$outArr['rate']}";    
        }
        return "false";
    }

    public function deleteCommnet(PostComment $commnet,$status){
        $postObj = new Posts;
        if($postObj->deleteCommnet($commnet,$status)){
            flash('Successfully Deleted!','success');    
        }else{
            flash('Error in deleteing! Please try again later','error');    
        }
        return back();
    }

    public function rateComment(Request $request){
        $postsObj = new Posts;
        $outArr = $postsObj->saveRateComment($request);
        if($outArr['flag']){
            return "{$outArr['rate']}";    
        }
        return "{$outArr['rate']}";
    }

    public function subscribeNetwork(Request $request,$status){
        $network = Network::find($request->network);
        if(!empty($network)){
            if($status == 1){
                $result = Auth::user()->userNetworks()->save($network,['active'=>$status]);
                if(!empty($result)){
                    return 'true';
                }
            }else{
                $result = Auth::user()->userNetworks()->detach($network->id);
                if($result){
                    return 'true';
                }
            }
        }
        return 'false';
    }

    public function reportPost(Request $request){
        $post = Post::find($request->post);
        if(!empty($post)){
            $result = Auth::user()->userPostReport()->attach($post->id,['active'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
            if(empty($result)){
                return 'true';
            }
        }
        return 'false';
    }

    public function reportComment(Request $request){
        $postComment = PostComment::find($request->comment);
        if(!empty($postComment)){
            $result = Auth::user()->userCommentReport()->save($postComment,['active'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
            if(!empty($result)){
                return 'true';
            }
        }
        return 'false';
    }

    public function editPost(Post $post){
         $postObj = new Posts;
        if($postObj->canEdit($post)){
            $networkData = Network::with('category')->get();
            $networks = array();
            foreach($networkData as $network){
                $networks[$network->category->id]['title'] = $network->category->title;
                $networks[$network->category->id]['network'][$network->id] = $network->title;
            }
            $selectedNetworks = $postObj->postNetworks($post,true);
            $tags = $postObj->getPostTags($post,true);
            return View('user.editPost',compact('post','networks','tags','selectedNetworks'));
        }else{
            return 'false';
        }
    }

    public function updatePost(Post $post,Request $request){
        $rules = array(
            'details' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            flash('Unable to updated Post! Validation fail','error');
            return back();
        } else {
            $postObj = new Posts;
            if($postObj->updatePost($request,$post)){
                flash('Successfully updated Post!','success');
            }else{
                flash('Unable to updated Post! Please try again later','error');
            }            
            return back();
        }
    }

    public function deletePost(Post $post){
        $postObj = new Posts;
        if($postObj->deletePost($post,0)){
            flash('Successfully Deleted!','success');    
        }else{
            flash('Error in deleteing! Please try again later','error');    
        }
        return back();
    }

    public function storeComment(Request $request,Post $post,$comment){
        $postsObj = new Posts;
        $commentID = $postsObj->storeComment($request,$post,$comment);
        if(!empty($commentID)){
            $commnets = PostComment::find($commentID);
            $company  = Auth::user()->companies()->where('active',1)->first();
            flash('Successfully Saved Comment!','success');
            if($request->edit != 1){
                 return View('commentData',compact('commnets','post','company'));
            }else{
                return back();
            }
        }else{
            flash('Error in saving! Please try again later','error');    
        }
        return 'false';
    }

    public function postCommnet(Post $post,$comment){
        $postsObj = new Posts;
        $flag = $postsObj->canAddEditComment($comment);
        $commentData;
        if($flag != false){
            $commentData = $postsObj->getComment($comment);
        }
        return View('user.editComment',compact('post','commentData','comment','flag'));
    }


    public function business($businessUnit){
        $business;
        if(is_numeric($businessUnit)){
            $business = User::find($businessUnit);
        }else{
            $business = User::where('url',$businessUnit)->first();
        }
        
        if($business->user_type != 'business'){
            flash(cmskey('no_business_with_such_name','error'));       
            return back();
        }
        $postsObj = new Posts;
        $canUserSubscribe = $postsObj->canUserSubscribeBusiness();
        $countryObj = new Country;
        $countries = $countryObj->get();
        $company = $business->companies()->where('active',1)->orderBy('id','DESC')->first();
        $userCompany = Auth::user()->companies()->where('active',1)->orderBy('id','DESC')->first();
        if(empty($userCompany)){
            $userCompany = new Company;
            $userCompany->name = '';
            $userCompany->type = '';
            $userCompany->cvr = '';
            $userCompany->address1 = '';
            $userCompany->house_no  = '';
            $userCompany->address2 = '';
            $userCompany->zip = '';
            $userCompany->city = '';
            $userCompany->email = '';
            $userCompany->url = '';

        }
        $content = new Content;
        $contentData = $content->where('parent_id',$business->id)->first(); 
        $selectedManu = 'home';
        if(!empty($contentData)){
            $contentData->contentImage();
        }
        $title = 'business';//$contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        //if((Auth::user()->user_subscription == 'level1' && !in_array($business->id,array(96,28,45,97,112,114))) || (Auth::user()->user_subscription != 'level3' && in_array($business->id,array(95,120)))){
          //  return View('user.businesswall',compact('canUserSubscribe','countries','company','business','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));               
        //}
        return View('user.business',compact('userCompany','canUserSubscribe','countries','company','business','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
    }

    public function subscription(){
        $packageObj = new Package;
        $packages = $packageObj->where('active',1)->get();
        $content = New Content;
        $contentData = $content->where('content_for','subscription')->first(); 
        $selectedManu = 'Profile';
        $contentData->contentImage();
        $title = 'Subscription';//$contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        if(!empty(Auth::user()->reepay_token)){
            $userSUbscription = Auth::user()->userSubscription()->where('active',1)->first();
            $postsObj = new Posts;
            $business = $postsObj->getNonSubscribedBusiness();
            $businessAd = array();
            if(!empty($business)){
                $adsObj = new Ads;
                $businessAd = $adsObj->getBusinessAd($business);
            }
            return View('user.mySubscription',compact('userSUbscription','packages','businessAd','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
        }
        $packageOptionObj = new PackageOption;
        $options =  $packageOptionObj->where('active',1)->get();
        return View('user.subscription',compact('options','packages','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
    }

    public function storeSubscription(Request $request){
        $data = $request->all();
        $subscriptionObj =  new Subscription;
        if(!empty($data['reepay-token'])){
            $subscriptionObj->user_id = Auth::user()->id;
            $subscriptionObj->plan = $data['plan_name'];
            $subscriptionObj->date = date('Y/m/d');
            $subscriptionObj->active = 1;
            $reepay = new Reepay;
            
            $user = Auth::user();
            if($data['plan_name'] == 'gold'){
                $user->user_subscription = 'level3';
            }else if($data['plan_name'] == 'silver'){
                $user->user_subscription = 'level2';
            }else{
                $user->user_subscription = 'level1';
            }

            $user->reepay_token = $data['reepay-token'];
            if($reepay->createSubscription($data['reepay-token'])){
                $subscriptionObj->save();
                $user->save();
                flash('Successfully Saved.','success');
                return redirect('home');                
            }
        }
        flash('Error in Payment.','error');
        return back();                
    }

    public function updatePlan(){
        if(!empty(Auth::user()->handle)){
            $data = array("timing" => 'immediate','plan'=>getPlanID("gold"));
            $handel = Auth::user()->handle;
            $reepay = new Reepay;
            if($reepay->changeUserPlan($handel,$data)){
                $user = Auth::user();
                $user->user_subscription = 'level3';
                $user->save();
                $subscription = $user->userSubscription()->where('active',1)->first();
                $subscription->plan = 'gold';
                $subscription->save();
                flash('Updated Successfully.','success');
                return redirect('home');                  
            }
            flash('Error in updating.','error');
            return redirect('home');                  
        }
        flash('Error. Cannot update','error');
        return redirect('home');
    }

    public function cancelPlan(){ //// need to discuss. will it be effective right on time or after time end
        if(!empty(Auth::user()->handle)){
            $handel = Auth::user()->handle;
            $reepay = new Reepay;
            if($reepay->cancelUserPlan($handel)){
                flash('Cancelation Successfully. Done','success');
                return redirect('home');                  
            }
            flash('Error in cancelation.','error');
            return redirect('home');                  
        }
        flash('Error. Cannot cancel','error');
        return redirect('home');
    }

    public function getUserPlan(){ //// need to discuss. will it be effective right on time or after time end
        /*if(!empty(Auth::user()->handle)){
            $handel = Auth::user()->handle;
            $reepay = new Reepay;
            if($reepay->checkSubscription($handel)){
                
                //return redirect('home');                  
            }
        }
        return redirect('home');*/   
        echo $_SERVER['DOCUMENT_ROOT'];
        exit;     
    }


    public function getUserPayemnts(){
        $packageObj = new Package;
        $packages = $packageObj->where('active',1)->get();
        $content = New Content;
        $contentData = $content->where('content_for','subscription')->first(); 
        $selectedManu = 'Profile';
        $contentData->contentImage();
        $title = 'Subscription';//$contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();

        $mobile = false;
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
        }
            
        $user = Auth::user();
        $postsObj =  new Posts;
        $feed3 = $postsObj->getUserNetworks(1,$user,$mobile);

        if(!empty(Auth::user()->reepay_customer_id)){
            $handel = Auth::user()->reepay_customer_id;
            $reepay = new Reepay;
            $invoices = $reepay->getInvoices($handel);
            return view('user.payments',compact('invoices','feed3','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
        }else{
            $invoices = false;
            return view('user.payments',compact('invoices','feed3','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
        }
    }

    public function saveuserBusiness(Request $request,$business){
        $data = $request->all();
        if(Auth::user()->user_type == 'business' ||  Auth::user()->user_subscription == 'level1' && !in_array($data['business'],array(96)) ){
            if(Auth::user()->user_type == 'business'){
                flash('Cannot Access to business Page.','error');
                return back();
            }
            flash('Cannot Access to business Page. Please subscribe to plan.','error');
            return redirect('subscription');
        }

        if( Auth::user()->user_subscription == 'level2'){
            $businessAdvert = new UserAdvert;
            $businessCount = $businessAdvert->where('active',1)->groupBy('business_user_id')->where('user_id')->count(); 
            if($businessCount > 200){
                flash('Please upgrade plan to subscribe to more businesses.','error');
                return redirect('subscription');
            } 
        }
        $businessAdvert = new UserAdvert;
        $businessSubscribed = $businessAdvert->where('user_id',Auth::user()->id)->where('business_user_id',$data['business'])->where('active',1)->first();
        if(Auth::user()->id != 17 && !empty($businessSubscribed) && !in_array($data['business'],array(96,93,101,114,113,284)) ){
            flash('Already Subscribed.','error');
            return redirect('home');
        }
        $user = User::find($data['business']);
        $data['user_data'] = $user;
        
        if(Auth::user()->user_subscription != 'level1' && Auth::user()->id != 17){
            $functionName = '__saveuserBusiness'.$business;
            $flag = $this->$functionName($request,$business,$data);
            if( $flag == true ) {
               $businessAdvert = new UserAdvert;
                $businessAdvert->user_id = Auth::user()->id;
                $businessAdvert->business_user_id = $data['business'];
                $businessAdvert->active = 1;
                $businessAdvert->save();
                flash('Success.','success');
            }
        }
        return redirect('home');
    }
    
    public function __saveuserBusinessif(Request $request,$business,$data){
        $name = 'emails.'.$business;
        Mail::send($name,$data,function($message) use ($data){
            $message->to($data['user_data']['email'])->subject('IF - Forespørgsel fra IVN')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }

    public function __saveuserBusinessbdo_gdpr(Request $request,$business,$data){
        $name = 'emails.'.$business;
        $emails = array($data['user_data']['email'],Auth::user()->email);
        $data['user'] = Auth::user()->toArray();
        Mail::send($name,$data,function($message) use ($data,$emails){
            $message->to($emails)->subject('Hjælp til GDPR')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');             
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }

    public function __saveuserBusinesslasertryk(Request $request,$business,$data){
        $name = 'emails.'.$business;
        $emails = array($data['user_data']['email'],Auth::user()->email);
        Mail::send($name,$data,function($message) use ($data,$emails){
            $message->to($emails)->subject('Her er din rabatkode til Lasertryk')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }

    public function __saveuserBusinessrefurb(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        $emails = array($data['user_data']['email'],Auth::user()->email);
        Mail::send($name,$data,function($message) use ($data,$emails){
            $message->to($emails)->subject('Her er din rabatkode til Refurb')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }
    public function __saveuserBusinesslinkedinsider(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        Mail::send($name,$data,function($message) use ($data){
            $message->to($data['user_data']['email'])->subject('LinkedInsider - Tilmelding til kursus')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }
    public function __saveuserBusinessselectedbyyou(Request $request,$business,$data){
        $name = 'emails.'.$business;

        $title = 'SBY - Tilmelding fra IVN: '.$request->title;
        //$data['user_data']['email']
        Mail::send($name,$data,function($message) use ($data,$title){
            $message->to($data['user_data']['email'])->subject($title)
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }

    public function __saveuserBusinesslendino(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        Mail::send($name,$data,function($message) use ($data){
            $message->to($data['user_data']['email'])->subject('Lendino - Forespørgsel fra IVN')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;

    }

    public function __saveuserBusinessglitnr(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        $emails = array($data['user_data']['email'],Auth::user()->email);
        Mail::send($name,$data,function($message) use ($data,$emails){
            $message->to($emails)->subject('Her er din Rabatkode til Glitnr')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;

    }

    public function __saveuserBusinesserhvervsakademi_dania(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        Mail::send($name,$data,function($message) use ($data){
            $message->to($data['user_data']['email'])->subject('Erhvervsakademi Dania - Tilmelding fra IVN ')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }

    public function __saveuserBusinessbilly_regnskabsprogram(Request $request,$business,$data){
        //$billyToken = config('constants.BILLYTOKEN')
        //$billy = new Billy($billyToken);

    }

    public function __saveuserBusinessbofinans(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        Mail::send($name,$data,function($message) use ($data){
            $message->to($data['user_data']['email'])->subject('Bofinans - Tilmelding fra IVN')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }
    public function __saveuserBusinessbdo_revision(Request $request,$business,$data){
        $name = 'emails.'.$business;
        //$data['user_data']['email']
        Mail::send($name,$data,function($message) use ($data){
            $message->to($data['user_data']['email'])->subject('BDO - Tilmelding fra IVN ')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');                          
        });
        if( count(Mail::failures()) > 0 ) {
            flash('Error signup.','error');
            return false;
        }
        return true;
    }

    public function __saveuserBusinessbetalingsgateway(Request $request,$business,$da){
        $data = $request->all();
        $businessAdvert = new UserAdvert;
        
        $fileArr = array('Billedlegitimation','Adresselegitimation','Tilfoj','ovrige','Vælg_filer','ovrige1','slip');
        $attachmentData = array();
        foreach($fileArr as $file1){
            if ($request->hasFile($file1)) {
                $destinationPath = 'business/'.$data['business'].'/';
                $file = $request->file($file1);
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $mime = $file->getClientMimeType();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $data[$file1] = $picture;
                $attachmentData[$file1] = array('path'=>$destinationPath.$picture,'mime'=>$mime,'as'=>$filename);
            }
        }
        $data['attachement'] = $attachmentData;
        $user = User::find($data['business']);
        $data['user_data'] = $user;
        //$data['user_data']['email']
        //config('constants.ADMIN_EMAIL')
        $emails = array($data['user_data']['email']); //'bl@pensopay.com',
        Mail::send('emails.business11',$data,function($message) use ($data,$emails){
            $message->to($emails)->subject('PensoPay - Tilmelding fra IVN')
            ->from('info@ivn.dk')->bcc('info@ivn.dk');
            foreach($data['attachement'] as $key=>$val){
                $message->attach($val['path'], array(
                    'as' => $val['as'], 
                    'mime' => $val['mime'])
                );
            }              
        });
        if( count(Mail::failures()) > 0 ){           
            flash('Error signup.','error');
            return false;
        }
        return true;        
    }
    
    function deleteProfile(){
        $user = Auth::user();
        $user->delete_me = 1;
        $user->active = 0;
        if($user->save()){
            $data = $user->toArray();
            Mail::send('emails.deletion_in_process',$data ,function($message) use ($data){
                $message->to($data['email'])->subject('Din bruger på IVN bliver slettet')
                ->from(config('constants.NO_REPLY_EMAIL'))->bcc('brian@whyorange.dk');
            });
            flash('Successfully Saved.','success');
            Auth::logout();
            return redirect('home');
        }
        flash('Error in deleting.','error');
        return back();
    }

    public function snedProfileInfo(){
        $data['user'] = $user = Auth::user()->toarray();
        $company = Auth::user()->companies()->where('active',1)->first();
        $data['company'] = array();
        if(!empty($company)){
            $data['company'] = $company->toArray();
        }

        if(!empty($data['user']['country'])){
            $countryData = Country::where('id',$data['user']['country'])->first();
            $data['user']['country'] = $countryData->name;
        }
        Mail::send('emails.send_profile_info',$data ,function($message) use ($data){
                $message->to($data['user']['email'])->subject('Dine informationer fra IVN')
                ->from(config('constants.NO_REPLY_EMAIL'))->bcc('brian@whyorange.dk');

                $file = 'uploads/profile/'.$data['user']['profile_image'];
                $as = 'profileImage';
                $mime = mime_content_type($file);
                $message->attach($file, array(
                    'as' => $as, 
                    'mime' =>$mime)
                );
            });
            

        flash('Successfully Sent.','success');
        return back();
    }


    public function addContectToList(){
       $sendGrid = new SandGrid;
       $user = Auth::user();
       $data['email'] = $user['email'];
       $data['first_name'] = $user['first_name'];
       $data['last_name'] = $user['last_name'];
       $sendGrid->sandgrid($data);
    }
}
