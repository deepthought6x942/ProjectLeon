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
  public function user(){
    return $this->belongsTo('User', 'uid');
  }
  public static $rules = [
    'uid'=> 'required',
    'title'=>'required',
    'year'=>'required|digits:4',
    'category'=>'required',
    'description' =>'required',
    'quantity'=>'required|int|min:0',
    'approximate_value'=>"numeric|min:0",
    'sold_for'=>"numeric|min:0",

  ];
  public $messages;
  public $errors;
  public function isValid(){
    $validation=Validator::make($this->attributes, static::$rules);
    if ($validation->passes()){
      return true;
    }
     $this->errors =$validation->messages ();
     return false;
  }
}
?>