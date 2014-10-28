<?php

class ProjectsController extends \BaseController {

  protected $project;
  public function __construct (Project $project){
    $this->project=$project;
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
		$projects=Project::all();
   		 return View::make('projects/index')->withProjects($projects);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projects.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $input=Input::all();
    if(! $this->project->fill($input)->isValid()){
      return Redirect::back()->withInput()->withErrors($this->project->errors);
    }
		$this->project->save();
    return Redirect::route('projects.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project=Project::find($id);
		$eventAttendance=EventAttendance::where('EID','=', $project->id)->get();
    return View::make('projects/show', ['project'=>$project, 'eventAttendance'=>$eventAttendance]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project=Project::find($id);
		$eventAttendance=EventAttendance::where('EID','=', $project->id)->get();
		return View::make('projects/show', ['project'=>$project, 'eventAttendance'=>$eventAttendance, 'editable'=>'TRUE']);
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
	    if(! $this->project->fill($input)->isValid()){
	      return Redirect::back()->withInput()->withErrors($this->project->errors);
	    }
	    $project = $this->find($id)->fill($input);
  		$project->save();
	    return Redirect::route('projects.show($id)');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 $project = $this->find($id);
		 $project->delete();
		 return Redirect::route('projects.index');
	}


}
