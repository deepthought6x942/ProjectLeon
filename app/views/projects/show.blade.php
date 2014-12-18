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
            <td>{{Form::text('Other', "Input Other")}}</td>
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
        {{$eatable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
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
        {{$mdtable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
      </div>
    <!-- /.table-responsive -->
    </div>
  <!-- /.panel-body -->
  </div>
  @endif
<!--/.panel -->
  @endif


  @stop

  @section('scripts')
  @if($mdtable!=="N/A")
    {{str_replace("\\/","/",$mdtable->script())}}
  @endif
  @if($eatable!=="N/A")
    {{str_replace("\\/","/",$eatable->script())}}
  @endif

  @stop