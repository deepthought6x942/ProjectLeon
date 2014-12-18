<?php

class AuctionDonationsController extends \BaseController {

	protected $auctionDonation;
	public function __construct (AuctionDonation $auctionDonation){
		$this->auctionDonation=$auctionDonation;
	}

	/**
	 * Gets the current Auction Donation Year (i.e what the donation is for)
	 *
	 * @return year
	 */
	public static function currentYear(){

		$date=getdate();
		if($date['mon']>=2){
			return $date['year']+1;
		}else{
			return $date['year'];
		}
	}
	/**
	 * Gets the list of existing Auction Donation Statuses (Other, Delivered and Not Delivered are defaults)
	 *
	 * @return array of statuses
	 */
	public static function getStatuses(){
		$s=AuctionDonation::groupby('status')->orderby('status','DESC')->lists('status');
		$statuses=[];
		foreach($s as $status){
			$statuses[$status]=$status;
		}
		$statuses['Not Delivered']='Not Delivered';
		$statuses['Delivered']='Delivered';
		$statuses['Other']='Other';
		return $statuses;
	}
	/**
	 * Gets the list of existing Auction Donation locations (no defaults, add other for admins)
	 *
	 * @return array of locations
	 */
	public static function getLocations(){
		$l=AuctionDonation::groupby('location')->lists('location');
		$locations=[];
		foreach($l as $location){
			$locations[$location]=$location;
		}
		return $locations;
	}
	/**
	 * Gets the list of existing Auction Donation Categories (no defaults, add other for admins)
	 *
	 * @return array of categories
	 */
	public static function getCategories(){
		$c=AuctionDonation::groupby('category')->lists('category');
		$categories=[];
		foreach($c as $category){
			$categories[$category]=$category;
		}
		return $categories;
	}
	/**
	 * Gets the list of existing Auction Donation years
	 *
	 * @return array of years
	 */
	public static function getYears(){
		$y=AuctionDonation::groupby('year')->lists('year');
		$years=[];
		foreach($y as $year){
			$years[$year]=$year;
		}
		return $years;
	}
	//The following is a list of fields and lables for use in the datatables
	protected static $fieldsList= ['id', 'uid', 'title', 'year', 'category', 'quantity', 'description', 'location', 'status', 'approximate_value', 'sold_for'];
	protected static $columnNames= ['Select', 'User', 'Title', 'Year', 'Category', 'Quantity', 'Description','Location', 'Status', 'Approximate Value','Sold For', 'Edit'];
	protected static $batchFields= ['category'=>'Category', 'location'=>'Location', 'status'=>'Status'];

	protected static $userFieldsList= ['id', 'title', 'year', 'category', 'quantity', 'description', 'location', 'status', 'approximate_value', 'sold_for'];
	public static $userColumnNames= ['Select', 'Title', 'Year', 'Category', 'Quantity', 'Description','Location', 'Status', 'Approximate Value','Sold For'];
	protected static $memberFieldsList= ['id', 'title', 'year', 'category', 'quantity', 'description', 'approximate_value'];
	public static $memberColumnNames= ['Resubmit', 'Title', 'Year', 'Category', 'Quantity', 'Description', 'Approximate Value'];

	/**
	 * Displays all auction donations for a given year and provides batch edit option
	 *	@param int year: the year to display
	 * @return Response
	 */
	public function index($year)
	{
		$years=$this->getYears();
		if(AuctionDonation::where('year',$year)->get()->count()<1){
			$table="N/A";
		}else{
			$table = Datatable::table()
			->addColumn(self::$columnNames)
			->setUrl(route('api.auctionDonations',$year))
			->noScript();
		}
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		if(Auth::user()->type!=='member'){
			$locations['Other']='Other';
			$categories['Other']='Other';
		}
		return View::make('auctionDonations/index', ['table'=>$table,'years'=>$years, 'year'=>$year, 
			'statuses'=>$this->getStatuses(), 'batchFields'=>self::$batchFields, 'locations'=>$locations, 
			'categories'=>$categories]);
	}
	/**
	 * Redirects to the index page for the selected year
	 *	@param int year: the year to display
	 * @return Response
	 */
	public function changeYear()
	{
		$input=Input::all();
		return Redirect::route('auctionDonations.index', $input['year']);
	}

