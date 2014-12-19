<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
  //public $timestamps=false;
  protected $guarded = ['updated_at', 'created_at', 'remember_token'];
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
  public function eventAttendance(){
    return $this->hasMany('EventAttendance', 'uid');
  }
  public function monetaryDonations(){
    return $this->hasMany('MonetaryDonation', 'uid');
  }
  public function auctionDonations(){
    return $this->hasMany('AuctionDonation', 'uid');
  }
  public static $insertRules = [
    'first'=> 'required',
    'last'=> 'required',
    'password'=> 'required|confirmed|min:5',
    'password_confirmation'=> 'required|min:5',
    'email'=>'required|email|unique:users',
    'zip' => 'numeric',
    'phone' => 'alpha_dash'
  ];
  public static $updateRules = [
    'first'=> 'required',
    'last'=> 'required',
    'password'=> 'min:5',
    'email'=>'required|email',
    'zip' => 'numeric',
    'phone' => 'alpha_dash'
  ];
  public static $temporaryRules = [
    'first'=> 'required',
    'last'=> 'required',
    'password'=> 'min:5',
    'email'=>'required|email|unique:users',
    'zip' => 'numeric',
    'phone' => 'alpha_dash'
  ];
  public $messages;
  public $errors;
  public function isValid($type){
    if($type==='insert'){ 
      $validation=Validator::make($this->attributes, static::$insertRules);
    }
    elseif($type==='update') {
      $validation=Validator::make($this->attributes, static::$updateRules);
    }
    else {
      $validation=Validator::make($this->attributes, static::$temporaryRules);
    }
    if ($validation->passes()){ 
      return true;
    }
     $this->errors =$validation->messages ();
     return false;
  }
}
