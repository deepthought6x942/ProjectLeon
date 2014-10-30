<?php

class AuctionDonationsController extends \BaseController {

  protected $auctionDonation;
  public function __construct (AuctionDonation $auctionDonation){
    $this->auctionDonation=$auctionDonation;
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
		$auctionDonations=AuctionDonation::all();
		$table= DB::table('auction_donations')
            ->join('users', 'auction_donations.uid', '=', 'users.id')
            ->select('auction_donations.id', 'users.first', 'users.last', 'auction_donations.year', 'auction_donations.title')
            ->get();

    	return View::make('auctionDonations/index', ['table'=>$table, 'auctionDonations'=>$auctionDonations]);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('auctionDonations.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $input=Input::all();
    if(! $this->auctionDonation->fill($input)->isValid()){
      return Redirect::back()->withInput()->withErrors($this->auctionDonation->errors);
    }
		$this->auctionDonation->save();
    return Redirect::route('auctionDonations.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$table= DB::table('auction_donations')
            ->join('users', 'auction_donations.uid', '=', 'users.id')
            ->select('auction_donations.id as id', 'auction_donations.uid as uid', 'users.first as first', 'users.last as last',
            	'auction_donations.title as title', 'events.name as name', 'events.start_date as start_date', 'auction_donations.date as date', 'auction_donations.amount as amount');
        $donation=$table->where('auction_donations.id','=',$id)->first();
		//$auctionDonation=AuctionDonation::find($id);
		//$user=User::where('id','=', $auctionDonation->uid)->first();
		//project=Project::where('id','=',$auctionDonation->eid)->first();
		return View::make('auctionDonations.show', ['donation'=>$donation, 'editable'=>false]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$auctionDonation=AuctionDonation::find($id);
		$user=User::where('id','=', $auctionDonation->uid)->get();
		return View::make('auctionDonations/show', ['auctionDonation'=>$auctionDonation, 'user'=>$user, 'editable'=>true]);
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
	    if(! $this->auctionDonation->fill($input)->isValid()){
	      return Redirect::back()->withInput()->withErrors($this->auctionDonation->errors);
	    }
	    $auctionDonation = $this->find($id)->fill($input);
  		$auctionDonation->save();
	    return Redirect::route('auctionDonations.show($id)');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 $auctionDonation = $this->find($id);
		 $auctionDonation->delete();
		 return Redirect::route('auctionDonations.index');
	}


}
