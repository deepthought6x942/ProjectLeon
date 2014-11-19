@extends('layouts.admin')
@section('header') Event Attendance Manager
@stop
@section('content')
{{ Form::open(['route'=>'eventAttendances.store']) }}
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" id="projects">
    <h2> Events and Projects </h2>
    <thead>
      <tr>
        <th class="text-center">Select</th>
        <th class="text-center">Project Name</th>
        <th class="text-center">Start Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($projects as $project)
      <tr class="text-center">
        <td>{{Form::radio('eid', $project->id) }}</td>
        <td>{{$project->name}}</td>
        <td>{{$project->start_date}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" id="attendees">
    <h2>Current Attendees</h2>
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Name</th>
        <th class="text-center">Role</th>
      </tr>
    </thead>
    <tbody>
      @if($project->eventAttendance->count()>0)
        @foreach ($project->eventAttendance as $ea)
          <tr>
            <td>{{link_to("users/{$ea->uid}", $ea->uid) }} </td>
            <td>{{$ea->user->first}} {{$ea->user->last}}</td>
            <td> {{$ea->role}}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
<h3> Add new attendee </h3>

<p> Select the attendee from the table below. If they are not present in the database, enter their name and email in the boxes below the table and select submit.

<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" id="users">
    <thead>
      <tr>
        <th class="text-center">Select</th>
        <th class="text-center">First Name</th>
        <th class="text-center">Last Name</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <!--unless([User is already attending]) -->
        <tr class="text-center">
          <td>{{Form::radio('uid', $user->id) }}</td>
          <td>{{$user->first}}</td>
          <td>{{$user->last}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
{{ Form::label('email', 'Email: ')}} {{Form::text('email') }} {{Form::label('first', 'First: ')}}{{Form::text('first')}} {{Form::label('last', 'Last: ')}}{{Form::text('last')}}
{{ $errors->first('email')}} {{$errors->first('first')}} {{$errors->first('last')}}

<p> Select their role: </p>

{{ Form::label('role', 'Role')}}
{{ Form::select('role', $roles, $roles)}}
{{ $errors->first('roles') }}
{{ Form::label('other', 'Role if other selected')}}
{{ Form::text('other')}}
{{ $errors->first('other') }}
{{Form::submit('Submit')}}
{{Form::close ()}}



@stop