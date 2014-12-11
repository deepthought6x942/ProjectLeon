@extends('layouts.create')

@section('header')
Projects
@stop
@section('content')
<div class="col-lg-8">
<div class="panel panel-default">
  <div class="table-responsive">
    <table class="table">
      {{ Form::model($project, array('method'=>'PUT', 'route' => array('projects.update', $project->id))) }}
      <tbody>
        <tr>
          <td>{{ Form::label('name', 'Name: ')}}</td>
          <td>{{ Form::text('name')}}</td>
          <td>{{ $errors->first('name') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('start_date', 'Start Date: ')}}</td>
          <td>{{ Form::text('start_date')}}</td>
          <td>{{ $errors->first('start_date') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('end_date', 'End Date: ')}}</td>
          <td>{{ Form::text('end_date')}}</td>
          <td>{{ $errors->first('end_date') }}</td>
          </tr>
        <tr>
            <td>{{ Form::label('type', 'Type: ')}}</td>
           <td>{{ Form::select('type', $types)}}</td>
     @if(Auth::user()->type!=='member')
            <td>{{Form::text('other type', "Input other")}}</td>
     @endif
            <td>{{ $errors->first('type') }}</td>
         </tr>
        <tr>
            <td>{{ Form::label('description', 'Description: ')}}</td>
            <td>{{ Form::text('description')}}</td>
            <td>{{ $errors->first('description') }}</td>
        </tr>
        <tr><td>{{Form::submit('Edit Event/Project')}}{{Form::close ()}}<td></tr>

      <tbody>
    </table>
  </div>
  
</div>

  <br>

  @if($project->eventAttendance->count()>0)
  <div class="panel panel-default">
    <div class="panel-heading">
      Event Attendance:
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th></th>
            <th>Name</th>
            <th>Role</th>
          </thead>
          <tbody>
            @foreach ($project->eventAttendance as $ea)
            <tr><td>{{link_to("users/{$ea->uid}", "View/Edit") }} </td><td> {{$ea->user->first}}</td><td> {{$ea->role}}</td></tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <!-- /.table-responsive -->
    </div>
  <!-- /.panel-body -->
  </div>
<!-- /.panel -->
@endif
<br>
  @if(Auth::user()->type=='treasurer')
@if($project->monetaryDonations->count()>0)
  <div class="panel panel-default">
    <div class="panel-heading">
      Monetary Donations: 
    </div>
    <!-- /.panel-heading -->
    
           
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th> Check Number</th>
            <th>Donor name</th>
            <th>Amount</th>
          </thead>
          <tbody>
            @foreach ($project->monetaryDonations as $md)
            <tr><td>{{link_to("monetaryDonations/{$md->id}", $md->check_number) }}</td><td>  {{$md->user->first." ".$md->user->last}} </td><td> {{$md->amount}}</td></tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <!-- /.table-responsive -->
    </div>
  <!-- /.panel-body -->
  </div>
  @endif
<!--/.panel -->
  @endif


  @stop