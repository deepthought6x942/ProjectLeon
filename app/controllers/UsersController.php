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
		if( !(Auth::user()->type==='admin')){
			return Redirect::to('/');
		}
		$users=User::all();
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
		return Redirect::to('/');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(!(Auth::user()->type ==='admin') and (Auth::user()->id !=$id)){
			return Redirect::to('/');
		}
		$user=User::find($id);
		$eventAttendance=EventAttendance::where('uid','=', $user->id)->get();
		$auctionDonations=AuctionDonation::where('uid','=',$user->id)->get();
		return View::make('users/show', ['user'=>$user, 'eventAttendance'=>$eventAttendance, 'auctionDonations'=>$auctionDonations]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user=User::find($id);
		$eventAttendance=EventAttendance::where('uid','=', $user->id)->get();
		$auctionDonations=AuctionDonation::where('uid','=',$user->id)->get();
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
		$user = User::find($id);
		$user->fill(Input::all());
		$user->save();

		$s= User::find($id);
		if($user->type==$s->type)
		{
			return Redirect::route('users.show', $id)
			->with('flash', 'The user was updated');
		}
		
		return Redirect::route('users.show', $id)
		->withInput()
		->withErrors($user->errors());
		//return Redirect::to('users/'.$id);
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
