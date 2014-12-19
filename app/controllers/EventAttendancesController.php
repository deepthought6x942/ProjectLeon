<?php
use Chumper\Datatable\Columns\FunctionColumn;
class EventAttendancesController extends \BaseController {

	protected $eventAttendance;
	public function __construct (EventAttendance $eventAttendance){
		$this->eventAttendance=$eventAttendance;
	}


	protected static $projectsFields=['id','name', 'start_date', 'end_date', 'type', 'description'];
	protected static $projectsColumns=['Select', 'Name', 'Start Date', 'End Date', 'Type', 'Description'];
	protected static $usersFields=["id","first",'last','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	protected static $usersColumns=["Select",'First', 'Last', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
	protected static $fieldsList=['uid', "first",'last', 'role','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	protected static $columnsList=['Delete', 'First', 'Last', 'Role', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
	public static $usersFieldsList=['eid', 'role'];
	public static $usersColumnNames=['Event','Role'];
	public static $projectsFieldsList=['uid', 'role'];
	public static $projectsColumnNames=['User','Role'];
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
		$project=Project::find($eid);
		$query = User::whereHas('eventAttendance', function ($q) use ($eid){ 
			$q->where('eid', $eid);
		})->lists('id');
		if(count($query)>0){	
			$query2= User::whereNotIn('id', $query)->select(self::$usersFields)->get();
		}else{
			$query2= User::select(self::$usersFields)->get();
		}
		$nonAttendingUsers=$query2->count();
		if($nonAttendingUsers>0){
			$usersTable = Datatable::table()
			->addColumn(self::$usersColumns)
			->setUrl(route('api.eventAttendances.usersList',$eid))
			->noScript();
		}else{
			$usersTable="N/A";
		}
		if(EventAttendance::where('eid',$eid)->get()->count()>0){
			$attendanceTable = Datatable::table()
			->addColumn(self::$columnsList)
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

		return View::make('eventAttendances.manager', ['roles'=>$roles,'usersTable'=>$usersTable,
			'attendanceTable'=>$attendanceTable, 'eid'=>$eid, 'project'=>$project]);
	}
	public function managePortal()
	{
		if(Project::all()->count()>0){
			$projectsTable = Datatable::table()
			->addColumn(self::$projectsColumns)
			->setUrl(route('api.eventAttendances.projectsList'))
			->noScript();
		}
		else{
			$projectsTable="N/A";
		}
		
		return View::make('eventAttendances.managerPortal', ['projectsTable'=>$projectsTable]);
		
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
				if($newuser->fill($newuserdata)->isValid('temporary')){
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
		return Redirect::route('eventAttendances.manage',$input['eid']);
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

		foreach (self::$usersFields as $field) {
			$columns[$field]=new FunctionColumn($field, function($model) use($field){
			return $model->user->$field;
			}); 
		}
		$query= EventAttendance::with(['user'=>function($q){ $q->addSelect(self::$usersFields);}])->where('eid',$eid)->get();
		$table= Datatable::collection($query)
		->showColumns(self::$fieldsList);
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
			$query2= User::whereNotIn('id', $query)->select(self::$usersFields)->get();
		}else{
			$query2= User::select(self::$usersFields)->get();
		}
		if($query2->count()>0){
			return Datatable::collection($query2)
			->showColumns(self::$usersFields)
			->addColumn('id', function($model){
				return Form::checkbox('uid[]', $model->id);
			})
			->make();
		}
		else return "No other users";
	}
	public function getProjectsDatatable(){
		$query = Project::select(self::$projectsFields)->get();
		return Datatable::collection($query)
		->showColumns(self::$projectsFields)
		->addColumn('id', function($model){
			return link_to_route('eventAttendances.manage',"Select",$model->id);
		})
		->make();
	}
	public function getUserDatatable($uid){
		$query = EventAttendance::where('uid',$uid)->select(self::$usersFieldsList)->get();
		return Datatable::collection($query)
		->showColumns(self::$usersFieldsList)
		->addColumn('eid', function($model){
			return link_to('projects/'.$model->project->id,$model->project->name);
		})
		->make();
	}
	public function getProjectDatatable($eid){
		$query = EventAttendance::with('user')->where('eid',$eid)->select(self::$projectsFieldsList)->get();
		return Datatable::collection($query)
		->showColumns(self::$projectsFieldsList)
		->addColumn('uid', function($model){
			return link_to_route('users.show',$model->user->first." ".$model->user->last,$model->user->id);
		})
		->make();
	}
}
