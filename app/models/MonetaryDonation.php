<?php

class MonetaryDonation extends Eloquent{

  protected $fillable = ['uid', 'check_number', 'eid', 'date', 'amount', 'notes'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'monetary_donations';
  public function project(){
    return $this->belongsTo('Project','eid');
  }
  public function user(){
    return $this->belongsTo('User','uid');
  }
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

  public static $rules = [
    'check_number'=> 'required|digits:20',
    'uid'=> 'required',
    'eid'=>'required',
    'amount'=>'required|min:1',
    'date'=>'required|date(format)'
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