<?php

class EventAttendance extends Eloquent{

  protected $fillable = ['uid', 'eid', 'role'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event_attendance';

  public function project(){
    return $this->belongsTo('Project', 'eid');
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
    'uid'=> 'required',
    'eid'=> 'required',
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