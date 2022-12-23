<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Content;
use App\User;
use Auth;
use DB;

class ContentsController extends Controller
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
        $contentObj = new Content;
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $contentObj = $contentObj->Where('title', 'like', '%'.$keyword.'%');
            $contentObj = $contentObj->orWhere('link_title', 'like', '%'.$keyword.'%');
        }
        $bustinessData = User::where('user_type','business')->where('active',1)->get();
        $bustinessList =  array();
        foreach($bustinessData as $user){
            $bustinessList[$user->id] = $user->first_name.' '.$user->last_name;
        }
        $contents = $contentObj->paginate(20);
        return view('admin.Contents.index',compact('contents','keyword','bustinessList'));
    }
    public function create(){
        $contentObj = new Content;
        $businessData =  User::where('user_type','business')->where('active',1)->get();
        $bustinessList[0] =  '-- Select Business --';
        foreach($businessData as $content){
            $bustinessList[$content->id] = $content->first_name.' '.$content->last_name;
        }
        
        return View('admin.Contents.create',compact('bustinessList'));
    }
    public function store(Request $request){
        $rules = array(
            'title'       => 'required',
            'link_title'      => 'required',
            'content' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Contents/create')
                ->withErrors($validator)->withInput();
        } else {
            $content = new Content;
            $data = $request->all();
            //$content->uuid = String::uuid();
            $data['content_for'] = stringToSlug($data['title']);
            $data['url'] = 'Pages/display/' . $data['content_for'];
            $sequence = $content->orderBy('sequence', 'desc')->value('sequence');
            $data['sequence'] = $sequence + 1;
            $data['content'] = htmlentities($data['content']);
            $data['extra_content'] = htmlentities($data['extra_content']);
            $content->create($data);
            flash('Successfully Saved.','success');
            return redirect('admin/Contents');
        }
    }

    public function show(Content $content){
        $contentObj = new Content;
        $parantName = '';
        if(!empty($content->parent_id)){
            $businessData = User::where('id', $content->parent_id)->first();        
            $parantName = $businessData->first_name.' '.$businessData->last_name;
        }
        return View('admin.Contents.show',compact('content','parantName'));   
    }

    public function edit(Content $content){
        $contentObj = new Content;
        $businessData =  User::where('user_type','business')->where('active',1)->get();
        $bustinessList[0] =  '-- Select Business --';
        foreach($businessData as $user){
            $bustinessList[$user->id] = $user->first_name.' '.$user->last_name;
        }
        return View('admin.Contents.edit',compact('pageslist','content','bustinessList'));
    }

    public function update(Request $request,Content $content){
    // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
            'link_title'      => 'required',
            'content' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Contents/'.$content->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $contentObj = new Content;
            $data = $request->all();
            $data['content'] = htmlentities($data['content']);
            $data['extra_content'] = htmlentities($data['extra_content']);
            unset($data['_method']);unset($data['_token']);
            foreach($data as $field=>$value){                
                $content->$field = $value;
            }
            $content->save();
            flash('Successfully updated Content!','success');
            return redirect('admin/Contents');
        }
    }

    public function delete(Content $content){
        $content->delete();
        flash('Successfully deleted the Content!','success');
        return redirect('admin/Contents');
    }

    public function addImage(Content $content){
        return view('admin.Contents.addImage',compact('content'));
    }
    
    public function uploadImage(Request $request,Content $content){
        $file = $request->file('image');
        $img1 = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();      
        $userfile_tmp = $file->getRealPath();
        $size = $file->getSize();
        $file_type = $file->getMimeType();
        $destinationPath = 'uploads';
        
        $image_types = Array("image/jpg", "image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/x-png");
        if ($extension == 'pjpeg'){
            $extension = 'jpeg';
        }
        if ($extension == 'x-png'){
            $extension = 'png';
        }

        if (in_array(strtolower($file_type), $image_types)) {
            $imageName = $imageNameOrg = uniqid() . '.' . $extension;

            $image_location = $imagePath = 'user_images';
            $imageResize = 'user_resize_images';
            
            //$image_location = sys_get_temp_dir().'/'.$imageName;
            if (!$file->move($image_location, $imageName)) {
                flash('UPLOADINGS_FAILED For Image','error');
            } else {
                flash('Image uploaded Successfully!','success');
                $content->image_path = $imageName;
                /// Make a center image
                cropCentered($imagePath.'/', $imageResize.'/', $imageNameOrg, 1350, 560);
                make_thumb($imageResize.'/' . $imageNameOrg, $imagePath.'/thumb_'.$imageNameOrg, 340, $extension);
                $content->save();
            }
        }else{
            flash('UPLOADINGS_FAILED For Image','error');
        }
        return redirect('admin/Contents');
    }


    public function showImage(Content $content , $action) {
        $content->show_image = $action;
        $content->save();
        exit;
    }
    public function showgallery(Content $content , $action) {
        $content->show_gallery = $action;
        $content->save();
        exit;
    }
    public function gallery(Content $content){
        return view('admin.Contents.gallery',compact('content'));
    }

    public function reorder(){
        $contentObj = new Content;
        $contents = $contentObj->orderBy('sequence','ASC')->get(); 
        $contentsList = array();
        $mainArr = $childArr = array();
        foreach($contents as $cnt){
            if(!empty($cnt->parent_id)){
                $childArr[$cnt->parent_id] = $cnt->parent_id; 
            }
            $mainArr[$cnt->id] =  $cnt->toArray();
        }
        while(!empty($childArr)){
            foreach($mainArr as $id=>$cnt){
                if(!isset($childArr[$cnt['id']])){
                    if(!empty($cnt['parent_id'])){
                        $mainArr[$cnt['parent_id']]['child'][] = $cnt;
                        unset($mainArr[$id]);unset($mainArr[$id]['child']);
                    }
                    
                }
            }
            $childArr = array();
            foreach($mainArr as $id=>$cnt){
                if(!empty($cnt['parent_id'])){
                    $childArr[$cnt['parent_id']] = $cnt['parent_id'];
                }
            }
        }
        $contentsList = $mainArr;
        return view('admin.Contents.reorder',compact('contentsList'));
    }
   
    public function updateOrder(Request $request){
        $idValArr = json_decode($request->order);
        $content = new Content;
        $counter = 1;
        foreach($idValArr as $cnt){
            $cont = $content->where('id',$cnt->id)->first();
            $cont->sequence = $counter++;
            $cont->parent_id = 0;
            $id = $cont->save();
            if(isset($cnt->children)){
                foreach($cnt->children as $child){
                    $childData = $content->where('id',$child->id)->first();
                    $childData->parent_id = $cont->id;
                    $childData->sequence = $counter++;
                    $childData->save();
                }
            }

        }
        flash('Successfully Saved.','success');
        return redirect('admin/Contents/');
    }

    public function editInfo(Content $content){
        return view('admin.Contents.editInfo',compact('content'));
    }

    public function updateImageInfo(Request $request,Content $content){
        $data = $request->all();
        $content->image_title = $data['image_title'];
        $content->image_details = $data['image_details'];
        $content->save();
        return redirect('admin/Contents');
    }
    
}
