<?php

class EventAttendancesController extends \BaseController {

	protected $eventAttendance;
	public function __construct (EventAttendance $eventAttendance){
		$this->eventAttendance=$eventAttendance;
	}


	protected $projectsFields=['id','name', 'start_date', 'end_date', 'type', 'description'];
	protected $projectsColumns=['Select', 'Name', 'Start Date', 'End Date', 'Type', 'Description'];
	protected $usersFields=["id","first",'last','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	protected $usersColumns=["Select",'First', 'Last', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
	protected $fieldsList=['uid', 'eid', 'role'];
	protected $columnsList=['User', 'Event', 'Role'];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($eid)
	{
		


		$eventAttendances=EventAttendance::with('user', 'project')->get();
		return View::make('eventAttendances/index')->withEventAttendances($eventAttendances);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function manage($eid)
	{
		if(Project::all()->count()>0){
			$projectsTable = Datatable::table()
				->addColumn($this->projectsColumns)
				->setUrl(route('api.projectsList'))
				->noScript();
			if($eid>=0){
				$usersTable = Datatable::table()
					->addColumn($this->usersColumns)
					->setUrl(route('api.usersProjects',$eid))
					->noScript();
				$attendanceTable = Datatable::table()
					->addColumn($this->columnsList)
					->setUrl(route('api.eventAttendances',$eid))
					->noScript();
			}
		}
		else{
			$projectsTable="N/A";
			$usersTable="N/A";
			$attendanceTable="N/A";
		}
		$projects=Project::with('eventAttendance.user')->get();
		$users=User::with('eventAttendance.project')->get();
		$r=EventAttendance::groupby('role')->lists('role');
		$roles=['other'=>'other'];
		foreach($r as $role){
			$roles[$role]=$role;
		}
		if($eid>=0){
			return View::make('eventAttendances.manager', ['users'=>$users,'projects'=>$projects, 'roles'=>$roles,
				'projectsTable'=>$projectsTable,'usersTable'=>$usersTable,'attendanceTable'=>$attendanceTable, 'eid'=>$eid]);
		}else{
			return View::make('eventAttendances.manager', ['users'=>$users,'projects'=>$projects, 'roles'=>$roles,
				'projectsTable'=>$projectsTable,'eid'=>$eid]);
		}
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
	public function getDatatable($eid){
		if($eid<0){
			return null;
		}
		$query = eventAttendance::select($this->fieldsList)->where('eid',$eid)->get();

		return Datatable::collection($query)
		->addColumn('edit/delete', function($model){
			return "edit/delete";
		})
		->showColumns($this->fieldsList)
		->addColumn('uid', function($model){
			return link_to('users/'.$model->uid, $model->user->first." ".$model->user->last);
		})
		->addColumn('eid', function($model){
			return link_to('projects/'.$model->eid,$model->project->name);
		})
		->make();
	}
	public function getAttendanceDatatable($eid){
		if($eid<0){
			return null;
		}
		$query = User::whereHas('eventAttendance', function ($q) use ($eid){ 
				$q->where('eid', $eid);
			})->lists('id');		
		$query2= User::whereNotIn('id', $query)->select($this->usersFields)->get();
		return Datatable::collection($query2)
		->showColumns($this->usersFields)
		->addColumn('id', function($model){
			return Form::radio('uid', $model->id);
		})
		->make();
	}
	public function getProjectsDatatable(){
		$query = Project::select($this->projectsFields)->get();
		return Datatable::collection($query)
			->showColumns($this->projectsFields)
			->addColumn('id', function($model){
				return link_to('eventAttendances/'.$model->id,'Select');
			})
			->make();
	}
}
