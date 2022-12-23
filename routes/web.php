<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('/uniqeEmail', 'HomeController@uniqeEmail');
Route::get('cookie', 'CommonController@cookie');
Route::get('facebookEmailError','CommonController@facebookEmailError');
Route::get('fordele','CommonController@subscription');
//Route without user loggedin

//Routes under auth (if user loggedin) 
Route::group(['middleware' => [ 'web']], function(){
	Route::get('social/auth/redirect/{provider}', 'Auth\LoginController@redirectToProvider');
	Route::get('social/auth/{provider}', 'Auth\LoginController@handleProviderCallback');

	Route::get('category/{category}','CommonController@category');
	Route::get('network/loadPages','CommonController@loadPages');
	Route::get('network/{network}','CommonController@network');
	Route::get('home/loadPages','HomeController@loadPages');
	Route::get('getComments','HomeController@getComments');
	Route::get('signup', 'Auth\RegisterController@getsignup');
	Route::post('signup', 'Auth\RegisterController@postsignup');
	Route::get('/minor', 'HomeController@minor')->name("minor");
	Route::get('/pages/{content_for}', 'HomeController@pages');
	Route::get('/contact us','HomeController@contact_us');
	Route::post('/contact us','HomeController@store_contact_us');
	Route::get('/search','CommonController@search');
	Route::get('/postDetails/{post}','CommonController@postDetails');	
});


//Routes under auth (if user loggedin) 
Route::group(['middleware' => [ 'auth']], function (){
	Route::get('addContectToList','UserController@addContectToList');
	Route::get('viewProfile/{user}','UserController@viewprofile');
	Route::get('user/loadprofilePages','UserController@loadprofilePages');
	Route::get('myProfile','UserController@viewprofile');
	Route::get('editProfile', 'UserController@editProfile');
	Route::post('deleteProfile','UserController@deleteProfile');
	Route::post('editProfile', 'UserController@updateprofile');
	Route::post('user/Post', 'UserController@post');
	Route::get('user/home', 'UserController@index');
	Route::post('user/ratepost','UserController@ratepost');
	Route::post('user/ratecomment','UserController@ratecomment');
	Route::post('subscribeNetwork/{status}','UserController@subscribeNetwork');
	Route::post('ReportPost','UserController@reportPost');	
	Route::post('ReportComment','UserController@reportComment');
	Route::get('/user/postEdit/{post}','UserController@editPost');
	Route::post('/user/updatePost/{post}','UserController@updatePost');	
	Route::get('user/deletePost/{post}', 'UserController@deletePost');
	Route::get('user/comment/{post}/{comment}','UserController@postCommnet');
	Route::post('user/comment/{post}/{comment}','UserController@storeComment');
	Route::get('user/deleteComment/{commnet}/{status}', 'UserController@deleteCommnet');	
	Route::get('/upgradePlan','UserController@updatePlan');
	Route::get('/cancelPlan','UserController@cancelPlan');
	Route::get('/sendProfileInfo','UserController@snedProfileInfo');
	Route::get('subscription','UserController@subscription');
	Route::get('getUserPayemnts','UserController@getUserPayemnts');
	Route::get('showbusiness/{business}','UserController@business');
	Route::post('subscription','UserController@storeSubscription');
	Route::post('saveuserBusiness/{content_url}','UserController@saveuserBusiness');
	Route::post('saveuserBusiness11','UserController@saveuserBusiness11');
	Route::get('getUserPlan','UserController@getUserPlan');
});

