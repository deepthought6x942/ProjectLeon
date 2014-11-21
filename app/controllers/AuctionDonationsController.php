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
		$auctionDonations=AuctionDonation::with('user')->get();
    	return View::make('auctionDonations/index', ['auctionDonations'=>$auctionDonations]);
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
		$donation=AuctionDonation::with('user')->find($id);
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
		$auctionDonation=AuctionDonation::with('user')->find($id);
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
		$donation=$this->auctionDonation->find($id)->fill($input);
	    if(! $donation->isValid()){
	      Redirect::back()->withInput()->withErrors($this->auctionDonation->errors);
	    }
  		$donation->save();
	    return Redirect::route('auctionDonations.show',$id);
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
