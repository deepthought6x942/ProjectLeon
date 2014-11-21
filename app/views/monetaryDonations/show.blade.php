@extends('layouts.create')
@section('header')
 Monetary Donations
@stop
@section('content')
 <div class="col-lg-6">
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
  {{Form::model($donation, array('method'=>'PUT', 'route' => array('monetaryDonations.update', $donation->id)))}}

     <tr>
      <td>{{ Form::label('first', 'Donor First Name: ')}}</td>
      <td>{{ Form::text('first', $donation->user->first)}}</td>
      <td>{{ $errors->first('first') }}</td>
    </tr>
    <tr>
      <td>{{ Form::label('last', 'Donor Last Name: ')}}</td>
      <td>{{ Form::text('last', $donation->user->last)}}</td>
      <td>{{ $errors->first('last') }}</td>
    </tr>
    <tr>
      <td>{{ Form::label('check_number', 'Check Number: ')}}</td>
      <td>{{ Form::text('check_number')}}</td>
      <td>{{ $errors->first('check_number') }}</td>
    </tr>
    <tr>
    <td>{{ Form::label('project_name', 'Associated Project ')}}</td>
    <?php
      $projects=Project::all();
      $labels=array();
      foreach ($projects as $project) {
        $labels[$project->id]= $project->name.", ".$project->start_date;
      }
    ?>
    <td>{{ Form::select('project_name', $labels)}}</td>
    <td>{{ $errors->first('project_name') }}</td>
    </tr>
    <tr>
    <td>{{ Form::label('date', 'Date: ')}}</td>
    <td>{{ Form::text('date')}}</td>
    <td>{{ $errors->first('date') }}</td>
    </tr>
    <tr>
    <td>{{ Form::label('amount', 'Amount: $')}}</td>
    <td>{{ Form::text('amount')}}</td>
    <td>{{ $errors->first('amount') }}</td>
    </tr>
 
</table>
</div>
    {{Form::submit('Submit')}}
  {{Form::close ()}}

  <!-- /.panel-body -->
  </div>
<!-- /.panel -->


@stop