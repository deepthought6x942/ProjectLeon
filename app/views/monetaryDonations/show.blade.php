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
      <td>{{ Form::label('eid', 'Associated Project: ')}}</td>
      <td>{{ Form::select('eid', $projects, $donation->project->id)}}</td>
      <td>{{ $errors->first('eid') }}</td>
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
    <tr>
      <td>{{ Form::label('notes', 'Notes:')}}</td>
      <td>{{ Form::textarea('notes')}}</td>
      <td>{{ $errors->first('notes') }}</td>
    </tr>
 
</table>
</div>
    {{Form::submit('Submit')}}
  {{Form::close ()}}

  <!-- /.panel-body -->
  </div>
<!-- /.panel -->


@stop