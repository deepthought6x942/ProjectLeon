@extends('layouts.create')
@section('header') Create Auction Donation 
@stop
@section('content')
<div class="col-lg-6">
  {{ Form::open(['route'=>'auctionDonations.store']) }}
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        
        <tr>
          <td>{{ Form::label('title', 'Donation Title: ')}}</td>
          <td>{{ Form::text('title')}}</td>
          <td>{{ $errors->first('title') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('category', 'Category: ')}}</td>
          <td>{{ Form::select('category', $categories)}}</td>
          <td>{{Form::text('other category', "Input other")}}</td>
          <td>{{ $errors->first('category') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('quantity', 'Quantity: ')}}</td>
          <td>{{ Form::text('quantity')}}</td>
          <td>{{ $errors->first('quantity') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('description', 'Description: ')}}</td>
          <td>{{ Form::textarea('description')}}</td>
          <td>{{ $errors->first('description') }}</td>
        </tr>
        <tr>
          <td>{{Form::label('status', 'Status: ')}}</td>
          <td>{{ Form::select('status', $statuses)}}</td>
          <td>{{Form::text('other status', "Input other")}}</td>
          <td> {{ $errors->first('status') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('location', 'Location: ')}}</td>
          <td>{{ Form::select('location', $locations)}}</td>
          <td>{{Form::text('other location', "Input other")}}</td>
          <td>{{ $errors->first('location') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('approximate_value', 'Approximate Value: $')}}</td>
          <td>{{ Form::text('approximate_value')}}</td>
          <td>{{ $errors->first('approximate_value') }}</td>
        </tr>
      </table>
    </div>
  </div>
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
  {{Form::submit('Submit')}}
  {{Form::close ()}}
</div>

  @stop
@section('scripts')
  <script>
    $(document).ready(function() {
        $('#projects').dataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
        $('#attendees').dataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
        $('#users').dataTable();
    });
  </script>
@endsection