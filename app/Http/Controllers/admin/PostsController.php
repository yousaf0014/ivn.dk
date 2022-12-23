<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Repositories\Posts;
use Illuminate\Http\Request;
use App\Network;
use App\Category;
use App\Post;
use App\PostComment;


class PostsController extends Controller
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


    function getCommnets(){
        
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $postObj = new Posts;
        $keyword = '';
        $active = '-1';
        
        if(isset($request->keyword)){
            $keyword = $request->keyword;            
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;            
        }
        $posts = $postObj->getPostList();
        return View('admin.Post.index',compact('posts','keyword','active'));
    }
    public function create(Request $request){
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
        return View('admin.Post.create',compact('networksList'));
    }
    public function store(Request $request){
        $rules = array(
            'title'  => 'required',
            'details' => 'required'

        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('admin/Post/create')
                ->withErrors($validator)->withInput();
        } else {
            $postObj = new Posts;        
            if($postObj->createPost($request)){
                flash('Successfully Saved.','success');
            }else{
                flash('Error in Saving.','error');
            }
            return redirect('admin/Post');
        }
    }

    public function show(Post $post){
        $postsObj = new Posts;
        $postData = $postsObj->getPostData($post);
        return View('admin.Post.show',compact('postData'));   
    }

    public function edit(Post $post){
        $postObj = new Posts;
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
            $selectedNetworks = $postObj->postNetworks($post,true);
            return View('admin.Post.edit',compact('post','networksList','selectedNetworks'));
        }else{
            flash('Can Not Edit Post','warning');
            return redirect('admin/Post');
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
            return Redirect::to('admin/Post/'.$post->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $postObj = new Posts;
            if($postObj->updatePost($request,$post)){
                flash('Successfully updated Post!','success');
            }else{
                flash('Unable to updated Post! Please try again later','error');
            }
            
            return redirect('admin/Post');
        }
    }

    
    /***
    *   We are not going to delete the category permanently
    *
    */
    public function delete(Post $post,$status){
        $postObj = new Posts;
        if($postObj->deletePost($post,$status)){
            flash('Successfully Deleted!','success');    
        }else{
            flash('Error in deleteing! Please try again later','error');    
        }
        return redirect('admin/Post');
    }

    public function ratepost(Request $request){
        $postsObj = new Posts;
        $outArr = $postsObj->saveRate($request);
        if($outArr['flag'] !== false){
             return "{$outArr['rate']}";    
        }
        return "false";
    }

    public function postCommnet(Post $post,$comment){
        $postsObj = new Posts;
        $flag = $postsObj->canAddEditComment($comment);
        $commentData;
        if($flag != false){
            $commentData = $postsObj->getComment($comment);
        }
        return View('admin.Post.comment',compact('post','commentData','comment','flag'));
    }

    public function storeComment(Request $request,Post $post,$comment){
        $postsObj = new Posts;
        if($postsObj->storeComment($request,$post,$comment) != false){
             flash('Successfully Saved Comment!','success');    
        }else{
            flash('Error in saving! Please try again later','error');    
        }
        return back();
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

    public function resizeImages(){
        $postObj = new Post;
        $posts = $postObj->get();
        foreach($posts as $post){
            if(!empty($post->image_path)){
                $destinationPath = 'uploads/';
                if($post->type == 'post'){
                    $destinationPath .= 'Post/';
                }else if($post->type == 'ad'){
                    $destinationPath .= 'Ad/';
                }else if($post->type == 'offer'){
                    $destinationPath .= 'Offer/';
                }
                $imageArr = explode('.', $post->image_path);
                $lastIndex = count($imageArr);
                make_thumb($destinationPath.'/' . $post->image_path, $destinationPath.'/thumb_'.$post->image_path, 501, $imageArr[$lastIndex-1]);
            }
        }
    }
}