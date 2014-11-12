@extends('layouts.admin_create')


@section('header') Create Project @stop
@section('content')
  <h1> Create New Event/Project</h1>
  {{ Form::open(['route'=>'projects.store']) }}
  <div>
    {{ Form::label('name', 'Name: ')}}
    {{ Form::text('name')}}
    {{ $errors->first('name') }}
  </div>
  <div>
    {{ Form::label('start_date', 'Start Date: ')}}
    {{ Form::text('start_date')}}
    {{ $errors->first('start_date') }}
  </div>
  <div>
    {{ Form::label('end_date', 'End Date: ')}}
    {{ Form::text('end_date')}}
    {{ $errors->first('end_date') }}
  </div>
  <div>
    {{ Form::label('type', 'Type: ')}}
    {{ Form::text('type')}}
    {{ $errors->first('type') }}
  </div>
  <div>
    {{ Form::label('description', 'Description: ')}}
    {{ Form::text('description')}}
    {{ $errors->first('description') }}
  </div>
  {{Form::submit('Create Event/Project')}}
  {{Form::close ()}}
  <br>
@stop