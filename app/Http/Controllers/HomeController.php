<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Content;
use App\User;
use App\Repositories\Posts;
use App\Repositories\Ads;
use App\Repositories\Offers;
use App\ContactUs;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postsOb = new Posts;
        $stickyPost = $postsOb->getStickyPost();

        $news = $postsOb->getLatestNews();
        $networks = $postsOb->getNonSubscribedNetwork($request,0,true);
        $business = $postsOb->getNonSubscribedBusiness();
        $firslogin = $request->session()->pull('first_login',0);
        $mobileData = $networkForPage = $otherPosts = array();
        $mobile = false;
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
        }
        $feed1 = $feed2 = array();
        $feed1 = $postsOb->getUserNetworkPosts(1,true,$mobile);
        $feedFlag1 = true;
        if(empty($feed1)){
            $feed1 = $postsOb->getUserNetworkPosts(2,false,$mobile);            
            $feedFlag1 = false;
        }
        
        $feed2 = $postsOb->getUserNetworkPosts(1,false,$mobile);
        $networkForPage = $postsOb->getNonSubscribedNetwork($request,1,false,$mobile);
        $adsObj = new Ads;
        $ads = $adsObj->getAds($request,$mobile); // need to change with respect to business subscribed
        $lastCol = arrangeAdColData($ads,$networkForPage);
        if($mobile){
            $mobileData = $this->__arrangeHomeDataForMobile($feed1,$feed2,$lastCol);
        }
        $content = New Content;
        $contentData = $content->where('content_for','home')->first(); 
        $selectedManu = 'home';
        $title = 'home';
        $contentData->contentImage();
        //$title = $contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        return view('home.index',compact('stickyPost','firslogin','mobileData','mobile','lastCol','feedFlag1','feed1','feed2','news','business','networks','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
    }

    public function getComments(Request $request){
        $data = $request->all();
        $postsObj = new Posts;
        $comments = $postsObj->getComments($data);
        return view('postComments',compact('comments'));
    }

    public function loadPages(Request $request){
        $function = $request->option;
        $page = $request->page;
        $postsObj = new Posts;
        $postData = array();
        $mobile = false;
        $controller = '';
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile = true;
            $feed1 = $postsObj->getUserNetworkPosts($page,true,$mobile);
            $feed2 = $postData = $postsObj->getUserNetworkPosts($page,false,$mobile);
            $networkForPage = $postsObj->getNonSubscribedNetwork($request,$page,false,$mobile);
            $adsObj = new Ads;
            $ads = $adsObj->getAds($request,$mobile); // need to change with respect to business subscribed
            $lastCol = arrangeAdColData($ads,$networkForPage);
            $mobileData = $this->__arrangeHomeDataForMobile($feed1,$feed2,$lastCol);
            $file = 'home';
            $url  = url('home/loadPages').'?&page='.($page+1).'&file='.$file;
            return view('loadMobilePages',compact('mobileData','page','file','url'));
        }else{
            if(empty(Auth::user()->id)){  //// As user is not logged in so no user post, so other post even act as user, odd as other
                if($function == 'user'){
                    $function = 'other';
                    $page = $page%2 != 0 ? $page:$page+1;
                }else{
                    $page = $page%2 == 0 ? $page: $page+1;
                }
            }
            if($request->file == 'home'){
                if($function == 'user'){
                    $postData = $postsObj->getUserNetworkPosts($page,true,$mobile);                    
                }else if($function == 'other'){
                    
                    $postData = $postsObj->getUserNetworkPosts($page,false,$mobile);                    
                }else if($function == 'network'){
                    $networkForPage = $postsObj->getNonSubscribedNetwork($request,$page,false,$mobile);
                    $adsObj = new Ads;
                    $ads = $adsObj->getAds($request,$mobile,$page); // need to change with respect to business subscribed
                    $postData = arrangeAdColData($ads,$networkForPage); 
                    $controller = 'home';            
                }
            }
            $type = $function == 'network'? 'network':'post';
            $url  = url('home/loadPages').'?option='.$request->option.'&page='.($page+1).'&file='.$request->file;
            return view('loadPages',compact('postData','type','controller','url'));
        }
    }

    function __arrangeHomeDataForMobile($feed1, $feed2,$feed3){
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
            $colArr[$index] = $feed3[0];
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
            $colArr[$index] = $feed3[1];
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
            $colArr[$index] = $feed3[2];
            $index++;
        }
        if(!empty($feed1['Post'][3])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][3];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][3]->id]) ? $feed1[$feed1['Post'][3]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][3])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][3];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][3]->id]) ? $feed2[$feed2['Post'][3]->id]:array();
            $index++;
        }
        if(!empty($feed3[3])){
            $colArr[$index] = $feed3[3];
            $index++;
        }
        if(!empty($feed1['Post'][4])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][4];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][4]->id]) ? $feed1[$feed1['Post'][4]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][4])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][4];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][4]->id]) ? $feed2[$feed2['Post'][4]->id]:array();
            $index++;
        }
        if(!empty($feed3[4])){
            $colArr[$index] = $feed3[4];
            $index++;
        }

        if(!empty($feed1['Post'][5])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][5];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][5]->id]) ? $feed1[$feed1['Post'][5]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][5])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][5];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][5]->id]) ? $feed2[$feed2['Post'][5]->id]:array();
            $index++;
        }
        if(!empty($feed3[5])){
            $colArr[$index] = $feed3[5];
            $index++;
        }

        if(!empty($feed1['Post'][6])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed1['Post'][6];
            $colArr[$index]['PostExtraData'] = !empty($feed1[$feed1['Post'][6]->id]) ? $feed1[$feed1['Post'][6]->id]:array();
            $index++;
        }
        if(!empty($feed2['Post'][6])){
            $colArr[$index]['type'] = 'post';
            $colArr[$index]['data'] = $feed2['Post'][6];
            $colArr[$index]['PostExtraData'] = !empty($feed2[$feed2['Post'][6]->id]) ? $feed2[$feed2['Post'][6]->id]:array();
            $index++;
        }
        if(!empty($feed3[6])){
            $colArr[$index] = $feed3[6];
            $index++;
        }
        return $colArr;
    }

    

    public function minor()
    {
        return view('home.minor');
    }

    public function profile(){
        dd(Auth::user());
    }

    public function uniqeEmail(Request $request){
        $user = new User;
        $data = $request->all();
        if(!empty($data['id'])){
            $user = $user->where('id',$data['id']);
        }
        $user = $user->where('email',$data['email']);
        $users = $user->first();
        if(empty($users)){
            return 'true';
        }
        return 'false';
    }

    public function pages($content_for){
        $content = New Content;
        $contentData = $content->where('content_for',$content_for)->first(); 
        $selectedManu = 'home';
        if(!empty($contentData)){
            $contentData->contentImage();
            $title = $contentData->title;
            $title_for_layout = $contentData->title;
            $description_for_layout = $contentData->page_description;
            $keywords_for_layout = $contentData->page_keywords;
            $meta_title_content = $contentData->meta_title_content;        
        }else{
            $title = $content_for;
            $title_for_layout = $content_for;
            $description_for_layout = $content_for;
            $keywords_for_layout = $content_for;
            $meta_title_content = $content_for;
            $contentData = $content_for;
        }
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        return view('home.pages',compact('title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));   
    }

    public function contact_us(){
        $content = new Content;
        $contentData = $content->where('content_for','contact_us')->first(); 
        $selectedManu = 'home';
        $contentData->contentImage();
        $title = $contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;        
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        return view('home.contact_us',compact('title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
    }

    public function store_contact_us(Request $request){
        $data = $request->all();
        $contact = new ContactUs;
        if($contact->create($data)){
            Mail::send('emails.contact_mail',$data,function($message) use ($data){
                $message->to($data['email'],$data['first_name'].' '.$data['last_name'])->subject(cmskey('contact_us_email_subject_text'))
                ->from('info@ivn.dk')->bcc('info@ivn.dk');             
            });
            if( count(Mail::failures()) > 0 ) {
               echo "There was one or more failures. They were: <br />";
               foreach(Mail::failures() as $email_address) {
                   echo " - $email_address <br />";
                }
            }
            flash('Success.','success');
        }else{
            flash('Error please try later.','error');
        }
        return back();            
    }
    
}
