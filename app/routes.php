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
Route::group(array('before'=>'auth'), function(){
	Route::resource('users', 'UsersController');
	Route::resource('projects', 'ProjectsController');
	Route::resource('monetaryDonations', 'MonetaryDonationsController');
	Route::resource('auctionDonations', 'AuctionDonationsController');
});
Route::get('users/register', array( 'uses'=>'UsersController@create'));
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
