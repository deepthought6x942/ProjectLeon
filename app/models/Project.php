<?php

class Project extends Eloquent{

  protected $fillable = ['name', 'start_date', 'end_date', 'type', 'description'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
  public function eventAttendance(){
    return $this->hasMany('EventAttendance', 'eid');
  }
  public function monetaryDonations(){
    return $this->hasMany('MonetaryDonation', 'eid');
  }
  public static $rules = [
    'name'=> 'required',
    'start_date'=> 'required|date',
    'end_date' => "after|start_date"
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