@extends('layouts.create')



@section('header') Enter New Monetary Donation @stop


@section('content')

  <!--Implement later: Accessing from different sections will allow you to autofill pieces of this form
    Will require some fiddling, but I can see a structure that might work nicely. 
  -->
<div class="col-lg-6">
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        {{ Form::open(['route'=>'monetaryDonations.store']) }}
        <tr>
          <td>{{ Form::label('first', 'Donor First Name: ')}}</td>
          <td>{{ Form::text('first')}}</td>
          <td>{{ $errors->first('first') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('last', 'Donor Last Name: ')}}</td>
          <td>{{ Form::text('last')}}</td>
          <td>{{ $errors->first('last') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('check_number', 'Check Number: ')}}</td>
          <td>{{ Form::text('check_number')}}</td>
          <td>{{ $errors->first('check_number') }}</td>
        </tr><tr>
          <td>{{ Form::label('eid', 'Associated Project: ')}}</td>
          <td>{{ Form::select('eid', $projects)}}</td>
          <td>{{ $errors->first('eid') }}</td>
        </tr><tr>
          <td>{{ Form::label('date', 'Date: ')}}</td>
          <td>{{ Form::text('date')}}</td>
          <td>{{ $errors->first('date') }}</td>
        </tr><tr>
          <td>{{ Form::label('amount', 'Amount: $')}}</td>
          <td>{{ Form::text('amount')}}</td>
          <td>{{ $errors->first('amount') }}</td>
        </tr>
        <!-- Hidden fields tracking user ID from auth, and the current year.-->
      </table>
    </div>
  </div>
  {{Form::submit('Submit')}}
  {{Form::close ()}}
</div>
  
@stop