	/**
	 * Show the form for creating a new donation for a given user, 
	 * also provides a table of past donations for resubmission.
	 *@param int uid, the ID of the user making the donation
	 * @return Response
	 */
	public function create($uid)
	{
		$authType=Auth::user()->type;
		if($authType === 'member' and Auth::user()->id != $uid){
			return Redirect::to('/');
		}
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		$userDonations=AuctionDonation::with('user')->where('uid',$uid)->get();
		if(Auth::user()->type!=='member'){
			$locations['Other']='Other';
			$categories['Other']='Other';
		}else{
			unset($locations['Live Auction']);
		}
		if(AuctionDonation::with('user')->where('uid',$uid)->get()->count()<1){
			$table="N/A";
		}else{
			$table = Datatable::table()
			->addColumn(self::$memberColumnNames)
			->setUrl(route('api.auctionDonations.memberTable',$uid))
			->noScript();
		}
		return View::make('auctionDonations.create', ['statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories, 'table'=>$table]);
	}


	//Allows the Administrator to select a member to make a donation on their behalf
	public function adminCreate()
	{
		if(User::where('type','member')->count()>0){
			$portalTable = Datatable::table()
				->addColumn(UsersController::$allColumns)
				->setUrl(route('api.auctionDonations.usersPortalDatatable'))
				->noScript();
		}else{
			$usersTable="N/A";
		}
		return View::make('auctionDonations.admin_create', ['portalTable'=>$portalTable]);
	}


/**
	 * Show the form for creating a new donation for a given user, filled in with past data, 
	 * also provides a table of past donations for resubmission.
	 *@param int id, the id of the past donation being used as a seed.
	 *@param int uid, the ID of the user making the donation
	 * @return Response
	 */

	public function resubmit($id, $uid)
	{
		$authType=Auth::user()->type;
		if($authType === 'member' and Auth::user()->id != $uid){
			return Redirect::to('/');
		}
		$donation=AuctionDonation::with('user')->find($id);
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		if(AuctionDonation::with('user')->where('uid',$uid)->get()->count()<1){
			$table="N/A";
		}else{
			$table = Datatable::table()
			->addColumn(self::$memberColumnNames)
			->setUrl(route('api.auctionDonations.memberTable',$uid))
			->noScript();
		}
		if(Auth::user()->type!=='member'){
			$locations['Other']='Other';
			$categories['Other']='Other';
		}else{
			unset($locations['Live Auction']);
		}
		return View::make('auctionDonations.resubmit', ['statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories, 'donation'=>$donation, 'table'=>$table]);
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
					$newuser->fill($newuserdata)->save();
					$user=User::where("email",$input['email'])->first();
					$input['uid']=$user->id;
				}
			}
		} 
		
		if($input['location']==='Other'&& isset($input['Other_location'])) {
			$input['location']=$input['Other_location'];
		}
		if($input['category']==='Other'&& isset($input['Other_category'])) {
			$input['category']=$input['Other_category'];
		}

		$input['year']=$this->currentYear();
		if(! $this->auctionDonation->fill($input)->isValid()){
			return Redirect::back()->withInput()->withErrors($this->auctionDonation->errors);
		}
		$this->auctionDonation->save();
		Session::flash('auc_donate_success', true);
		if(Auth::user()->type!=='member'){
			return Redirect::route('auctionDonations.index',$this->currentYear());
		}else{
			return View::make('auctionDonations.success');
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
		$donation=AuctionDonation::with('user')->find($id);
		$locations=$this->getLocations();
		$categories=$this->getCategories();
		if(Auth::user()->type!=='member'){
			$locations['Other']='Other';
			$categories['Other']='Other';
		}else{
			unset($locations['Live Auction']);
		}
		return View::make('auctionDonations.show', ['donation'=>$donation,
		 'statuses'=>$this->getStatuses(), 'locations'=>$locations, 'categories'=>$categories]);
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
		if($input['location']==='Other'&& isset($input['Other_location'])) {
			$input['location']=$input['Other_location'];
		}
		if($input['category']==='Other'&& isset($input['Other_category'])) {
			$input['category']=$input['Other_category'];
		}
		if($input['status']==='Other'&& isset($input['Other_status'])) {
			$input['status']=$input['Other_status'];
		}
		$donation=$this->auctionDonation->find($id)->fill($input);
		if(! $donation->isValid()){
			Redirect::back()->withInput()->withErrors($this->auctionDonation->errors);
		}
		$donation->save();
		Session::flash('auc_update_success', true);
		if(Auth::user()->type!=='member'){
			return Redirect::route('auctionDonations.index',$this->currentYear());
		}else{
			return Redirect::route('auctionDonations.show',$id);
		}
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
	/**
	 * Updates the input donations based off of the other input on the page
	 *	Effectively permits the batch updating of a single field at a time, the field being selected by the user
	 * 
	 * @return Response
	 */

	public function updateBatch()
	{
		$input=Input::all();
		$items=$input['id'];
		if($input['changeTo']==='Other'&& isset($input['other'])) {
			$input['changeTo']=$input['other'];
		}
		$changeTo=$input['changeTo'];
		$field=$input['field'];
		foreach ($items as $id) {
			$donation=AuctionDonation::find($id);
			$donation->$field=$changeTo;
			$donation->save();
		}
		Session::flash('auc_update_success', true);
		return Redirect::back();
		
	}

//Returns the index datatable

	public function getDatatable($year){
		
		$query = auctionDonation::with('user')->where('year',$year)->select(self::$fieldsList)->get();
		return Datatable::collection($query)
		->showColumns(self::$fieldsList)
		->addColumn('id', function($model){
				return Form::checkbox('id[]', $model->id);
		})
		->addColumn('uid', function($model){
			return link_to('users/'.$model->uid, $model->user->first." ".$model->user->last);
		})->addColumn('edit', function($model){
			return link_to('auctionDonations/'.$model->id,'View/Edit');
		})
		->make();
	}
	/**
	*Returns the table of all donations made by the specified user for editing
	*
	* @param int uid
	**/
	public function getUserDatatable($uid){
		
		$query = auctionDonation::with('user')->where('uid',$uid)->select(self::$userFieldsList)->get();
		return Datatable::collection($query)
		->showColumns(self::$userFieldsList)
		->addColumn('id', function($model){
			return link_to('auctionDonations/'.$model->id,'View/Edit');
		})
		->make();
	}
	/**
	*Returns the table of all donations made by the specified user for resubmission
	*
	* @param int uid
	**/
	public function getMemberDatatable($uid){
		
		$query = auctionDonation::with('user')->where('uid',$uid)->select(self::$memberFieldsList)->get();
		return Datatable::collection($query)
		->showColumns(self::$memberFieldsList)
		->addColumn('id', function($model)use($uid){
			return link_to_route('auctionDonations.resubmit','Select',[$uid,$model->id]);
		})
		->make();
	}
	/**
	*Returns the table of all users for user selection (used by admin_create)
	*
	**/
	public function usersPortalDatatable(){	
		$query = User::where('type','member')->select(UsersController::$allFields)->get();
		return Datatable::collection($query)
		->showColumns(UsersController::$allFields)
		->addColumn('id', function($model){
			return link_to_route('auctionDonations.create','Select',[$model->id]);
		})
		->make();
	}
	/**
	*Returns a rough draft of the booklet for the current year. 
	*
	**/
	public function makeBooklet(){		
		$donationsTable = AuctionDonation::with('user')->where('year', AuctionDonationsController::currentYear())->where('location','!=', 'Live Auction')->orderBy('location', 'category', 'ASC')->get();
		$liveAuctionItems = AuctionDonation::with('user')->where('year', AuctionDonationsController::currentYear())->where('location', 'Live Auction')->get();

		return View::make("booklet", ['donationsTable'=>$donationsTable, 'liveAuctionItems'=>$liveAuctionItems]);
	}	
}
