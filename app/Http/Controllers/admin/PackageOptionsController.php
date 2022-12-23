<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\PackageOption;
use Auth;
use DB;

class PackageOptionsController extends Controller
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
        $packageOptionObj = new PackageOption;
        $keyword = '';
        $active = '1';

        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $packageOptionObj = $packageOptionObj->Where('text', 'like', '%'.$keyword.'%');
        }
        if(isset($request->active) && $request->active != -1){
            $active = $request->active;
            $packageOptionObj = $packageOptionObj->Where('active', $request->active);
        }
        $packageOptions = $packageOptionObj->paginate(20);
        return view('admin.PackageOption.index',compact('packageOptions','active','keyword'));
    }
    public function create(){
        return View('admin.PackageOption.create');
    }
    public function store(Request $request){
        $rules = array(
            'text'       => 'required',
            'basic' => 'required',
            'silver'   => 'required',
            'gold'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/PackageOption/create')
                ->withErrors($validator)->withInput();
        } else {
            $packageOptionObj = new PackageOption;
            $data = $request->all();
            $packageOptionObj->create($data);
            flash('Successfully Saved.','success');
            return redirect('admin/PackageOptions');
        }
    }

    public function show(PackageOption $packageOption){
        return View('admin.PackageOption.show',compact('packageOption'));   
    }

    public function edit(PackageOption $packageOption){
        return View('admin.PackageOption.edit',compact('packageOption'));
    }

    public function update(PackageOption $packageOption,Request $request){
        $rules = array(
            'text'       => 'required',
            'basic' => 'required',
            'silver'   => 'required',
            'gold'   => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/PackageOption/'.$packageOption->id.'/edit')
                ->withErrors($validator)->withInput();
        } else {
            $data = $request->all();
            unset($data['_method']);unset($data['_token']);
            foreach($data as $field=>$value){                
                $packageOption->$field = $value;
            }
            $packageOption->save();
            flash('Successfully updated Package Option!','success');
            return redirect('admin/PackageOptions');
        }
    }

    
    /***
    *   We are not going to delete the category permanently
    *
    */
    public function status(PackageOption $packageOption,$status){
        $packageOption->active = $status;
        $packageOption->save();
        flash('Successfully Deleted!','success');
        return back();
    }

    public function delete(PackageOption $packageOption){
        $packageOption->delete();
        flash('Successfully deleted the Package!','success');
        return back();
    }
}