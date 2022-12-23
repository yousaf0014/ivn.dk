<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Category;
use App\Network;
use Auth;
use DB;

class NetworksController extends Controller
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
    public function index(Request $request,Category $category)
    {    
        $networkObj = new Network;
        $networkObj = $networkObj->where('category_id',$category->id);
        $keyword = '';
        $active = '-1';
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $networkObj = $networkObj->Where('title', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $networkObj = $networkObj->Where('active', $request->active);
        }
        $networks = $networkObj->paginate(20);
        return view('admin.Network.index',compact('networks','keyword','category','active'));
    }
    public function create(Category $category){
        return View('admin.Network.create',compact('category'));
    }
    public function store(Category $category,Request $request){
        $rules = array(
            'title'       => 'required',
            'details' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Network/create/'.$category->id)
                ->withErrors($validator)->withInput();
        } else {
            $network = new Network;
            $data = $request->all();
            //$content->uuid = String::uuid();
            $network->title = $data['title'];
            $network->url = stringToSlug($data['title']);
            $network->details = htmlentities($data['details']);
            $destinationPath = 'uploads/network/';
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $network->image_path = $picture;
                make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
            }

            $category->network()->save($network);
            flash('Successfully Saved.','success');
            return redirect('admin/Network/'.$category->id);
        }
    }

    public function show(Network $network){
        $categoryObj = new Category;
        $category = $categoryObj->find($network->category_id);
        return View('admin.Network.show',compact('network','category'));   
    }

    public function edit(Network $network){
        $category = Category::find($network->category_id);
        return View('admin.Network.edit',compact('network','category'));
    }

    public function update(Request $request,Network $network){
    // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
            'details' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Network/'.$network->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $networkObj = new Network;
            $data = $request->all();
            $data['details'] = htmlentities($data['details']);
            unset($data['_method']);unset($data['_token']);
            if ($request->hasFile('image_path')) {
                $destinationPath = 'uploads/network/';
                $file = $request->file('image_path');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His-').$filename;
                $file->move($destinationPath, $picture);
                $data['image_path'] = $picture;
                make_thumb($destinationPath.'/' . $picture, $destinationPath.'/thumb_'.$picture, 501, $extension);
            }
            foreach($data as $field=>$value){                
                $network->$field = $value;
            }
            $network->url = stringToSlug($network->title);
            $network->save();
            flash('Successfully updated Network!','success');
            return redirect('admin/Network/'.$network->category_id);
        }
    }

    public function deleteNetwork(Network $network){
        $network->delete();
        flash('Successfully deleted the Network!','success');
        return redirect('admin/Network/'.$network->category_id);
    }

    public function addImage(Network $network){
        return view('admin.Network.addImage',compact('network'));
    }
    
    public function uploadImage(Request $request,Network $network){
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

            $image_location = $imagePath = 'uploads/network/';
            $imageResize = 'uploads/network/user_resize_images';
            
            //$image_location = sys_get_temp_dir().'/'.$imageName;
            if (!$file->move($image_location, $imageName)) {
                flash('UPLOADINGS_FAILED For Image','error');
            } else {
                flash('Image uploaded Successfully!','success');
                /// Make a center image
                cropCentered($imagePath.'/', $imageResize.'/', $imageNameOrg, 1919, 675);
                make_thumb($imageResize.'/' . $imageNameOrg, $imagePath.'/thumb_'.$imageNameOrg, 501, $extension);
                $network->image_path = $imageName;
                $network->update();
            }
        }else{
            flash('UPLOADINGS_FAILED For Image','error');
        }
        return redirect('admin/Network/'.$network->category_id);
    }


    /***
    *   We are not going to delete the category permanently
    *
    */
    public function delete(Network $network,$status){
        $network->active = $status;
        $network->save();
        flash('Successfully Deleted!','success');
        return redirect('admin/Network/'.$network->category_id);
    }

    public function resizeImages(){
        $networkObj = new Network;
        $networks = $networkObj->get();
        foreach($networks as $network){
            $destinationPath = 'uploads/network/';
            $imageArr = explode('.', $network->image_path);
            $lastIndex = count($imageArr);
            make_thumb($destinationPath.'/' . $network->image_path, $destinationPath.'/thumb_'.$network->image_path, 501, $imageArr[$lastIndex-1]);
        }
    }

    public function updateCrfUrl(){
        $networkObj = new Network;
        $networks = $networkObj->get();
        foreach($networks as $network){
            $network->url = stringToSlug($network->title);
            $network->save();
        } 
        exit;  
    }
}