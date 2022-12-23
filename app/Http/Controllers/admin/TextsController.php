<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\Text;
use Auth;
use DB;

class TextsController extends Controller
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
        $textObj = new Text;
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $textObj = $textObj->where('key', 'like', '%'.$keyword.'%');
        }
        $texts = $textObj->paginate(10);
        return view('admin.Texts.index',compact('texts','keyword'));
    }
    public function create(){
        return View('admin.Texts.create');
    }
    public function store(Request $request){
        $rules = array(
            'key'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/Texts/create')
                ->withErrors($validator)->withInput();
        } else {
            $text = new Text;
            $data = $request->all();
            //$content->uuid = String::uuid();
            $text->create($data);
            flash('Text Successfully Saved.','success');
            return redirect('admin/Texts');
        }
    }

    public function show(Text $text){
        return View('admin.Texts.show',compact('text'));   
    }

    public function edit(Text $text){         
        return View('admin.Texts.edit',compact('text'));
    }

    public function update(Request $request,Text $text){
        $data = $request->all();
        $text->details = $data['details'];
        $text->save();
        flash('Text updated Successfully!','success');
        return redirect('admin/Texts');
    
    }
}