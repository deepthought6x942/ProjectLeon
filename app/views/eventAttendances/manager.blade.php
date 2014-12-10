@extends('layouts.admin')
@section('header') Event Attendance Manager
@stop
@section('content')
<div class="table-responsive">
<h2> Events and Projects </h2>
{{$projectsTable->setOptions(['pageLength'=> 5, "dom"=>'TC<"clear">lfrtip', 
                          'tableTools' => array(
                              "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                              "aButtons" => ["csv"]
                      )])->render()}}
</div>
@if($eid>=0)
<div class="table-responsive">
<h2> Current Attendees </h2>
 {{$attendanceTable->setOptions(['pageLength'=> 5, "dom"=>'T<"clear">lfrtip', 
                          'tableTools' => array(
                              "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                              "aButtons" => ["csv"]
                      )])->render()}}
</div>
<div class="table-responsive">
{{ Form::open(['route'=>'eventAttendances.store']) }}

<h2> Attendee Selection </h2>
 {{$usersTable->setOptions(['pageLength'=> 5, "dom"=>'T<"clear">lfrtip', 
                          'tableTools' => array(
                              "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                              "aButtons" => ["csv"]
                      )])->render()}}
</div>

{{ Form::label('email', 'Email: ')}} {{Form::text('email') }} {{Form::label('first', 'First: ')}}{{Form::text('first')}} {{Form::label('last', 'Last: ')}}{{Form::text('last')}}
{{ $errors->first('email')}} {{$errors->first('first')}} {{$errors->first('last')}}
{{ Form::hidden('eid', $eid)}}
<p> Select their role: </p>

{{ Form::label('role', 'Role')}}
{{ Form::select('role', $roles, $roles)}}
{{ $errors->first('roles') }}
{{ Form::label('other', 'Role if other selected')}}
{{ Form::text('other')}}
{{ $errors->first('other') }}
{{Form::submit('Submit')}}
{{Form::close ()}}
@endif
@endsection

@section('scripts')
@if($eid>=0)
{{str_replace("\\/","/",$attendanceTable->script())}}
{{str_replace("\\/","/",$usersTable->script())}}
@endif
{{str_replace("\\/","/",$projectsTable->script())}}

@endsection
