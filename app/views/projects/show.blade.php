@extends('layouts.create')

@section('header')

@stop
@section('content')


{{ Form::model($project, array('method'=>'PUT', 'route' => array('projects.update', $project->id))) }}
<div class="form-group">
  {{ Form::label('name', 'Name: ')}}
  {{ Form::text('name')}}
  {{ $errors->first('name') }}
</div>
<div class="form-group">
  {{ Form::label('start_date', 'Start Date: ')}}
  {{ Form::text('start_date')}}
  {{ $errors->first('start_date') }}
</div>
<div class="form-group">
  {{ Form::label('end_date', 'End Date: ')}}
  {{ Form::text('end_date')}}
  {{ $errors->first('end_date') }}
  </div>
 <div class="form-group">
    {{ Form::label('type', 'Type: ')}}
    {{ Form::text('type')}}
    {{ $errors->first('type') }}
  </div>
 <div class="form-group">
    {{ Form::label('description', 'Description: ')}}
    {{ Form::text('description')}}
    {{ $errors->first('description') }}
  </div>
  {{Form::submit('Edit Event/Project')}}
  {{Form::close ()}}
  @if($project->eventAttendance->count()>0)
    <h2> Attendees </h2>
    Id: Name, Role  <br>
    @foreach ($project->eventAttendance as $ea)
      <li>{{link_to("users/{$ea->uid}", $ea->uid) }}: {{$ea->user->first}} {{$ea->user->last}}, {{$ea->role}}</li>

    @endforeach
    <br>
  @endif
  @if($project->monetaryDonations->count()>0)
    <h2> Donations </h2>
    Check Number: Name, Amount  <br>
    @foreach ($project->monetaryDonations as $md)
      <li>{{link_to("monetaryDonations/{$md->id}", $md->check_number) }}: {{$md->user->first}} {{$md->user->last}}, {{$md->amount}}</li>

    @endforeach
    <br>
  @endif
  <br>
  

  @stop