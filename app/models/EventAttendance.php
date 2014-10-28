<?php

class EventAttendance extends Eloquent{

  protected $fillable = ['name', 'start_date', 'end_date', 'type', 'description'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event_attendance';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

  public static $rules = [
    'name'=> 'required',
    'start_date'=> 'required',
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