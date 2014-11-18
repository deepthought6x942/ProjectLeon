<?php

class UsersController extends \BaseController {

	protected $user;
	public function __construct (User $user){
		$this->user=$user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users=User::with('eventAttendance.project')->get();
		return View::make('users/index')->withUsers($users);
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
		if(! $this->user->fill($input)->isValid()){
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}

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
			return Redirect::to('login');

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
		if(Auth::user()->type !='admin' and Auth::user()->id ==$id){
			return Redirect::to('/');
		}
		$user=User::with('eventAttendance.project')->find($id);
		return View::make('users/show', ['user'=>$user]);
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

		$user->fill(Input::all());
		if(!$user->isValid()){
			return Redirect::back()->withInput()->withErrors($this->project->errors);
		}
		$user->save();
		return Redirect::route('users.show', $id);
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


}
