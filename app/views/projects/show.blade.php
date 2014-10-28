@extends('layouts.default')
	
	
@section('header')
  <title>Events</title>

@stop
@section('content')
	
  <h1>{{$project->name}}</h1>
  {{ Form::model(Form::model($project, array('method'=>'PUT', route' => array('projects.update', $project->id))) }}
     <div>
      {{ Form::label('name', 'Name: ')}}
      {{ Form::text('name')}}
      {{ $errors->first('name') }}
    </div>
    <div>
      {{ Form::label('start_date', 'Start Date: ')}}
      {{ Form::text('start_date'e)}}
      {{ $errors->first('start_date') }}
    </div>
    <div>
    {{ Form::label('end_date', 'End Date: ')}}
    {{ Form::text('end_date')}}
    {{ $errors->first('end_date') }}
    </div
    <div>
    {{ Form::label('type', 'Type: ')}}
    {{ Form::text('type')}}
    {{ $errors->first('type') }}
    </div>
    <div>
    {{ Form::label('description', 'Description: ')}}
    {{ Form::text('description'}}
    {{ $errors->first('description') }}
    </div>
    {{Form::submit('Edit Event/Project')}}
  {{Form::close ()}}
  @if($eventAttendance->count()>0)
  <h2> Attendees </h2>
  Id: Name, Role  <br>
      @foreach ($eventAttendance as $ea)
        <?php $user=User::where('id','=', $ea->UID)->first() ?>
        <li>{{link_to("user/{$ea->UID}", $ea->UID) }}: {{$user->first}} {{$user->last}}, {{$ea->role}}</li>
      
      @endforeach
      <br>
   @endif
      <br>
      {{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}<br>{{link_to("monetaryDonations/", 'Monetary Donations Main') }}

@stop