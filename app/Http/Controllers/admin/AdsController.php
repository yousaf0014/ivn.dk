<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Repositories\Ads;
use Illuminate\Http\Request;
use App\Network;
use App\Category;
use App\Post;
use App\PostComment;
use App\User;

class AdsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $postObj = new Ads;
        $keyword = '';
        $active = '-1';
        if(isset($request->keyword)){
            $keyword = $request->keyword;            
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;            
        }
        $posts = $postObj->getAdList();
        $users = User::where('user_type','business')->where('active',1)->get();
        return View('admin.Ad.index',compact('posts','keyword','active','users'));
    }
    public function create(User $user,Request $request){
        $networkObj = new Network;
        $networks = $networkObj->select('id','title','category_id')->get();
        $categoryObj = new Category;
        $categoryData = $categoryObj->select('id','title')->get();
        $catList = $networksList = array();
        foreach($categoryData as $cat){
            $catList[$cat->id] = $cat->title;
        }
        foreach($networks as $net){
            $parent = !empty($catList[$net->category_id]) ? ' ('.$catList[$net->category_id].')':'';
            $networksList[$net->id] = $net->title.$parent;
        }
        return View('admin.Ad.create',compact('networksList','user'));
    }
    public function store(Request $request){
        $rules = array(
            'title'  => 'required',
            'details' => 'required'

        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('admin/Ad/create')
                ->withErrors($validator)->withInput();
        } else {
            $postObj = new Ads;        
            if($postObj->createAd($request)){
                flash('Successfully Saved.','success');
            }else{
                flash('Error in Saving.','error');
            }
            return redirect('admin/business/');
        }
    }

    public function show(Post $post){
        $postsObj = new Ads;
        $postData = $postsObj->getAdData($post);
        $users = User::where('user_type','business')->where('active',1)->get();
        return View('admin.Ad.show',compact('postData','users'));   
    }

    public function edit(Post $post){
        $postObj = new Ads;
        if($postObj->canEdit($post)){
            $networkObj = new Network;
            $networks = $networkObj->select('id','title','category_id')->get();
            $categoryObj = new Category;
            $categoryData = $categoryObj->select('id','title')->get();
            $catList = $networksList = array();
            foreach($categoryData as $cat){
                $catList[$cat->id] = $cat->title;
            }
            foreach($networks as $net){
                $parent = !empty($catList[$net->category_id]) ? ' ('.$catList[$net->category_id].')':'';
                $networksList[$net->id] = $net->title.$parent;
            }
            $selectedNetworks = $postObj->adNetworks($post,true);
            $users = User::where('user_type','business')->where('active',1)->get();
            return View('admin.Ad.edit',compact('post','networksList','selectedNetworks','users'));
        }else{
            flash('Can Not Edit Ad','warning');
            return redirect('admin/business');
        }
    }

    public function update(Request $request,Post $post){
    // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
            'details' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Ad/'.$post->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $postObj = new Ads;
            if($postObj->updateAd($request,$post)){
                flash('Successfully updated Ad!','success');
            }else{
                flash('Unable to updated Ad! Please try again later','error');
            }
            
            return redirect('admin/business');
        }
    }

    
    /***
    *   We are not going to delete the category permanently
    *
    */
    public function delete(Post $post,$status){
        $postObj = new Ads;
        if($postObj->deleteAd($post,$status)){
            flash('Successfully Deleted!','success');    
        }else{
            flash('Error in deleteing! Please try again later','error');    
        }
        return redirect('admin/Ad');
    }

    public function saveUserAd(Request $request){
        
    }

}