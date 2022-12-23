<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Content;
use App\ContentImage;
use Auth;
use DB;
class ContentImagesController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request,Content $content)
    {    
        $contentImageObj = new ContentImage;
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $contentImageObj = $contentImageObj->where('title', 'like', '%'.$keyword.'%');
        }
        $contentimages = $contentImageObj->where('content_id',$content->id)->orderBy('order','Asc')->paginate(10);
        return view('admin.ContentImages.index',compact('content','keyword','contentimages'));
    }

    public function create(Content $content){
    	return view('admin.ContentImages.create',compact('content'));
    }

    public function uploadFiles(Content $content) {
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );
 
        $validation = Validator::make($input, $rules);
 
        if ($validation->fails()) {
            return array($validation->errors->first(), 400);
        }
 
        $destinationPath = public_path('user_images'); // upload path
        $imageResize = public_path('user_resize_images');

        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
 		
 		cropCentered($destinationPath.'\\', $imageResize.'\\', $fileName, 1350,560 );
        make_thumb($imageResize.'\\' . $fileName, $destinationPath.'\\thumb_'.$fileName, 340, $extension);
                

 		$contentImageObj = new ContentImage;
 		
 		$title = Input::file('file')->getClientOriginalName();
 		$title = str_replace('.', '', $title);
 		$title = str_replace($extension, '', $title);
 		$contentImageObj->title = $title;
 		$contentImageObj->path = $fileName;
 		$contentImageObj->active = 1;
 		$order = $contentImageObj->orderBy('id', 'desc')->value('id');
 		$contentImageObj->order = ++$order;
 		
 		$content->contentImage()->save($contentImageObj);

        if ($upload_success) {
            return array('success'=> 200);
        } else {
            return array('error', 400);
        }
    }

    function showImage(ContentImage $contentImage, $action){
    	$contentImage->active = $action;
    	$contentImage->save();
    	return array('success'=> 200);
    }

    function makeDefault(ContentImage $contentImage, $action){
    	$contentImage->default_photo = $action;
    	$contentImage->save();
    	return array('success'=> 200);
    }

    public function delete(ContentImage $contentImage){
        $contentImage->delete();
        flash('Successfully deleted the Content Images!','success');
        return back();
    }

    public function reorder(Content $content){
        $contentImageObj = new ContentImage;
        $contentImages = $contentImageObj->where('content_id',$content->id)->orderBy('order','ASC')->get(); 
        $contentImagesList = array();
        foreach($contentImages as $image){
            $contentImagesList[$image->id] =  $image->title;
        }
        return view('admin.ContentImages.reorder',compact('content','contentImagesList'));
    }

    public function updateOrder(Request $request,Content $content){
        $idValArr = json_decode($request->order);
        $contentImg =new ContentImage;
        $counter = 1;
        foreach($idValArr as $img){
            $cImage = $contentImg->where('id',$img->id)->first();
            $cImage->order = $counter++;
            $cImage->save();
        }
        flash('Successfully Saved.','success');
        return redirect('admin/ContentImages/'.$content->id);
    }

    public function editInfo(Content $content,ContentImage $contentImg){
        return view('admin.ContentImages.editInfo',compact('content','contentImg'));
    }
    public function updateImageInfo(Request $request,Content $content,ContentImage $contentImg){
        $data = $request->all();
        $contentImg->title = $data['title'];
        $contentImg->description = $data['description'];
        $contentImg->save();
        return redirect('admin/ContentImages/'.$content->id);
    }
    
}