//Admin routes
Route::group(['middlewareGroups' => ['web', 'auth'], 'middleware' => ['admin'], 'prefix' => 'admin', 'namespace' => 'admin'], function () {
	Route::get('/', 'UsersController@profile');
	Route::get('profile', 'UsersController@profile');
	Route::get('users', 'UsersController@index');
	Route::get('/users/create/', 'UsersController@create');
	Route::get('user/edit/{userid}', 'UsersController@edit');
	Route::get('uniqueEmail', 'UsersController@uniqueEmail');	
	Route::get('users/delete/{user}/{status}', 'UsersController@delete');	
	
	Route::post('profile/save', 'UsersController@profileSave');
	Route::post('user/save', 'UsersController@save');
	Route::post('user/store', 'UsersController@store');

	Route::get('business', 'UsersController@businessindex');
	Route::get('/business/create/', 'UsersController@businesscreate');
	Route::get('business/edit/{userid}', 'UsersController@businessedit');
	Route::post('business/save', 'UsersController@businesssave');
	Route::post('business/store', 'UsersController@businesUpdate');
	Route::get('business/delete/{user}/{status}', 'UsersController@businessdelete');

	Route::get('Category/updateCrfUrl','CategoriesController@updateCrfUrl');
	Route::get('/Category','CategoriesController@index');
	Route::get('/Category/create','CategoriesController@create');
	Route::get('/Category/addImage/{category}','CategoriesController@addImage');
	Route::post('/Category/uploadImage/{category}','CategoriesController@uploadImage');
	Route::get('/Category/{category}','CategoriesController@show');
	Route::get('/Category/{category}/edit','CategoriesController@edit');
	Route::get('Category/delete/{category}/{status}', 'CategoriesController@delete');	
	Route::post('/Category','CategoriesController@store');
	Route::put('/Category/update/{category}','CategoriesController@update');
	Route::delete('/Category/{category}','CategoriesController@delete');
	Route::get('Category/resizeImages','CategoriesController@resizeImages');

	Route::get('/Network/updateCrfUrl','NetworksController@updateCrfUrl');
	Route::get('/Network/{category}','NetworksController@index');
	Route::get('/Network/create/{category}','NetworksController@create');
	Route::get('/Network/addImage/{network}','NetworksController@addImage');
	Route::post('/Network/uploadImage/{network}','NetworksController@uploadImage');
	Route::get('/Network/show/{network}','NetworksController@show');
	Route::get('/Network/{network}/edit','NetworksController@edit');
	Route::get('Network/delete/{network}/{status}', 'NetworksController@delete');	
	Route::post('/Network/{category}','NetworksController@store');
	Route::put('/Network/update/{network}','NetworksController@update');
	Route::delete('/Network/{network}','NetworksController@deleteNetwork');
	Route::get('/Network/resizeImages','NetworksController@resizeImages');
	Route::get('/Post','PostsController@index');
	Route::get('/Post/create','PostsController@create');
	Route::get('/Post/{post}','PostsController@show');
	Route::get('/Post/{post}/edit','PostsController@edit');
	Route::get('Post/delete/{post}/{status}', 'PostsController@delete');
	Route::get('Post/deleteComment/{commnet}/{status}', 'PostsController@deleteCommnet');	
	Route::get('Post/postCommnet/{post}/{comment}', 'PostsController@postCommnet');
	Route::post('/Post','PostsController@store');
	Route::post('Post/Comment/{post}/{comment}','PostsController@storeComment');
	Route::post('/Post/ratepost','PostsController@ratepost');
	Route::post('/Post/ratecomment','PostsController@ratecomment');
	Route::put('/Post/update/{post}','PostsController@update');
	Route::delete('/Post/{post}','PostsController@delete');
	Route::get('post/resizeImages','PostsController@resizeImages');


	Route::get('/Ad','AdsController@index');
	Route::get('/Ad/create/{user}','AdsController@create');
	Route::get('/Ad/{post}','AdsController@show');
	Route::get('/Ad/{post}/edit','AdsController@edit');
	Route::get('Ad/delete/{post}/{status}', 'AdsController@delete');
	Route::post('/Ad','AdsController@store');
	Route::put('/Ad/update/{post}','AdsController@update');
	Route::delete('/Ad/{post}','AdsController@delete');

	Route::get('/Offer','OffersController@index');
	Route::get('/Offer/create/{user}','OffersController@create');
	Route::get('/Offer/{post}','OffersController@show');
	Route::get('/Offer/{post}/edit','OffersController@edit');
	Route::get('Offer/delete/{post}/{status}', 'OffersController@delete');
	Route::post('/Offer','OffersController@store');
	Route::put('/Offer/update/{post}','OffersController@update');
	Route::delete('/Offer/{post}','OffersController@delete');


	Route::get('/Contents','ContentsController@index');
	Route::get('/Contents/create','ContentsController@create');
	Route::get('/Contents/addImage/{content}','ContentsController@addImage');
	Route::post('/Contents/uploadImage/{content}','ContentsController@uploadImage');
	Route::get('/Contents/reorder','ContentsController@reorder');
	Route::post('/Contents/updateOrder','ContentsController@updateOrder');
	Route::get('/Contents/editInfo/{content}','ContentsController@editInfo');
	Route::post('/Contents/updateImageInfo/{content}','ContentsController@updateImageInfo');
	Route::get('/Contents/{content}','ContentsController@show');
	Route::get('/Contents/{content}/edit','ContentsController@edit');
	Route::post('/Contents/showImage/{content}/{active}','ContentsController@showImage');
	Route::post('/Contents/showgallery/{content}/{active}','ContentsController@showgallery');
	Route::post('/Contents','ContentsController@store');
	Route::put('/Contents/update/{content}','ContentsController@update');
	Route::delete('/Contents/{content}','ContentsController@delete');

	/*  Content Images */
	Route::get('/ContentImages/{content}','ContentImagesController@index');
	Route::get('/ContentImages/create/{content}','ContentImagesController@create');
	Route::get('/ContentImages/editInfo/{content}/{contentImg}','ContentImagesController@editInfo');
	Route::post('/ContentImages/updateImageInfo/{content}/{contentImg}','ContentImagesController@updateImageInfo');
	Route::get('/ContentImages/reorder/{content}','ContentImagesController@reorder');
	Route::post('/ContentImages/updateOrder/{content}','ContentImagesController@updateOrder');
	Route::post('/ContentImages/uploadFiles/{content}','ContentImagesController@uploadFiles');
	Route::post('/ContentImages/showImage/{contentImage}/{active}','ContentImagesController@showImage');
	Route::delete('/ContentImages/{contentImage}','ContentImagesController@delete');
	Route::post('/ContentImages/makeDefault/{contentImage}/{active}','ContentImagesController@makeDefault');


	Route::get('/Texts','TextsController@index');
	Route::get('/Texts/create','TextsController@create');
	Route::get('/Texts/{text}','TextsController@show');
	Route::get('/Texts/{text}/edit','TextsController@edit');
	Route::post('/Texts','TextsController@store');
	Route::put('/Texts/update/{text}','TextsController@update');

	Route::get('/reports','UtilitiesController@postReports');
	Route::get('/reports/show/{report}','UtilitiesController@showReportDetails');
	Route::get('/reports/status/{report}/{status}','UtilitiesController@changeReportStatus');
	Route::get('/reports/deactivePost/{post}/{status}','UtilitiesController@deactivePost');
	Route::delete('/reports/{report}','UtilitiesController@deleteReport');

	Route::delete('/deleteRequestedUser/{user}','UtilitiesController@deleteUser');
	Route::get('/listDeleteUsers','UtilitiesController@ListDeleteUsers');
	
	Route::get('/commentReports','UtilitiesController@commentReports');	
	Route::get('/commentReports/show/{comment}','UtilitiesController@showCommentReportDetails');
	Route::get('/commentReports/status/{comment}/{status}','UtilitiesController@changeCommentReportStatus');
	Route::get('/commentReports/deactivePost/{comment}/{status}','UtilitiesController@deactiveComment');
	Route::delete('/commentReports/{comment}','UtilitiesController@deleteCommentReport');


	Route::get('/Contactus','UtilitiesController@contects');
	Route::get('/contactus/show/{contact}','UtilitiesController@showDetails');
	Route::get('/contactus/status/{contact}/{status}','UtilitiesController@changeStatus');
	Route::get('/userReport','UtilitiesController@userTypeReport');
	Route::delete('/contactus/{contact}','UtilitiesController@deleteContactUs');

	Route::get('/Package','PackagesController@index');
	Route::get('/Package/create','PackagesController@create');
	Route::get('/Package/addImage/{package}','PackagesController@addImage');
	Route::post('/Package/uploadImage/{package}','PackagesController@uploadImage');
	Route::get('/Package/{package}','PackagesController@show');
	Route::get('/Package/{package}/edit','PackagesController@edit');
	Route::get('Package/status/{package}/{status}', 'PackagesController@status');	
	Route::post('/Package','PackagesController@store');
	Route::put('/Package/update/{package}','PackagesController@update');
	Route::delete('/Package/{package}','PackagesController@delete');
	
	Route::get('/PackageOptions','PackageOptionsController@index');
	Route::get('/PackageOptions/create','PackageOptionsController@create');
	Route::get('/PackageOptions/{packageOption}/edit','PackageOptionsController@edit');
	Route::get('PackageOptions/status/{packageOption}/{status}', 'PackageOptionsController@status');	
	Route::post('/PackageOptions','PackageOptionsController@store');
	Route::put('/PackageOptions/update/{packageOption}','PackageOptionsController@update');
	Route::delete('/PackageOptions/{packageOption}','PackageOptionsController@delete');

});


//Business routes
Route::group(['middlewareGroups' => ['web', 'auth'], 'middleware' => ['business'], 'prefix' => 'business', 'namespace' => 'business'], function () {
	Route::get('/', 'HomeController@index')->name('home');
});

//Route::get('/home', 'HomeController@index')->name('home');
