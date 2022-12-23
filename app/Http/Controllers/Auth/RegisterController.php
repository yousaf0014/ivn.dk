<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Log;
use Auth;
use Mail;
use App\Content;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validtor;
use Illuminate\Support\Facades\Input;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        $region=Region::all();
        $content = New Content;
        $contentData = $content->where('content_for','signup_page')->first(); 
        $selectedManu = 'Signup';
        $contentData->contentImage();
        $title = $contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {        
            return view('auth.signup',compact('region','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
        }else{
            return view('auth.loginRegister', compact('title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content')); 
        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
	    Log::info(json_encode($request->all()));
        $this->guard()->login($this->create($request->all()));
        $request->session()->put('first_login', 1);
        return redirect($this->redirectPath());
    }
    
    public function postSignup(Request $request) {
        $rules = array(
            'email'       => 'bail|required|email|unique:users',
            'password'    =>'required'
        );
        $validator = Validtor::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('signup')
                ->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user->first_name = $request->get ('first_name' );
            $user->last_name = $request->get ('last_name' );
            $user->email = $request->get ( 'email' );
	        Log::info(json_encode($request->all()));
            $user->news_letter = $request->get ( 'news_letter' );
            $user->password = bcrypt( $request->get ('password' ) );
            $user->profile_image = 'user_profile_Default.png';
            $user->remember_token = $request->get ( '_token' );
            $user->save();
            Auth::login($user);
            return redirect ( '/home' );
        }
    }


    public function getsignup(){
        $content = New Content;
        $contentData = $content->where('content_for','signup_page')->first(); 
        $selectedManu = 'Signup';
        $contentData->contentImage();
        $title = $contentData->title;
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {        
            return view('auth.signup',compact('region','title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
        }else{
            return view('auth.loginRegister', compact('title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content')); 
        }
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'confirm' =>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //dd($data);
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_image' =>'user_profile_Default.png',
            'news_letter'=>!empty($data['news_letter']) ? $data['news_letter']:'',
            'confirm' => 1
        ]);


        Mail::send('emails.signup_email',$data,function($message) use ($data){
            $message->to($data['email'])->subject(cmskey('signup_email'))
            ->from('info@ivn.dk')->bcc('brian@whyorange.dk');
                           
        });
        return $user;
    }
}