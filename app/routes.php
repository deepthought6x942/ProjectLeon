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
	

});

// these routes are protected so that only logged in administrators can access them
Route::group(array('before'=>'administrator'), function(){
	
	Route::resource('projects', 'ProjectsController');
	//
	Route::get('users', array( 'as' => 'users.index' , 'uses' =>'UsersController@index'));
	Route::get('eventAttendances/{eventAttendances}', array( 'as' => 'eventAttendances.manage' , 'uses' =>'EventAttendancesController@manage'));
	Route::get('eventAttendances/', array( 'as' => 'eventAttendances.managePortal' , 'uses' =>'EventAttendancesController@managePortal'));
	
	Route::delete('eventAttendances/destroy', array( 'as' => 'eventAttendances.destroy' , 'uses' =>'EventAttendancesController@destroy'));
	Route::post('eventAttendances/', array( 'as' => 'eventAttendances.store' , 'uses' =>'EventAttendancesController@store'));
	Route::post('auctionDonations/changeYear', array( 'as' => 'auctionDonations.changeYear' , 'uses' => 'AuctionDonationsController@changeYear'));
	Route::get('auctionDonations/index/{auctionDonations}', array( 'as' => 'auctionDonations.index' , 'uses' =>'AuctionDonationsController@index'));
	Route::get('auctionDonations/admin_create', array( 'as' => 'auctionDonations.admin_create' , 'uses' => 'AuctionDonationsController@adminCreate'));
	Route::post('auctionDonations/updateBatch', array( 'as' => 'auctionDonations.updateBatch' , 'uses' =>'AuctionDonationsController@updateBatch'));

	Route::get('booklet', array('as'=>'booklet', 'uses' => 'AuctionDonationsController@makeBooklet'));

	//These are the datatable routes
	Route::get('api/users', array('as'=>'api.users', 'uses'=>'UsersController@getDatatable'));
	Route::get('api/users/radio', array('as'=>'api.users.radio', 'uses'=>'UsersController@getRadioDatatable'));
	
	Route::get('api/projects', array('as'=>'api.projects', 'uses'=>'ProjectsController@getDatatable'));
	Route::get('api/projects/radio', array('as'=>'api.projects.radio', 'uses'=>'ProjectsController@getRadioDatatable'));
	
	Route::get('api/monetaryDonations', array('as'=>'api.monetaryDonations', 'uses'=>'MonetaryDonationsController@getDatatable'));
	Route::get('api/monetaryDonations/userTable/{uid}', array('as'=>'api.monetaryDonations.userTable', 'uses'=>'MonetaryDonationsController@getUserDatatable'));
	Route::get('api/monetaryDonations/projectTable/{eid}', array('as'=>'api.monetaryDonations.projectTable', 'uses'=>'MonetaryDonationsController@getProjectDatatable'));
	
	Route::get('api/auctionDonations/{year}', array('as'=>'api.auctionDonations', 'uses'=>'AuctionDonationsController@getDatatable'));
	Route::get('api/auctionDonations/userTable/{uid}', array('as'=>'api.auctionDonations.userTable', 'uses'=>'AuctionDonationsController@getUserDatatable'));
	Route::get('api/ad/users', array('as'=>'api.auctionDonations.usersPortalDatatable', 'uses'=>'AuctionDonationsController@usersPortalDatatable'));

	Route::get('api/eventAttendances/{eid}', array('as'=>'api.eventAttendances', 'uses'=>'EventAttendancesController@getDatatable'));
	Route::get('api/eventAttendances/userTable/{uid}', array('as'=>'api.eventAttendances.userTable', 'uses'=>'EventAttendancesController@getUserDatatable'));
	Route::get('api/eventAttendances/projectTable/{eid}', array('as'=>'api.eventAttendances.projectTable', 'uses'=>'EventAttendancesController@getProjectDatatable'));
	Route::get('api/eventAttendances/projectsList/{eid}', array('as'=>'api.eventAttendances.projectsList', 'uses'=>'EventAttendancesController@getProjectsDatatable'));
	Route::get('api/eventAttendances/usersList/{eid}', array('as'=>'api.eventAttendances.usersList', 'uses'=>'EventAttendancesController@getAttendanceDatatable'));

});

	Route::get('users/create', array( 'as' => 'users.create' , 'uses' => 'UsersController@create'));
	Route::post('users', array( 'as' => 'users.store' , 'uses' => 'UsersController@store'));

	

// some routes will need to be available to general users they are defined here
Route::group(array('before'=>'auth'), function(){

	Route::get('auctionDonations/create/{uid}', array( 'as' => 'auctionDonations.create' , 'uses' => 'AuctionDonationsController@create'));
	Route::post('auctionDonations', array( 'as' => 'auctionDonations.store' , 'uses' => 'AuctionDonationsController@store'));
	Route::get('auctionDonations/resubmit/{uid}/{auctionDonations}', array( 'as' => 'auctionDonations.resubmit' , 'uses' =>'AuctionDonationsController@resubmit'));
	Route::get('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.show' , 'uses' =>'AuctionDonationsController@show'));
	Route::get('auctionDonations/{auctionDonations}/edit', array( 'as' => 'auctionDonations.edit' , 'uses' =>'AuctionDonationsController@edit'));
	Route::put('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.update' , 'uses' =>'AuctionDonationsController@update'));
	
	Route::get('users/{users}', array( 'as' => 'users.show' , 'uses' =>'UsersController@show'));
	Route::get('users/{users}/edit', array( 'as' => 'users.edit' , 'uses' =>'UsersController@edit'));
	Route::put('users/{users}', array( 'as' => 'users.update' , 'uses' =>'UsersController@update'));

	Route::get('api/auctionDonations/memberTable/{uid}', array('as'=>'api.auctionDonations.memberTable', 'uses'=>'AuctionDonationsController@getMemberDatatable'));


});


//Route::resource('auctionDonations', 'AuctionDonationsController');
//Route::resource('users', 'UsersController');  //users.store should be in here for registration page, note it is not protected

Route::get('/', function()
{
	if(!(Auth::check())){
		return View::make('login');
	}

	if( (Auth::check() and (Auth::user()->type==='administrator' or Auth::user()->type==='treasurer'))){
		return Redirect::route('projects.index');
	}
    else{
		$id=Auth::user()->id;
		$currentuser = User::find($id);	
		return View::make('hello', ['currentuser', $currentuser]);
	}
});

// route to show the login form
Route::get('login', array('uses' => 'HomeController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'HomeController@doLogin'));
Route::get('logout', array('uses' => 'HomeController@doLogout'));

//
Route::get('register', array('uses' => 'HomeController@doRegister'));

Route::post('export', array('uses' => 'TableController@get_export'));


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

