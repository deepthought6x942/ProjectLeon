<?php

class MonetaryDonation extends Eloquent{

  protected $fillable = ['uid', 'check_number', 'eid', 'date', 'amount'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'monetary_donations';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

  public static $rules = [
    'check_number'=> 'required',
    'uid'=> 'required',
    'eid'=>'required',
    'amount'=>'required',
    'date'=>'required'
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