<?php

class MonetaryDonationsController extends \BaseController {

	protected $monetaryDonation;
	public function __construct (MonetaryDonation $monetaryDonation){
		$this->monetaryDonation=$monetaryDonation;
	}
	protected $fieldsList= ['id', 'uid', 'eid', 'date', 'amount', 'check_number', 'notes'];
	protected $columnNames= ['Select', 'User', 'Project/Event', 'Date', 'Amount', 'Check Number', 'Notes'];
	protected $usersFields=["id","first",'last','email','address1', 'address2', 'city','state','zip','telephone', 'type','contact_preference'];
	protected $usersColumns=["Select",'First', 'Last', 'E-mail','Address 1', 'Address 2', 'City','State','Zip','Telephone', 'Type','Contact Preference'];
	protected $projectsFields=['id','name', 'start_date', 'end_date', 'type', 'description'];
	protected $projectsColumns=['Select', 'Name', 'Start Date', 'End Date', 'Type', 'Description'];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = Datatable::table()
		->addColumn($this->columnNames)
		->setUrl(route('api.monetaryDonations'))
		->noScript();
		return View::make('monetaryDonations/index', ['table'=>$table]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$p=Project::all();
		$projects=[];
		$users=User::all();
		foreach($p as $project){
			$projects[$project->id]=$project->name.", ".$project->start_date;
		}
		if(Project::all()->count()>0){
			$projectsTable = Datatable::table()
						->addColumn($this->projectsColumns)
						->setUrl(route('api.projectsRadio'))
						->noScript();
			$usersTable = Datatable::table()
						->addColumn($this->usersColumns)
						->setUrl(route('api.usersRadio'))
						->noScript();
		}else{
			$projectsTable=$usersTable="N/A";
		}
		return View::make('monetaryDonations.create', ['projectsTable'=>$projectsTable, 'usersTable'=>$usersTable]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input=Input::all();
		if (!isset($input['uid']) && isset($input['email'])) {
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
				}else{
					return Redirect::back()->withInput()->withErrors($newuser->errors);
				}
			}
		}
		if(!$this->monetaryDonation->fill($input)->isValid()){
			return Redirect::back()->withInput()->withErrors($this->monetaryDonation->errors);
		}
		$this->monetaryDonation->save();
		return Redirect::route('monetaryDonations.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$p=Project::all();
		$projects=[];
		foreach($p as $project){
			$projects[$project->id]=$project->name.", ".$project->start_date;
		}
		$donation=MonetaryDonation::with('user','project')->find($id);
		return View::make('monetaryDonations.show', ['donation'=>$donation, 'projects'=>$projects]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$monetaryDonation=MonetaryDonation::with('user','project')->find($id);
		return View::make('monetaryDonations/show', ['monetaryDonation'=>$monetaryDonation, 'editable'=>true]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$raw_input=Input::all();
		$first=$raw_input["first"];
		$last=$raw_input["last"];
		$user=User::where('first','=', $first)->where('last', '=', $last)->first();

		$input=array('uid'=>$user->id, 'check_number'=>$raw_input["check_number"], 'eid'=>$raw_input['eid'], 'date'=>$raw_input["date"], 'amount'=>$raw_input["amount"]);

		if(! $this->monetaryDonation->fill($input)->isValid()){
			return Redirect::back()->withInput()->withErrors($this->monetaryDonation->errors);
		}

		$monetaryDonation = $this->monetaryDonation->find($id)->fill($input);
		$monetaryDonation->save();
	    //return Redirect::route('monetaryDonations.show($id)');
		return Redirect::back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$monetaryDonation = $this->find($id);
		$monetaryDonation->delete();
		return Redirect::route('monetaryDonations.index');
	}
	public function getDatatable(){
		
		$query = monetaryDonation::with('user','project')->select($this->fieldsList)->get();
		return Datatable::collection($query)
		->showColumns($this->fieldsList)
		->addColumn('id', function($model){
			return link_to('monetaryDonations/'.$model->id,'View/Edit');
		})
		->addColumn('uid', function($model){
			return link_to('users/'.$model->uid, $model->user->first." ".$model->user->last);
		})
		->addColumn('eid', function($model){
			return link_to('projects/'.$model->eid,$model->project->name);
		})

		->make();
	}	
}