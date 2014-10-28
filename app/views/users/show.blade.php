@extends('layouts.default')
	
	
@section('header')
  <title>Users</title>

@stop
@section('content')
	
  <h1>{{$user->first}} {{$user->last}} </h1>
  {{Form::model($user, array('method'=>'PUT', 'route' => array('users.update', $user->id)))}}
     <div>
      {{ Form::label('first', 'First Name: ')}}
      {{ Form::text('first')}}
      {{ $errors->first('first') }}
    </div>
    <div>
      {{ Form::label('last', 'Last Name: ')}}
      {{ Form::text('last')}}
      {{ $errors->first('last') }}
    </div>
    <div>   
    {{ Form::label('email', 'E-mail: ')}}
    {{ Form::text('email')}}
    {{ $errors->first('email') }}
    </div>
    <div>
    {{ Form::label('type', 'Type: ')}}
    {{ Form::text('type')}}
    {{ $errors->first('type') }}
    </div>
    {{Form::submit('Edit User')}}
  {{Form::close ()}}
  @if($eventAttendance->count()>0)
    <h2>Event Attendance: </h2>
    Id: name, Role  <br>
        @foreach ($eventAttendance as $ea)
          <?php $project=Project::where('id','=', $ea->EID)->first() ?>
          <li>{{link_to("project/{$ea->EID}", $ea->EID) }}: {{$project->name}}, {{$ea->role}}</li>
      
        @endforeach
   @endif
      <br>
      
      <br>
      {{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}<br>{{link_to("monetaryDonations/", 'Monetary Donations Main') }}

@stop