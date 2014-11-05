<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
  //public $timestamps=false;
  protected $fillable = ['first', 'last', 'email', 'password', 'type'];
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
  public static $rules = [
    'first'=> 'required',
    'last'=> 'required',
    'password'=> 'required',
    'email'=>'required'
  ];
  public $messages;
  public $errors;
  public function isValid(){
    $validation=Validator::make($this->attributes, static::$rules);
    if ($validation->passes()) return true;
     $this->errors =$validation->messages ();
     return false;
  }
}
