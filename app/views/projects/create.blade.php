@extends('layouts.create')


@section('header') Create New Event/Project @stop
@section('content')

<div class="col-lg-10">
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
    <td>{{ Form::select('type')}}</td>
     @if(Auth::user()->type!=='member')
            <td>{{Form::text('other type', "Input other")}}</td>
     @endif
    <td>{{ $errors->first('type') }}</td>
  </tr>
  
 <tr>
    <td>{{ Form::label('description', 'Description: ')}}</td>
    <td>{{ Form::textarea('description')}}</td>
    <td>{{ $errors->first('description') }}</td>
  </tr>
  <tr>
  <td> </td>
  <td>{{Form::submit('Create Event/Project')}}</td>
  {{Form::close ()}}
  </table>
@stop