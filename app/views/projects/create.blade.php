@extends('layouts.create')


@section('header') Create New Event/Project @stop
@section('content')
 
  {{ Form::open(['route'=>'projects.store']) }}
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
  {{Form::submit('Create Event/Project')}}
  {{Form::close ()}}
  <br>
@stop