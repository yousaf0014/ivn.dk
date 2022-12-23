<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!empty($request)){
            view()->composer('*', function ($view) {
                $request = new \Illuminate\Http\Request();            
                $header = $request->header('User-Agent');
                $mobile = false;
                if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
                    $mobile = true;
                }
                $view->with('ismobile', $mobile);        
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once __DIR__ . '/../Http/Helpers/Navigation.php';
    }
}
