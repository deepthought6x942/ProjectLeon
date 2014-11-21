@extends('layouts.create')


@section('header') Create New Event/Project @stop
@section('content')

<div class="col-lg-6">
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
 
  {{ Form::open(['route'=>'projects.store']) }}
  <tr>
    <td>{{ Form::label('name', 'Name: ')}}</td>
    <td>{{ Form::text('name')}}</td>
    <td>{{ $errors->first('name') }}</td>
  </tr>
  <tr>
    <td>{{ Form::label('start_date', 'Start Date: ')}}</td>
    <td> {{Form::text('start_date')}}</td>
    <td>{{$errors->first('start_date') }}</td>
  </tr>
  <tr>
    <td>{{ Form::label('end_date', 'End Date: ')}}</td>
    <td>{{ Form::text('end_date')}}</td>
    <td>{{ $errors->first('end_date') }}</td>
  </tr>
  <tr>
    <td>{{ Form::label('type', 'Type: ')}}</td>
    <td>{{ Form::text('type')}}</td>
    <td>{{ $errors->first('type') }}</td>
  </tr>
 <tr>
    <td>{{ Form::label('description', 'Description: ')}}</td>
    <td>{{ Form::text('description')}}</td>
    <td>{{ $errors->first('description') }}</td>
  </tr>
  </table>
    </div>
  </div>
  {{Form::submit('Create Event/Project')}}
  {{Form::close ()}}
  </div>
@stop