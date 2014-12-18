@extends('layouts.admin')
@section('header') Event Attendance Manager
@stop
@section('content')
  @if($projectsTable!=="N/A")
    <div class="table-responsive">
    <h2> Events and Projects </h2>
    {{$projectsTable->setOptions(['pageLength'=> 5, "dom"=>'TC<"clear">lfrtip', 
                              'tableTools' => array(
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ]]
                          )])->render()}}
    </div>
    @if($eid>=0)
      @if($attendanceTable!=="N/A")
        <div class="table-responsive">
        <h2> Current Attendees of {{$project->name}}</h2>
        {{ Form::open(['route'=>'eventAttendances.destroy', 'method'=>'DELETE']) }}
        {{$attendanceTable->setOptions(['pageLength'=> 5, "dom"=>'TC<"clear">lfrtip', 
                                  'tableTools' => array(
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ]]
                              )])->render()}}
        </div>
      {{Form::hidden('eid',$eid)}}
      {{Form::submit('Delete Selected Attendance')}}
      {{Form::close ()}}
      @else
        <h1>There are currently no attendees of {{$project->name}}</h1>
        <p> You can create one below </p>
      @endif
      {{ Form::open(['route'=>'eventAttendances.store']) }}
      @if($usersTable!=="N/A")

      <div class="table-responsive">
      
      <h2> Attendee Selection </h2>
       {{$usersTable->setOptions(['pageLength'=> 5, "dom"=>'TC<"clear">lfrtip', 
                                'tableTools' => array(
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ]]
                                    )])->render()}}
      </div>
      @else
      <h1>All currently existing users attended</h1>
        <p> You can create a new one below </p>
      @endif
      <div> User not in the database? Input here: {{ Form::label('email', 'Email: ')}} {{Form::text('email') }} {{Form::label('first', 'First: ')}}{{Form::text('first')}} {{Form::label('last', 'Last: ')}}{{Form::text('last')}}
      {{ $errors->first('email')}} {{$errors->first('first')}} {{$errors->first('last')}}
      {{ Form::hidden('eid', $eid)}}</div>

      <div>
      <p> Select the role of the attendees you wish to add: </p>

      {{ Form::label('role', 'Role')}}
      {{ Form::select('role', $roles, $roles)}}
      {{ $errors->first('roles') }}
      {{ Form::label('other', 'Role if other selected')}}
      {{ Form::text('other')}}
      {{ $errors->first('other') }}
      {{Form::submit('Submit')}}
    </div>
      {{Form::close ()}}
    @endif
  @else
    <h1>There are no Projects or Events</h1>
    <p> You can create one here: {{link_to_route('projects.create')}} </p>
  @endif
@endsection

@section('scripts')
  @if($projectsTable!=="N/A")
    @if($eid>=0)
      @if($attendanceTable!=="N/A")
        {{str_replace("\\/","/",$attendanceTable->script())}}
      @endif
      @if($usersTable!=="N/A")
        {{str_replace("\\/","/",$usersTable->script())}}
      @endif
    @endif
    {{str_replace("\\/","/",$projectsTable->script())}}
  @endif
@endsection

