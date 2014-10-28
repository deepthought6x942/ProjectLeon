<?php

class AuctionDonation extends Eloquent{

  protected $fillable = ['id', 'uid', 'title', 'year', 'category', 'quantity', 'description', 'status', 'location', 'approximate_value', 'sold_for'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'auction_donations';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

  public static $rules = [
    'id'=> 'required',
    'uid'=> 'required',
    'title'=>'required',
    'year'=>'required',
    'category'=>'required',
    'description' =>'required',
    'quantity'=>'required',
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
?>