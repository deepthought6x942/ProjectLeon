<?php

class UsersController extends \BaseController {

	protected $user;
	public function __construct (User $user){
		$this->user=$user;
	}
	public static $allFields=["id","first",'last','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	public static $allColumns=["Select",'First', 'Last', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
	protected static $reducedFields=["id","first",'last','email','telephone', 'type','contact_preference'];
	protected static $reducedColumns=["Select",'First', 'Last', 'E-mail','Telephone', 'Type','Contact Preference'];
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(User::all()->count()>0){
			$table = Datatable::table()
				->addColumn(self::$allColumns)
				->setUrl(route('api.users'))
				->noScript();
		}else{
			$table="N/A";
		}
		$users=User::with('eventAttendance.project')->get();
		return View::make('users/index', ['users'=>$users, 'table'=>$table]);
	}

	public static function generateMailTo($ids){
		$emails=[];
		foreach ($ids as $i) {
			array_push($emails,User::where('id',$i)->where('contact_preference','E-mail')->select('email')->first());
		}
		return "mailto:".implode(',',$emails);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	

		$input=Input::all();

		if(! $this->user->fill($input)->isValid('insert')){


			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}
		
		//no need to store the confirmaiton in the db
		unset($input['password_confirmation']);
		
		$this->user= new User;

		$input["password"]=Hash::make($input["password"]);
		

		$this->user->fill($input)->save();

		$userdata = array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
		
			);

	// attempt to do the login
		if (Auth::attempt($userdata)) {

		// validation successful
		// redirect them to the secure section or the dashboard
		// check if they are administrators or general users
		//return Redirect::to('secure');
			return Redirect::to('/');


		} else {	 	

		// validation not successful, send back to form	
		//return Redirect::to('login');
			return Redirect::to('login')
			->with('message', 'Your username/password combination was incorrect');
		}
		
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$authType=Auth::user()->type;
		if($authType === 'member' and Auth::user()->id != $id){
			return Redirect::to('/');
		}
		$user=User::with('eventAttendance.project')->find($id);
		if($authType!=='member'){
			if(AuctionDonation::with('user')->where('uid',$id)->get()->count()<1){
				$adtable="N/A";
			}else{
				$adtable = Datatable::table()
					->addColumn(AuctionDonationsController::$userColumnNames)
					->setUrl(route('api.auctionDonations.userTable',$id))
					->noScript();
			}
			if(EventAttendance::with('user')->where('uid',$id)->get()->count()<1){
				$eatable="N/A";
			}else{
				$eatable = Datatable::table()
					->addColumn(EventAttendancesController::$usersColumnNames)
					->setUrl(route('api.eventAttendances.userTable',$id))
					->noScript();
			}
			if(MonetaryDonation::with('user')->where('uid',$id)->get()->count()<1){
				$mdtable="N/A";
			}else{
				$mdtable = Datatable::table()
					->addColumn(MonetaryDonationsController::$usersColumnNames)
					->setUrl(route('api.monetaryDonations.userTable',$id))
					->noScript();
			}


		}else{
			if(AuctionDonation::with('user')->where('uid',$id)->get()->count()<1){
				$adtable="N/A";
			}else{
				$adtable = Datatable::table()
					->addColumn(AuctionDonationsController::$memberColumnNames)
					->setUrl(route('api.auctionDonations.memberTable',$id))
					->noScript();
			}
			$eatable="N/A";
			$mdtable="N/A";
		}		
		return View::make('users/show', ['user'=>$user, 'adtable'=>$adtable, 'eatable'=>$eatable, 'mdtable'=>$mdtable]);
	}


	/**w
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user=User::with('eventAttendance.project')->find($id);
		return View::make('users/show', ['user'=>$user, 'eventAttendance'=>$eventAttendance,'auctionDonations'=>$auctionDonations, 'editable'=>'TRUE']);
		return View::make('users/');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::with('eventAttendance.project')->find($id);
		$input=Input::all();
		$newInput=[];
		foreach(self::$allFields as $field){
			if(isset($input[$field])){
				$newInput[$field]=$input[$field];
			}
		}
		$user->fill($newInput);
		if(!$user->isValid('update')){
			return Redirect::back()->withInput()->withErrors($user->errors);
		}
		$user->save();
		return Redirect::route('users.index');
	}

	


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->find($id);
		$user->delete();
		return Redirect::route('users.index');
	}
	public function getDatatable(){
		
		$query = User::select(self::$allFields)->get();
		return Datatable::collection($query)
			->showColumns(self::$allFields)
			->addColumn('id', function($model){
				return link_to('users/'.$model->id,'View/Edit');
			})
			
			
			->make();
	}
	public function getRadioDatatable(){
		
		$query = User::select(self::$allFields)->get();

		return Datatable::collection($query)
			->showColumns(self::$allFields)
			->addColumn('id', function($model){
				return Form::radio('uid', $model->id);
			})
			->make();
	}

}
