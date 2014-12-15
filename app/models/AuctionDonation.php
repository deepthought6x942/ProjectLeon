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
    'title'=>'required|alpha_num',
    'year'=>'required|digits:4',
    'category'=>'required|alpha_num',
    'description' =>'required|alpha_num',
    'quantity'=>'required|min:1',
    'approximate_value'=>"min|0",
    'sold_for'=>"min|1"
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