@extends('layouts.admin_create')
@section('header')
 
@stop
@section('content')
  {{Form::model($donation, array('method'=>'PUT', 'route' => array('monetaryDonations.update', $donation->id)))}}
     <div class="form-group">
      {{ Form::label('first', 'Donor First Name: ')}}
      {{ Form::text('first', $donation->user->first)}}
      {{ $errors->first('first') }}
    </div>
    <div class="form-group">
      {{ Form::label('last', 'Donor Last Name: ')}}
      {{ Form::text('last', $donation->user->last)}}
      {{ $errors->first('last') }}
    </div>
    <div class="form-group">
      {{ Form::label('check_number', 'Check Number: ')}}
      {{ Form::text('check_number')}}
      {{ $errors->first('check_number') }}
    </div>
    <div class="form-group">
    {{ Form::label('project_name', 'Associated Project ')}}
    <?php
      $projects=Project::all();
      $labels=array();
      foreach ($projects as $project) {
        $labels[$project->id]= $project->name.", ".$project->start_date;
      }
    ?>
    {{ Form::select('project_name', $labels)}}
    {{ $errors->first('project_name') }}
    </div>
    <div class="form-group">
    {{ Form::label('date', 'Date: ')}}
    {{ Form::text('date')}}
    {{ $errors->first('date') }}
    </div>
    <div class="form-group">
    {{ Form::label('amount', 'Amount: $')}}
    {{ Form::text('amount')}}
    {{ $errors->first('amount') }}
    </div>
    {{Form::submit('Submit')}}
  {{Form::close ()}}

@stop