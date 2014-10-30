<?php

class MonetaryDonationsController extends \BaseController {

  protected $monetaryDonation;
  public function __construct (MonetaryDonation $monetaryDonation){
    $this->monetaryDonation=$monetaryDonation;
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
		$monetaryDonations=MonetaryDonation::all();
		$table= DB::table('monetary_donations')
            ->join('users', 'monetary_donations.uid', '=', 'users.id')
            ->join('events', 'monetary_donations.eid', '=', 'events.id')
            ->select('monetary_donations.id', 'users.first', 'users.last', 'events.name', 'monetary_donations.amount')
            ->get();

    	return View::make('monetaryDonations/index', ['table'=>$table, 'monetaryDonations'=>$monetaryDonations]);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('monetaryDonations.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $raw_input=Input::all();
    $first=$raw_input["first"];
    $last=$raw_input["last"];
    $project_ident=$raw_input["project_name"];
    $user=User::where('first','=', $first)->where('last', '=', $last)->first();
    $project=Project::where('id','=',$project_ident)->first();

    $input=array('uid'=>$user->id, 'check_number'=>$raw_input["check_number"], 'eid'=>$project->id, 'date'=>$raw_input["date"], 'amount'=>$raw_input["amount"]);


    if(! $this->monetaryDonation->fill($input)->isValid()){
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
		$table= DB::table('monetary_donations')
            ->join('users', 'monetary_donations.uid', '=', 'users.id')
            ->join('events', 'monetary_donations.eid', '=', 'events.id')
            ->select('monetary_donations.id as id', 'monetary_donations.uid as uid', 'monetary_donations.id as eid', 'users.first as first', 'users.last as last',
            	'monetary_donations.check_number as check_number', 'events.name as name', 'events.start_date as start_date', 'monetary_donations.date as date', 'monetary_donations.amount as amount');
        $donation=$table->where('monetary_donations.id','=',$id)->first();
		//$monetaryDonation=MonetaryDonation::find($id);
		//$user=User::where('id','=', $monetaryDonation->uid)->first();
		//project=Project::where('id','=',$monetaryDonation->eid)->first();
		return View::make('monetaryDonations.show', ['donation'=>$donation, 'editable'=>false]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$monetaryDonation=MonetaryDonation::find($id);
		$user=User::where('id','=', $monetaryDonation->uid)->get();
		return View::make('monetaryDonations/show', ['monetaryDonation'=>$monetaryDonation, 'user'=>$user, 'editable'=>true]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input=Input::all();
	    if(! $this->monetaryDonation->fill($input)->isValid()){
	      return Redirect::back()->withInput()->withErrors($this->monetaryDonation->errors);
	    }
	    $monetaryDonation = $this->find($id)->fill($input);
  		$monetaryDonation->save();
	    return Redirect::route('monetaryDonations.show($id)');
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


}
