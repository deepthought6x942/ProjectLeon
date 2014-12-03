<?php

class AuctionDonationsController extends \BaseController {

	protected $auctionDonation;
	public function __construct (AuctionDonation $auctionDonation){
		$this->auctionDonation=$auctionDonation;
	}

	public static function currentYear(){

		$date=getdate();
		if($date['mon']>=2){
			return $date['year']+1;
		}else{
			return $date['year'];
		}
	}
	public static function getStatuses(){
		$s=AuctionDonation::groupby('status')->lists('status');
		$statuses=['other'=>'other'];
		foreach($s as $status){
			$statuses[$status]=$status;
		}
		return $statuses;
	}
	public static function getLocations(){
		$l=AuctionDonation::groupby('location')->lists('location');
		$locations=[];
		foreach($l as $location){
			$locations[$location]=$location;
		}
		return $locations;
	}
	public static function getCategories(){
		$c=AuctionDonation::groupby('category')->lists('category');
		$categories=[];
		foreach($c as $category){
			$categories[$category]=$category;
		}
		return $categories;
	}
	public static function getYears(){
		$y=AuctionDonation::groupby('year')->lists('year');
		$years=[];
		foreach($y as $year){
			$years[$year]=$year;
		}
		return $years;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($year)
	{
		$auctionDonations=AuctionDonation::with('user')->where('year', $year)->get();
		$years=$this->getYears();
		return View::make('auctionDonations/index', ['auctionDonations'=>$auctionDonations, 'years'=>$years]);
	}
	public function changeYear()
	{
		$input=Input::all();
		return Redirect::route('auctionDonations.index', $input['year']);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		$userDonations=AuctionDonation::with('user')->where('uid',Auth::user()->id)->get();
		if(Auth::user()->type!=='member'){
			$locations['other']='other';
			$categories['other']='other';
		}else{
			unset($locations['Live Auction']);
		}
		return View::make('auctionDonations.create', ['statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories, 'userDonations'=>$userDonations]);
	}
	public function adminCreate()
	{
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		$users=User::all();
		$locations['other']='other';
		$categories['other']='other';
		return View::make('auctionDonations.admin_create', ['statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories, 'users'=>$users]);
	}
	public function resubmit($id)
	{
		$donation=AuctionDonation::with('user')->find($id);
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		$userDonations=AuctionDonation::with('user')->where('uid',Auth::user()->id)->get();
		if(Auth::user()->type!=='member'){
			$locations['other']='other';
			$categories['other']='other';
		}else{
			unset($locations['Live Auction']);
		}
		return View::make('auctionDonations.resubmit', ['statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories, 'donation'=>$donation, 'userDonations'=>$userDonations]);
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
		if($input['location']==='other'&& isset($input['other location'])) {
			$input['location']=$input['other location'];
		}
		if($input['category']==='other'&& isset($input['other category'])) {
			$input['category']=$input['other category'];
		}
		$input['year']=$this->currentYear();
		if(! $this->auctionDonation->fill($input)->isValid()){
			return Redirect::back()->withInput()->withErrors($this->auctionDonation->errors);
		}
		$this->auctionDonation->save();
		return Redirect::route('auctionDonations.index',$this->currentYear());
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
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		if(Auth::user()->type!=='member'){
			$locations['other']='other';
			$categories['other']='other';
		}else{
			unset($locations['Live Auction']);
		}
		return View::make('auctionDonations.show', ['donation'=>$donation,
		 'statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories]);
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
		if($input['location']==='other'&& isset($input['other location'])) {
			$input['location']=$input['other location'];
		}
		if($input['category']==='other'&& isset($input['other category'])) {
			$input['category']=$input['other category'];
		}
		if($input['status']==='other'&& isset($input['other status'])) {
			$input['status']=$input['other status'];
		}
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
