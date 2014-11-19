<?php

class EventAttendancesController extends \BaseController {

	protected $eventAttendance;
	public function __construct (EventAttendance $eventAttendance){
		$this->eventAttendance=$eventAttendance;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$eventAttendances=EventAttendance::with('user', 'project')->get();
		return View::make('eventAttendances/index')->withEventAttendances($eventAttendances);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function manage()
	{
		$projects=Project::with('eventAttendance.user')->get();
		$users=User::with('eventAttendance.project')->get();
		$r=EventAttendance::groupby('role')->lists('role');
		$roles=['other'=>'other'];
		foreach($r as $role){
			$roles[$role]=$role;
		}
		return View::make('eventAttendances.manager', ['users'=>$users,'projects'=>$projects, 'roles'=>$roles]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		$input=Input::all();
		if(!isset($input['uid']) && isset($input['email'])){
			$user=User::where("email",$input['email'])->first();
			if (isset($user)){
				$input['uid']=$user->id;
			}else{
				$newuserdata=['email'=>$input['email'], 'first'=>$input['first'], 'last'=>$input['last']];
				$newuser=new User;
				if(! $newuser->fill($newuserdata)->isValid()){
					$newuser->fill($input)->save();
					$user=User::where("email",$input['email'])->first();
					$input['uid']=$user->id;
				}
			}
		}
		if($input['role']==='other'){
			$input['role']=$input['other'];
		}
		if(! $this->eventAttendance->fill($input)->isValid()){
			return Redirect::back()->withInput()->withErrors($this->eventAttendance->errors);
		}
		$this->eventAttendance->fill($input)->save();
		return Redirect::route('eventAttendances.manage');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Auth::eventAttendance()->type !='admin' and Auth::eventAttendance()->id ==$id){
			return Redirect::to('/');
		}
		$eventAttendance=EventAttendance::with('eventAttendance.project')->find($id);
		return View::make('eventAttendances/show', ['eventAttendance'=>$eventAttendance]);
	}


	/**w
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$eventAttendance=EventAttendance::with('eventAttendance.project')->find($id);
		return View::make('eventAttendances/show', ['eventAttendance'=>$eventAttendance, 'eventAttendance'=>$eventAttendance,'auctionDonations'=>$auctionDonations, 'editable'=>'TRUE']);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$eventAttendance = EventAttendance::with('eventAttendance.project')->find($id);

		$eventAttendance->fill(Input::all());
		if(!$eventAttendance->isValid()){
			return Redirect::back()->withInput()->withErrors($this->project->errors);
		}
		$eventAttendance->save();
		return Redirect::route('eventAttendances.show', $id);
	}

	


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$eventAttendance = $this->find($id);
		$eventAttendance->delete();
		return Redirect::route('eventAttendances.index');
	}


}
