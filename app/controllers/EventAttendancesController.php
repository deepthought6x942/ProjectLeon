<?php
use Chumper\Datatable\Columns\FunctionColumn;
class EventAttendancesController extends \BaseController {

	protected $eventAttendance;
	public function __construct (EventAttendance $eventAttendance){
		$this->eventAttendance=$eventAttendance;
	}


	protected $projectsFields=['id','name', 'start_date', 'end_date', 'type', 'description'];
	protected $projectsColumns=['Select', 'Name', 'Start Date', 'End Date', 'Type', 'Description'];
	protected $usersFields=["id","first",'last','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	protected $usersColumns=["Select",'First', 'Last', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
	protected $fieldsList=['uid', "first",'last', 'role','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	protected $columnsList=['Delete', 'First', 'Last', 'Role', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
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
				$query = User::whereHas('eventAttendance', function ($q) use ($eid){ 
					$q->where('eid', $eid);
				})->lists('id');
				if(count($query)>0){	
					$query2= User::whereNotIn('id', $query)->select($this->usersFields)->get();
				}else{
					$query2= User::select($this->usersFields)->get();
				}
				$nonAttendingUsers=$query2->count();
				if($nonAttendingUsers>0){
					$usersTable = Datatable::table()
					->addColumn($this->usersColumns)
					->setUrl(route('api.usersProjects',$eid))
					->noScript();
				}else{
					$usersTable="N/A";
				}
				if(EventAttendance::where('eid',$eid)->get()->count()>0){
					$attendanceTable = Datatable::table()
					->addColumn($this->columnsList)
					->setUrl(route('api.eventAttendances',$eid))
					->noScript();
				}else{
					$attendanceTable="N/A";
				}
				$r=EventAttendance::groupby('role')->lists('role');
				$roles=['other'=>'other'];
				foreach($r as $role){
					$roles[$role]=$role;
				}
			}
		}
		else{
			$projectsTable="N/A";
			$usersTable="N/A";
			$attendanceTable="N/A";
		}
		
		if($eid>=0){
			return View::make('eventAttendances.manager', ['roles'=>$roles, 'projectsTable'=>$projectsTable,'usersTable'=>$usersTable,
				'attendanceTable'=>$attendanceTable, 'eid'=>$eid, 'naus'=>$nonAttendingUsers]);
		}else{
			return View::make('eventAttendances.manager', ['projectsTable'=>$projectsTable,'eid'=>$eid]);
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
		if($input['role']==='other'){
			$input['role']=$input['other'];
		}
		
		if(isset($input['uid'])){
			$uids=$input['uid'];
			foreach ($uids as $uid) {
				$input['uid']=$uid;
				$nea=new EventAttendance;
				$nea->fill($input);
				if(!$nea->isValid()){
					return Redirect::back()->withInput()->withErrors($this->eventAttendance->errors);
				}
				$nea->save();
			}
		}
		elseif(isset($input['email'])) {
			$user=User::where("email",$input['email'])->first();
			if (isset($user)){
				$input['uid']=$user->id;
			}else{
				$newuserdata=['email'=>$input['email'], 'first'=>$input['first'], 'last'=>$input['last']];
				$newuser=new User;
				if($newuser->fill($newuserdata)->isValid()){
					$newuser->fill($newuserdata)->save();
					$user=User::where("email",$input['email'])->first();
					$input['uid']=$user->id;
					if(!$this->eventAttendance->fill($input)->isValid()){
						return Redirect::back()->withInput()->withErrors($this->eventAttendance->errors);
					}
					$this->eventAttendance->fill($input)->save();
				}
			}
		}
		return Redirect::route('eventAttendances.manage',$eid);
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
		return View::make('eventAttendances/show', ['eventAttendance'=>$eventAttendance,'auctionDonations'=>$auctionDonations, 'editable'=>'TRUE']);
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
	public function destroy()
	{
		$input=Input::all();
		$uids=$input['uid'];
		EventAttendance::where('eid',$input['eid'])->whereIn('uid', $uids)->delete();
		return Redirect::route('eventAttendances.manage',$input['eid']);
	}


	public function getDatatable($eid){
		if($eid<0){
			return null;
		}

		foreach ($this->usersFields as $field) {
			$columns[$field]=new FunctionColumn($field, function($model) use($field){
			return $model->user->$field;
			}); 
		}
		$query= EventAttendance::with(['user'=>function($q){ $q->addSelect($this->usersFields);}])->where('eid',$eid)->get();
		$table= Datatable::collection($query)
		->showColumns($this->fieldsList);
		foreach ($columns as $column) {
			$table->addColumn($column);
		}
		return $table->addColumn('uid', function($model){
			return Form::checkbox('uid[]', $model->uid);
		})->make();
	}
	public function getAttendanceDatatable($eid){
		if($eid<0){
			return null;
		}
		$query = User::whereHas('eventAttendance', function ($q) use ($eid){ 
			$q->where('eid', $eid);
		})->lists('id');		
		if(count($query)>0){		
			$query2= User::whereNotIn('id', $query)->select($this->usersFields)->get();
		}else{
			$query2= User::select($this->usersFields)->get();
		}
		if($query2->count()>0){
			return Datatable::collection($query2)
			->showColumns($this->usersFields)
			->addColumn('id', function($model){
				return Form::checkbox('uid[]', $model->id);
			})
			->make();
		}
		else return "No other users";
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
