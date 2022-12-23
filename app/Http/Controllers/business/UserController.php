<?php

namespace App\Http\Controllers\admin;

use Session;
use Auth;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		 
	}
	
	/**
	 * List users
	 * @return unknown
	 */
	public function index()
	{
		$users = User::orderby('id', 'DESC')->where('id', '!=', Auth::id())->paginate(15);
		return view('admin.user.index', ['users' => $users]);
	}
	
	/**
	 * Edit user form
	 * @param unknown $userid
	 * @return unknown
	 */
	public function edit($userid)
	{
		$user = User::where('id', $userid)->get();
		$categories = Category::get();
		return view('admin.user.edit', [
			'user'			=> $user[0],
			'categories'	=> $categories
		]);
	}
	
	/**
	 * Save user data into DB
	 * @param Request $request
	 * @return unknown
	 */
	public function save(Request $request)
	{
	
		$data = [
			'fName'			=> $request->input('fName'),
			'lName'			=> $request->input('lName'),
			'country'		=> $request->input('country'),
			'city'			=> $request->input('city'),
			'postCode'		=> $request->input('postCode'),
			'profileType'	=> $request->input('profileType'),
			'jobTitle'		=> $request->input('jobTitle'),
			'businessLine'	=> $request->input('businessLine'),
			'businessLink'	=> $request->input('businessLink'),
			'description'	=> $request->input('description'),
			'phone1'		=> $request->input('phone1'),
			'phone2'		=> $request->input('phone2'),
			'status'		=> $request->input('status'),
			'isVip'			=> $request->input('isVip'),
			'created_timestamp' => Carbon::now()->timestamp
		];

		$destinationPath = 'uploads/';
		if ($request->hasFile('profilePic')) {
			$file = $request->file('profilePic');
			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$picture = date('His-').$filename;
			$file->move($destinationPath, $picture);
	
			$data['profilePic'] = $picture;
		}
		if ($request->hasFile('coverPic')) {
			$file = $request->file('coverPic');
			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$picture = date('His-').$filename;
			$file->move($destinationPath, $picture);
		
			$data['coverPic'] = $picture;
		}
		
		//TODO save Certifications data
		//TODO save Experiences data
		//TODO save Projects data
		//TODO save Reviews data
		//TODO save Trainings data
	
		if($request->input('id')){
			User::where('id', $request->input('id'))->update($data);
				
			Session::flash('success', 'Data updated successfully.');
			return redirect('admin/user/edit/'.$request->input('id'));
		}
	}
	
	/**
	 * Admin landing page upon login
	 * @return unknown
	 */
	public function profile(){
		return view('admin.user.profile');
	}
	
	/**
	 * Save admin data into DB
	 * @param Request $request
	 * @return unknown
	 */
	public function profileSave(Request $request)
	{
	
		$data = [
			'fName'			=> $request->input('fName'),
			'lName'			=> $request->input('lName'),
			'country'		=> $request->input('country'),
			'phone1'		=> $request->input('phone1'),
		];
	
		$destinationPath = 'uploads/';
		if ($request->hasFile('profilePic')) {
			$file = $request->file('profilePic');
			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$picture = date('His-').$filename;
			$file->move($destinationPath, $picture);
	
			$data['profilePic'] = $picture;
		}
	
		//TODO save Certifications data
		//TODO save Experiences data
		//TODO save Projects data
		//TODO save Reviews data
		//TODO save Trainings data
	
		if($request->input('id')){
			User::where('id', $request->input('id'))->update($data);
	
			Session::flash('success', 'Data updated successfully.');
			return redirect('admin/profile/');
		}
	}
}
