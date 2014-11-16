@extends('layouts.admin_create')



@section('header') Enter New Monetary Donation @stop


@section('content')

  <!--Implement later: Accessing from different sections will allow you to autofill pieces of this form
    Will require some fiddling, but I can see a structure that might work nicely. 
  -->

  {{ Form::open(['route'=>'monetaryDonations.store']) }}
 <div class="form-group">
    {{ Form::label('first', 'Donor First Name: ')}}
    {{ Form::text('first')}}
    {{ $errors->first('first') }}
  </div>
 <div class="form-group">
    {{ Form::label('last', 'Donor Last Name: ')}}
    {{ Form::text('last')}}
    {{ $errors->first('last') }}
  </div>
  <div class="form-group">
    {{ Form::label('check_number', 'Check Number: ')}}
    {{ Form::text('check_number')}}
    {{ $errors->first('start_date') }}
  </div>
  <div class="form-group">
    {{ Form::label('project_name', 'Associated Project ')}}
    <?php
    $projects=Project::all();
    $labels=array();
    foreach ($projects as $project) {
      $labels[]= $project->name.", ".$project->start_date;
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
  <br>
  
  
  @stop