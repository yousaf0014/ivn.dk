<?php
namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Carbon\Carbon;
use App\Category;
use App\Company;
use App\Country;
use App\User;
use App\Content;
use App\Post;
use Session;
use Auth;


class UsersController extends Controller
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
     * List users
     * @return unknown
     */
    public function index(Request $request)
    {
        $userObj = new User;
        $keyword = '';
        $active = '-1';
        $userObj = $userObj->where('user_type','!=','business');
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $userObj = $userObj->Where('first_name', 'like', '%'.$keyword.'%');
            $userObj = $userObj->orWhere('last_name', 'like', '%'.$keyword.'%');
            $userObj = $userObj->orWhere('email', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $userObj = $userObj->Where('active', $request->active);
        }
        $userObj = $userObj->where('id', '!=', Auth::id());
        $users = $userObj->paginate(5);
        $countryObj = New Country;
        $countriesData = $countryObj->get();
        $countries = array();
        foreach($countriesData as $val){
            $countries[$val->id] = $val->name;
        }
        return view('admin.user.index',compact('users','keyword','active','countries'));
    }
    
    public function create(){
        $countryObj = New Country;
        $countries = $countryObj->get();
        return View('admin.user.create',compact('countries'));
    }

    public function store(Request $request){
        $user = new User;
        $data = $request->all();
        //$content->uuid = String::uuid();
        $destinationPath = 'uploads/profile/';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);    
            $data['profile_image'] = $picture;
        }else{
            $data['profile_image'] = 'user_profile_Default.png';
        }
        if(!empty($data['password'])){
            $data['password'] =  bcrypt( $data['password'] );
        }else{
            unset($data['password']);
        }
        $user->create($data);
        flash('Successfully Saved.','success');
        return redirect('/admin/users');
    }

    public function uniqueEmail(Request $request){
        $user = new User;
        $data = $request->all();
        if(!empty($data['id'])){
            $user = $user->where('id',$data['id']);
        }
        $user = $user->where('email',$data['email']);
        $users = $user->first();
        if(empty($users)){
            return 'ture';
        }
        return 'false';
    }
    /**
     * Edit user form
     * @param unknown $userid
     * @return unknown
     */
    public function edit($userid)
    {
        $countryObj = New Country;
        $countries = $countryObj->get();
        $user = User::where('id', $userid)->get();
        return view('admin.user.edit', [
            'user'          => $user[0],
            'countries' =>$countries
        ]);
    }
    
    /**
     * Save user data into DB
     * @param Request $request
     * @return unknown
     */
    public function save(Request $request)
    {   
        $data = $request->all();
        unset($data['_token']);
        $destinationPath = 'uploads/profile/';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);    
            $data['profile_image'] = $picture;
        }
        if(!empty($data['password'])){
            $data['password'] =  bcrypt( $data['password'] );
        }else{
            unset($data['password']);
        }
        if($request->input('id')){
            User::where('id', $request->input('id'))->update($data);
                
            Session::flash('success', 'Data updated successfully.');
            return redirect('admin/users');
        }
    }
    
    /**
     * Admin landing page upon login
     * @return unknown
     */
    public function profile(){
        $countryObj = New Country;
        $countriesData = $countryObj->get();
        $countries = array();
        foreach($countriesData as $val){
            $countries[$val->id] = $val->name;
        }
        return view('admin.user.profile',compact('countries'));
    }
    
    /**
     * Save admin data into DB
     * @param Request $request
     * @return unknown
     */
    public function profileSave(Request $request)
    {
    
        $data = [
            'first_name'            => $request->input('first_name'),
            'last_name'         => $request->input('last_name'),
            'country'       => $request->input('country'),
            'mobile'        => $request->input('mobile'),
        ];
    
        $destinationPath = 'uploads/profile/';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);    
            $data['profile_image'] = $picture;
        }
        if(!empty($data['password'])){
            $data['password'] =  bcrypt( $data['password'] );
        }else{
            unset($data['password']);
        }
        if($request->input('id')){
            User::where('id', $request->input('id'))->update($data);
    
            Session::flash('success', 'Data updated successfully.');
            return redirect('admin/profile/');
        }
    }


    /**
    * This function just deactive the user no permanent deletion in the system
    * Take id and status
    *///

    public function delete(User $user,$status){
        $user->active = $status;
        $user->save();
        flash('Successfully Deleted!','success');
        return redirect('admin/users/');
    }

    public function businessindex(Request $request)
    {
        $userObj = new User;
        $keyword = '';
        $active = '1';
        $userObj = $userObj->where('user_type','business');
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $userObj = $userObj->Where('first_name', 'like', '%'.$keyword.'%');
            $userObj = $userObj->orWhere('last_name', 'like', '%'.$keyword.'%');
            $userObj = $userObj->orWhere('email', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $userObj = $userObj->Where('active', $request->active);
        }else{
            $userObj = $userObj->Where('active', $active);
        }
        $userObj = $userObj->where('id', '!=', Auth::id());
        $users = $userObj->paginate(5);
        $businessData = $this->__getBusinessAdOffer($users);
        $countryObj = New Country;
        $countriesData = $countryObj->get();
        $countries = array();
        foreach($countriesData as $val){
            $countries[$val->id] = $val->name;
        }
        return view('admin.user.businessindex',compact('users','keyword','active','countries','businessData'));
    }

    function __getBusinessAdOffer($users){
        $businessData = array();
        foreach($users as $user){
            $ad = Post::where('type','ad')->where('active',1)->where('user_id',$user->id)->orderBy('id', 'DESC')->first();
            $offer = Post::where('type','offer')->where('active',1)->where('user_id',$user->id)->orderBy('id', 'DESC')->first();
            $page = Content::where('parent_id', $user->id)->first();
            $businessData[$user->id]['ad'] = $ad;
            $businessData[$user->id]['offer'] = $offer;
            $businessData[$user->id]['page'] = $page;
        }
        return $businessData;
    }
    
    public function businesscreate(){
        $countryObj = New Country;
        $countries = $countryObj->get();
        return View('admin.user.businesscreate',compact('countries'));
    }

    public function businesUpdate(Request $request){
        $user = new User;
        $data = $request->all();
        //$content->uuid = String::uuid();
        $destinationPath = 'uploads/user/';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);
            $data['profile_image'] = $picture;
        }

        $destinationPath = 'uploads/business/';
        if ($request->hasFile('header_image')) {
            $file = $request->file('header_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);
            $data['header_image'] = $picture;
        }
        if($data['id']){
            $user  = User::find($request->input('id'));
            $data['user_type'] = 'business';
            unset($data['_token']);
            foreach($data as $key=>$field){
                if(strpos($key, 'c_') === false){
                    $user->$key = $field;   
                }
                
            }
            if(!empty($data['password'])){
            $data['password'] =  bcrypt( $data['password'] );
            }else{
                unset($data['password']);
            }
            $user->url = str_replace(' ', '-',strtolower($data['first_name']));
            $user->update();
            $companyObj = new Company;
            $oldData = $companyObj->where('active',1)->where('user_id',$user->id)->first();
            if(!empty($oldData)){
                $oldData->active = 0;
                $oldData->save();
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

            flash('Successfully Saved.','success');
            return redirect('/admin/business');    
        }
        flash('Error in saving.','error');
        return back();
    }

    /**
     * Edit user form
     * @param unknown $userid
     * @return unknown
     */
    public function businessedit($userid)
    {
        $user = User::where('id', $userid)->first();
        $company = $user->companies()->where('active',1)->first();
        $countryObj = New Country;
        $countries = $countryObj->get();
        return view('admin.user.businessedit', [
            'user'          => $user,
            'company'       =>$company,
            'countries'     =>$countries
        ]);
    }
    
    /**
     * Save user data into DB
     * @param Request $request
     * @return unknown
     */
    public function businesssave(Request $request)
    {   

        $data = $request->all();
        unset($data['_token']);
        $destinationPath = 'uploads/user/';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);
            $data['profile_image'] = $picture;
        }else{
            $data['profile_image'] = 'user_profile_Default.png';
        }

        $destinationPath = 'uploads/business/';
        if ($request->hasFile('header_image')) {
            $file = $request->file('header_image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = date('His-').$filename;
            $file->move($destinationPath, $picture);
            $data['header_image'] = $picture;
        }

        $data['user_type'] = 'business';
        if(!empty($data['password'])){
            $data['password'] =  bcrypt( $data['password'] );
        }else{
            unset($data['password']);
        }
        $user = new User;
        foreach($data as $key=>$field){
            if(strpos($key, 'c_') === false){
                $user->$key = $field;   
            }
            
        }
        $user->url = str_replace(' ', '-',strtolower($data['first_name']));
        if($user->save()){
            $companyObj = new Company;
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
        }
        Session::flash('success', 'Data updated successfully.');
        return redirect('admin/business');
    
    }
    
    /**
     * Admin landing page upon login
     * @return unknown
     */
    public function businessprofile(){
        $countryObj = New Country;
        $countriesData = $countryObj->get();
        $countries = array();
        foreach($countriesData as $val){
            $countries[$val->id] = $val->name;
        }
        return view('admin.user.businessprofile',compact('countries'));
    }

    /**
    * This function just deactive the user no permanent deletion in the system
    * Take id and status
    */

    public function businessdelete(User $user,$status){
        $user->active = $status;
        $user->save();
        flash('Successfully Deleted!','success');
        return redirect('admin/business/');
    }}