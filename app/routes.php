<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('users', 'UsersController@index');
//Route::get('users/{ID}', 'UsersController@show');


Route::group(array('before' => 'treasurer'), function(){
	Route::resource('monetaryDonations', 'MonetaryDonationsController');
	Route::get('monetaryDonations', array( 'as' => 'monetaryDonations.index' , 'uses' =>'MonetaryDonationsController@index'));
	/*
	Route::patch('monetaryDonations/{monetaryDonations}', array( 'uses' =>'MonetaryDonationsController@update'));
	Route::delete('monetaryDonations/{monetaryDonations}', array( 'as' => 'monetaryDonations.destroy' , 'uses' =>'MonetaryDonationsController@destroy'));
	Route::get('monetaryDonations/create', array( 'as' => 'monetaryDonations.create' , 'uses' => 'MonetaryDonationsController@create'));
	Route::post('monetaryDonations', array( 'as' => 'monetaryDonations.store' , 'uses' => 'MonetaryDonationsController@store'));
	Route::get('monetaryDonations/{monetaryDonations}', array( 'as' => 'monetaryDonations.show' , 'uses' =>'MonetaryDonationsController@show'));
	Route::get('monetaryDonations/{monetaryDonations}/edit', array( 'as' => 'monetaryDonations.edit' , 'uses' =>'MonetaryDonationsController@edit'));
	Route::put('monetaryDonations/{monetaryDonations}', array( 'as' => 'monetaryDonations.update' , 'uses' =>'MonetaryDonationsController@update'));
	*/	

});

// these routes are protected so that only logged in administrators can access them
Route::group(array('before'=>'administrator'), function(){
	
	Route::resource('projects', 'ProjectsController');
	//
	Route::get('users', array( 'as' => 'users.index' , 'uses' =>'UsersController@index'));
	Route::patch('users/{users}', array( 'uses' =>'UsersController@update'));
	Route::delete('users/{users}', array( 'as' => 'users.destroy' , 'uses' =>'UsersController@destroy'));
	Route::get('eventAttendances/{eventAttendances}', array( 'as' => 'eventAttendances.manage' , 'uses' =>'EventAttendancesController@manage'));
	Route::delete('eventAttendances/destroy', array( 'as' => 'eventAttendances.destroy' , 'uses' =>'EventAttendancesController@destroy'));
	Route::post('eventAttendances/', array( 'as' => 'eventAttendances.store' , 'uses' =>'EventAttendancesController@store'));
	Route::post('auctionDonations/changeYear', array( 'as' => 'auctionDonations.changeYear' , 'uses' => 'AuctionDonationsController@changeYear'));
	Route::get('auctionDonations/index/{auctionDonations}', array( 'as' => 'auctionDonations.index' , 'uses' =>'AuctionDonationsController@index'));
	Route::patch('auctionDonations/{auctionDonations}', array( 'uses' =>'AuctionDonationsController@update'));
	Route::delete('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.destroy' , 'uses' =>'AuctionDonationsController@destroy'));
	Route::get('auctionDonations/admin_create', array( 'as' => 'auctionDonations.admin_create' , 'uses' => 'AuctionDonationsController@adminCreate'));
	Route::get('api/users', array('as'=>'api.users', 'uses'=>'UsersController@getDatatable'));
	Route::get('api/projects', array('as'=>'api.projects', 'uses'=>'ProjectsController@getDatatable'));
	Route::get('api/monetaryDonations', array('as'=>'api.monetaryDonations', 'uses'=>'MonetaryDonationsController@getDatatable'));
	Route::get('api/auctionDonations/{auctionDonations}', array('as'=>'api.auctionDonations', 'uses'=>'AuctionDonationsController@getDatatable'));
	Route::get('api/eventAttendances/{eventAttendances}', array('as'=>'api.eventAttendances', 'uses'=>'EventAttendancesController@getDatatable'));
	Route::get('api/users/{eventAttendances}', array('as'=>'api.usersProjects', 'uses'=>'EventAttendancesController@getAttendanceDatatable'));
	Route::get('api/projectsEvents/{eventAttendances}', array('as'=>'api.projectsList', 'uses'=>'EventAttendancesController@getProjectsDatatable'));
	Route::get('api/projectsDonations', array('as'=>'api.projectsRadio', 'uses'=>'ProjectsController@getRadioDatatable'));
	Route::get('api/usersDonations', array('as'=>'api.usersRadio', 'uses'=>'UsersController@getRadioDatatable'));

});

	Route::get('users/create', array( 'as' => 'users.create' , 'uses' => 'UsersController@create'));
	Route::post('users', array( 'as' => 'users.store' , 'uses' => 'UsersController@store'));

	

// some routes will need to be available to general users they are defined here
Route::group(array('before'=>'auth'), function(){

	Route::get('auctionDonations/create', array( 'as' => 'auctionDonations.create' , 'uses' => 'AuctionDonationsController@create'));
	Route::post('auctionDonations', array( 'as' => 'auctionDonations.store' , 'uses' => 'AuctionDonationsController@store'));
	Route::get('auctionDonations/resubmit/{auctionDonations}', array( 'as' => 'auctionDonations.resubmit' , 'uses' =>'AuctionDonationsController@resubmit'));
	Route::get('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.show' , 'uses' =>'AuctionDonationsController@show'));
	Route::get('auctionDonations/{auctionDonations}/edit', array( 'as' => 'auctionDonations.edit' , 'uses' =>'AuctionDonationsController@edit'));
	Route::put('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.update' , 'uses' =>'AuctionDonationsController@update'));
	
	Route::get('users/{users}', array( 'as' => 'users.show' , 'uses' =>'UsersController@show'));
	Route::get('users/{users}/edit', array( 'as' => 'users.edit' , 'uses' =>'UsersController@edit'));
	Route::put('users/{users}', array( 'as' => 'users.update' , 'uses' =>'UsersController@update'));

	


});


//Route::resource('auctionDonations', 'AuctionDonationsController');
//Route::resource('users', 'UsersController');  //users.store should be in here for registration page, note it is not protected

Route::get('/', function()
{
	if(!(Auth::check())){
		return View::make('login');
	}
	$id=Auth::user()->id;
	$currentuser = User::find($id);	
	return View::make('hello', ['currentuser', $currentuser]);
});

// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));
Route::get('logout', array('uses' => 'HomeController@doLogout'));

//
Route::get('register', array('uses' => 'HomeController@doRegister'));

Route::post('export', array('uses' => 'TableController@get_export'));

Route::get('booklet', array('as'=>'booklet', 'uses' => 'TableController@makeBooklet'));

Route::get('password/reset', array(
  'uses' => 'PasswordController@remind',
  'as' => 'password.remind'
));

Route::post('password/reset', array(
  'uses' => 'PasswordController@request',
  'as' => 'password.request'
));

Route::get('password/reset/{token}', array(
  'uses' => 'PasswordController@reset',
  'as' => 'password.reset'
));

Route::post('password/reset/{token}', array(
  'uses' => 'PasswordController@update',
  'as' => 'password.update'
));

