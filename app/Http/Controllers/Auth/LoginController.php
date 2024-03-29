<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use Auth;
use App\Content;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $redirectAfterLogout = '/afterRedirectURL';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

     /**

     * Redirect action upon login

     * @param unknown $request

     * @param unknown $user

     * @return unknown

     */

    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->get($this->username()),
            'password' => $request->get('password'),
            'active' => 1
        ];
    }

    
    public function  authenticated(Request $request,$user)
    {

        if($user->user_type === 'admin'){

            return redirect()->intended('admin'); //redirect to admin panel

        }
        if($user->user_type === 'business'){

            return Redirect::to('showbusiness/'.Auth::user()->id);
            //return redirect()->intended('business'); //redirect to admin panel

        }   
        return redirect()->intended($this->redirectTo); //redirect to standard user homepage
    
    }

    /*
    protected function authenticated($request, $user){

        
    }*/

    public function  showLoginForm(){
        $content = New Content;
        $contentData = $content->where('content_for','login')->first(); 
        $selectedManu = 'login';
        $contentData->contentImage();
        $title = 'Login';
        $title_for_layout = $contentData->title;
        $description_for_layout = $contentData->page_description;
        $keywords_for_layout = $contentData->page_keywords;
        $meta_title_content = $contentData->meta_title_content;
        $currentPath = \Route::getFacadeRoot()->current()->uri();
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {        
            return view('auth.login', compact('title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content'));
        }else{
            return view('auth.loginRegister', compact('title','selectedManu','contentData','currentPath','title_for_layout','description_for_layout','keywords_for_layout','meta_title_content')); 
        }
    }


    /**

     * Redirect the user to the social provider authentication page.

     *

     * @return Response

     */

    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
        
    }


    /**

     * Obtain the user information from social provider.

     *

     * @return Response

     */

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return Redirect::to('/signup');
        }    
        if(empty($user->email) || $user->email == 'null'){
            return redirect()->to('/facebookEmailError');    
        }
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser);
        return redirect()->to('/home');
    }


    /**

     * Return user if exists; create and return if doesn't

     *

     * @param $socialLiteUser

     * @param $key

     * @return User

    */

    private function findOrCreateUser($socialLiteUser, $key){
        $user = User::updateOrCreate([
            'email' => $socialLiteUser->email,
        ], [
            $key . '_id' => $socialLiteUser->id,
            'first_name' => $socialLiteUser->name
        ]);
        return $user;
    }

}