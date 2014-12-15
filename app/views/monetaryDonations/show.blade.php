@extends('layouts.create')
@section('header')
Monetary Donations
@stop
@section('content')
<div class="col-lg-8">
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        {{Form::model($donation, array('method'=>'PUT', 'route' => array('monetaryDonations.update', $donation->id)))}}
        <tr>
          <td><strong>Donor Name:</strong></td>
          <td>{{link_to_route('users.show', $donation->user->first." ".$donation->user->last, $donation->user->id)}}</td>
        </tr>
        <tr>
          <td>{{ Form::label('check_number', 'Check Number: ')}}</td>
          <td>{{ Form::text('check_number')}}</td>
          <td style="color:red;">{{ $errors->first('check_number') }}</td>
        </tr>
        <tr>
          <td><strong>Associated Project: <strong></td>
          <td>{{link_to_route('projects.show', $donation->project->name, $donation->eid)}}</td>
        </tr>
        <tr>
          <td>{{ Form::label('date', 'Date: ')}}</td>
          <td>{{ Form::text('date')}}</td>
          <td style="color:red;">{{ $errors->first('date') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('amount', 'Amount: $')}}</td>
          <td>{{ Form::text('amount')}}</td>
          <td style="color:red;">{{ $errors->first('amount') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('notes', 'Notes:')}}</td>
          <td>{{ Form::textarea('notes')}}</td>
          <td style="color:red;">{{ $errors->first('notes') }}</td>
        </tr>
        
      </table>
    </div>
    {{Form::submit('Submit')}}
    {{Form::close ()}}

    <!-- /.panel-body -->
  </div>
  <!-- /.panel -->


  @stop