<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Package;
use App\Category;
use Auth;
use DB;

class PackagesController extends Controller
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
        $packageObj = new Package;
        $keyword = '';
        $active = '-1';

        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $packageObj = $packageObj->Where('title', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $packageObj = $packageObj->Where('active', $request->active);
        }
        $packages = $packageObj->paginate(20);
        return view('admin.Package.index',compact('packages','active','keyword'));
    }
    public function create(){
        return View('admin.Package.create');
    }
    public function store(Request $request){
        $rules = array(
            'title'       => 'required',
            'details' => 'required',
            'price'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Package/create')
                ->withErrors($validator)->withInput();
        } else {
            $package = new Package;
            $data = $request->all();
            //$content->uuid = String::uuid();
            $data['details'] = htmlentities($data['details']);
            $destinationPath = 'uploads/package/';
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $data['image_path'] = $picture;
                make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
            }
            $package->create($data);
            flash('Successfully Saved.','success');
            return redirect('admin/Package');
        }
    }

    public function show(Package $package){
        return View('admin.Package.show',compact('package'));   
    }

    public function edit(Package $package){
        return View('admin.Package.edit',compact('package'));
    }

    public function update(Package $package,Request $request){
        $rules = array(
            'title'       => 'required',
            'details' => 'required',
            'price'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Package/'.$package->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $data = $request->all();
            $data['details'] = htmlentities($data['details']);
            unset($data['_method']);unset($data['_token']);
            if ($request->hasFile('image_path')) {
                $destinationPath = 'uploads/package/';
                $file = $request->file('image_path');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $data['image_path'] = $picture;
                make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
            }
            foreach($data as $field=>$value){                
                $package->$field = $value;
            }

            $package->save();
            flash('Successfully updated Package!','success');
            return redirect('admin/Package');
        }
    }

    public function addImage(Package $package){
        return view('admin.Package.addImage',compact('package'));
    }
    
    public function uploadImage(Request $request,Package $package){
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

            $image_location = $imagePath = 'uploads/package/';
            $imageResize = 'uploads/package/user_resize_images';
            
            //$image_location = sys_get_temp_dir().'/'.$imageName;
            if (!$file->move($image_location, $imageName)) {
                flash('UPLOADINGS_FAILED For Image','error');
            } else {
                flash('Image uploaded Successfully!','success');
                /// Make a center image
                cropCentered($imagePath.'/', $imageResize.'/', $imageNameOrg, 1919, 675);
                make_thumb($imageResize.'/' . $imageNameOrg, $imagePath.'/thumb_'.$imageNameOrg, 501, $extension);
                $package->image_path = $imageName;
                $package->update();
            }
        }else{
            flash('UPLOADINGS_FAILED For Image','error');
        }
        return redirect('admin/Package');
    }


    /***
    *   We are not going to delete the category permanently
    *
    */
    public function status(Package $package,$status){
        $package->active = $status;
        $package->save();
        flash('Successfully Deleted!','success');
        return redirect('admin/Package');
    }

    public function delete(Package $package){
        $package->delete();
        flash('Successfully deleted the Package!','success');
        return back();
    }
}