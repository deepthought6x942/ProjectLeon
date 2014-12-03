@extends('layouts.create')



@section('header') Enter New Monetary Donation @stop


@section('content')

  <!--Implement later: Accessing from different sections will allow you to autofill pieces of this form
    Will require some fiddling, but I can see a structure that might work nicely. 
  -->
<div class="col-lg-8">
  {{ Form::open(['route'=>'monetaryDonations.store']) }}
  <p> Select the user from the table below. If they are not present in the database, enter their name and email in the boxes below the table and select submit.
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="users">
        <thead>
          <tr>
            <th class="text-center">Select</th>
            <th class="text-center">First Name</th>
            <th class="text-center">Last Name</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr class="text-center">
            <td>{{Form::radio('uid', $user->id) }}</td>
            <td>{{$user->first}}</td>
            <td>{{$user->last}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{ Form::label('email', 'Email: ')}} {{Form::text('email') }} {{Form::label('first', 'First: ')}}{{Form::text('first')}} {{Form::label('last', 'Last: ')}}{{Form::text('last')}}
  {{ $errors->first('email')}} {{$errors->first('first')}} {{$errors->first('last')}}
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
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
        <tr>
          <td>{{ Form::label('notes', 'Notes:')}}</td>
          <td>{{ Form::textarea('notes')}}</td>
          <td>{{ $errors->first('notes') }}</td>
        </tr>
      </table>
    </div>
  </div>
    
  {{Form::submit('Submit')}}
  {{Form::close ()}}
</div>
@stop