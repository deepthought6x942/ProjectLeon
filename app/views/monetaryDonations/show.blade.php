@extends('layouts.default')
	
	
@section('header')
  <title>Events</title>

@stop
@section('content')
	{{var_dump($errors)}}
  <h1>Donation Information</h1>
  {{Form::model($donation, array('method'=>'PUT', 'route' => array('monetaryDonations.update', $donation->id)))}}
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
      {{ $errors->first('check_number') }}
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

<h2> Project info</h2>
  {{link_to("projects/{$donation->eid}", $donation->eid) }}: {{$donation->name}}, {{$donation->start_date}}
<h1> User Info </h2>
  {{link_to("users/{$donation->uid}", $donation->uid) }}: {{$donation->last}}, {{$donation->first}}
<br><br>
      {{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}<br>{{link_to("monetaryDonations/", 'Monetary Donations Main') }}
@stop