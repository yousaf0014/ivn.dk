<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Repositories\Offers;
use Illuminate\Http\Request;
use App\Network;
use App\Category;
use App\Post;
use App\User;
use App\PostComment;


class OffersController extends Controller
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
        $postObj = new Offers;
        $keyword = '';
        $active = '-1';
        
        if(isset($request->keyword)){
            $keyword = $request->keyword;            
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;            
        }
        $posts = $postObj->getOfferList();
        return View('admin.Offer.index',compact('posts','keyword','active'));
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
        return View('admin.Offer.create',compact('networksList','user'));
    }
    public function store(Request $request){
        $rules = array(
            'title'  => 'required',
            'details' => 'required'

        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('admin/Offer/create')
                ->withErrors($validator)->withInput();
        } else {
            $postObj = new Offers;        
            if($postObj->createOffer($request)){
                flash('Successfully Saved.','success');
            }else{
                flash('Error in Saving.','error');
            }
            return redirect('admin/business');
        }
    }

    public function show(Post $post){
        $postsObj = new Offers;
        $postData = $postsObj->getOfferData($post);
        return View('admin.Offer.show',compact('postData'));   
    }

    public function edit(Post $post){
        $postObj = new Offers;
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
            $selectedNetworks = $postObj->offerNetworks($post,true);
            return View('admin.Offer.edit',compact('post','networksList','selectedNetworks'));
        }else{
            flash('Can Not Edit Offer','warning');
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
            return Redirect::to('admin/Offer/'.$post->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $postObj = new Offers;
            if($postObj->updateOffer($request,$post)){
                flash('Successfully updated Offer!','success');
            }else{
                flash('Unable to updated Offer! Please try again later','error');
            }
            
            return redirect('admin/business');
        }
    }

    
    /***
    *   We are not going to delete the category permanently
    *
    */
    public function delete(Post $post,$status){
        $postObj = new Offers;
        if($postObj->deleteOffer($post,$status)){
            flash('Successfully Deleted!','success');    
        }else{
            flash('Error in deleteing! Please try again later','error');    
        }
        return redirect('admin/Offer');
    }

}