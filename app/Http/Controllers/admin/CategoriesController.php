<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\Category;
use Auth;
use DB;

class CategoriesController extends Controller
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
        $categoryObj = new Category;
        $keyword = '';
        $active = '-1';
        
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $categoryObj = $categoryObj->Where('title', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $categoryObj = $categoryObj->Where('active', $request->active);
        }
        $categories = $categoryObj->paginate(20);
        return view('admin.Category.index',compact('categories','active','keyword'));
    }
    public function create(){
        return View('admin.Category.create');
    }
    public function store(Request $request){
        $rules = array(
            'title'       => 'required',
            'details' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Category/create')
                ->withErrors($validator)->withInput();
        } else {
            $category = new Category;
            $data = $request->all();
            //$content->uuid = String::uuid();
            $data['url'] = stringToSlug($data['title']);
            $data['details'] = htmlentities($data['details']);
            $destinationPath = 'uploads/category/';
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $data['image_path'] = $picture;
                make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
            }
            $category->create($data);
            flash('Successfully Saved.','success');
            return redirect('admin/Category');
        }
    }

    public function show(Category $category){
        return View('admin.Category.show',compact('category'));   
    }

    public function edit(Category $category){
        return View('admin.Category.edit',compact('category'));
    }

    public function update(Request $request,Category $category){
    // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
            'details' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Category/'.$category->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $categoryObj = new Category;
            $data = $request->all();
            $data['details'] = htmlentities($data['details']);
            unset($data['_method']);unset($data['_token']);
            if ($request->hasFile('image_path')) {
                $destinationPath = 'uploads/category/';
                $file = $request->file('image_path');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $data['image_path'] = $picture;
                make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
            }
            foreach($data as $field=>$value){                
                $category->$field = $value;
            }
            $category->url = stringToSlug($data['title']);
            $category->save();
            flash('Successfully updated Content!','success');
            return redirect('admin/Category');
        }
    }

    /*public function delete(Category $category){
        $category->delete();
        flash('Successfully deleted the Category!','success');
        return redirect('admin/Category');
    }*/

    public function addImage(Category $category){
        return view('admin.Category.addImage',compact('category'));
    }
    
    public function uploadImage(Request $request,Category $category){
        $file = $request->file('image_path');
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

            $image_location = $imagePath = 'uploads/category/';
            $imageResize = 'uploads/category/user_resize_images';
            
            //$image_location = sys_get_temp_dir().'/'.$imageName;
            if (!$file->move($image_location, $imageName)) {
                flash('UPLOADINGS_FAILED For Image','error');
            } else {
                flash('Image uploaded Successfully!','success');
                /// Make a center image
                cropCentered($imagePath.'/', $imageResize.'/', $imageNameOrg, 1919, 675);
                make_thumb($imageResize.'/' . $imageNameOrg, $imagePath.'/thumb_'.$imageNameOrg, 501, $extension);
                $category->image_path = $imageName;
                $category->update();
            }
        }else{
            flash('UPLOADINGS_FAILED For Image','error');
        }
        return redirect('admin/Category');
    }


    /***
    *   We are not going to delete the category permanently
    *
    */
    public function delete(Category $category,$status){
        $category->active = $status;
        $category->save();
        flash('Successfully Deleted!','success');
        return redirect('admin/Category');
    }

    public function resizeImages(){
        $categoryObj = new Category;
        $categories = $categoryObj->get();
        foreach($categories as $category){
            $destinationPath = 'uploads/category/';
            $imageArr = explode('.', $category->image_path);
            $lastIndex = count($imageArr);
            make_thumb($destinationPath.'/' . $category->image_path, $destinationPath.'/thumb_'.$category->image_path, 501, $imageArr[$lastIndex-1]);
        }
    }

    public function updateCrfUrl(){
        $categoryObj = new Category;
        $categories = $categoryObj->get();
        foreach($categories as $category){
            $category->url = stringToSlug($category->title);
            $category->save();
        }   
    }
}
