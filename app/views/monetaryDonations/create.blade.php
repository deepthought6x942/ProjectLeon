@extends('layouts.default')
	
	
@section('header')
  <title>Input Donation</title>

@stop
@section('content')
	
  <!--Implement later: Accessing from different sections will allow you to autofill pieces of this form
    Will require some fiddling, but I can see a structure that might work nicely. 
  -->

  <h1> Enter New Monetary Donation</h1>
  {{ Form::open(['route'=>'monetaryDonations.store']) }}
     <div>
      {{ Form::label('first', 'Donor First Name: ')}}
      {{ Form::text('first')}}
      {{ $errors->first('first') }}
    </div>
    <div>
      {{ Form::label('last', 'Donor Last Name: ')}}
      {{ Form::text('last')}}
      {{ $errors->first('last') }}
    </div>
    <div>
      {{ Form::label('check_number', 'Check Number: ')}}
      {{ Form::text('check_number')}}
      {{ $errors->first('start_date') }}
    </div>
    <div>
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
    <div>
    {{ Form::label('date', 'Date: ')}}
    {{ Form::text('date')}}
    {{ $errors->first('date') }}
    </div>
    <div>
    {{ Form::label('amount', 'Amount: $')}}
    {{ Form::text('amount')}}
    {{ $errors->first('amount') }}
    </div>
    {{Form::submit('Submit')}}
  {{Form::close ()}}
  <br>
      
  
@stop