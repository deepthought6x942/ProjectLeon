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

// these routes are protected so that only logged in administrators can access them
Route::group(array('before'=>'admin'), function(){
	
	Route::resource('projects', 'ProjectsController');
	Route::resource('monetaryDonations', 'MonetaryDonationsController');

	Route::get('users', array( 'as' => 'users.index' , 'uses' =>'UsersController@index'));
	Route::patch('users/{users}', array( 'uses' =>'UsersController@update'));
	Route::delete('users/{users}', array( 'as' => 'users.destroy' , 'uses' =>'UsersController@destroy'));

	Route::get('auctionDonations', array( 'as' => 'auctionDonations.index' , 'uses' =>'AuctionDonationsController@index'));
	Route::patch('auctionDonations/{auctionDonations}', array( 'uses' =>'AuctionDonationsController@update'));
	Route::delete('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.destroy' , 'uses' =>'AuctionDonationsController@destroy'));

});

	Route::get('users/create', array( 'as' => 'users.create' , 'uses' => 'UsersController@create'));
	Route::post('users', array( 'as' => 'users.store' , 'uses' => 'UsersController@store'));
	

// some routes will need to be available to general users they are defined here
Route::group(array('before'=>'auth'), function(){
	Route::get('auctionDonations/create', array( 'as' => 'auctionDonations.create' , 'uses' => 'AuctionDonationsController@create'));
	Route::post('auctionDonations', array( 'as' => 'auctionDonations.store' , 'uses' => 'AuctionDonationsController@store'));
	Route::get('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.show' , 'uses' =>'AuctionDonationsController@show'));
	Route::get('auctionDonations/{auctionDonations}/edit', array( 'as' => 'auctionDonations.edit' , 'uses' =>'AuctionDonationsController@edit'));
	Route::put('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.update' , 'uses' =>'AuctionDonationsController@update'));
	
	Route::get('users/{users}', array( 'as' => 'users.show' , 'uses' =>'UsersController@show'));
	Route::get('users/{users}/edit', array( 'as' => 'users.edit' , 'uses' =>'UsersController@edit'));
	Route::put('users/{users}', array( 'as' => 'users.update' , 'uses' =>'UsersController@update'));

	
	Route::get('auctionDonations/create', array( 'as' => 'auctionDonations.create' , 'uses' => 'AuctionDonationsController@create'));
	Route::post('auctionDonations', array( 'as' => 'auctionDonations.store' , 'uses' => 'AuctionDonationsController@store'));

// some routes will need to be available to general users they are defined here
Route::group(array('before'=>'auth'), function(){

	Route::get('users', array( 'as' => 'users.index' , 'uses' =>'UsersController@index'));
	Route::get('users/{users}', array( 'as' => 'users.show' , 'uses' =>'UsersController@show'));
	Route::get('users/{users}/edit', array( 'as' => 'users.edit' , 'uses' =>'UsersController@edit'));
	Route::put('users/{users}', array( 'as' => 'users.update' , 'uses' =>'UsersController@update'));
	Route::patch('users/{users}', array( 'uses' =>'UsersController@update'));
	Route::delete('users/{users}', array( 'as' => 'users.destroy' , 'uses' =>'UsersController@destroy'));

	Route::get('auctionDonations', array( 'as' => 'auctionDonations.index' , 'uses' =>'AuctionDonationsController@index'));
	Route::get('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.show' , 'uses' =>'AuctionDonationsController@show'));
	Route::get('auctionDonations/{auctionDonations}/edit', array( 'as' => 'auctionDonations.edit' , 'uses' =>'AuctionDonationsController@edit'));
	Route::put('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.update' , 'uses' =>'AuctionDonationsController@update'));
	Route::patch('auctionDonations/{auctionDonations}', array( 'uses' =>'AuctionDonationsController@update'));
	Route::delete('auctionDonations/{auctionDonations}', array( 'as' => 'auctionDonations.destroy' , 'uses' =>'AuctionDonationsController@destroy'));


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


