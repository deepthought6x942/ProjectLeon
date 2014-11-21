@extends('layouts.create')
@section('header') Create Auction Donation 
@stop
@section('content')
 <div class="col-lg-6">
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        {{ Form::open(['route'=>'auctionDonations.store']) }}
        <tr>
          <td>{{ Form::label('title', 'Donation Title: ')}}</td>
          <td>{{ Form::text('title')}}</td>
          <td>{{ $errors->first('title') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('category', 'Category: ')}}</td>
          <td>{{ Form::text('category')}}</td>
          <td>{{ $errors->first('category') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('quantity', 'Quantity: ')}}</td>
          <td>{{ Form::text('quantity', '1')}}</td>
          <td>{{ $errors->first('quantity') }}</td>
        </tr><tr>
          <td>{{ Form::label('description', 'Description: ')}}</td>
          <td>{{ Form::text('description')}}</td>
          <td>{{ $errors->first('description') }}</td>
        </tr><tr>
          <td>{{ Form::label('approximate_value', 'Approximate Value: $')}}</td>
          <td>{{ Form::text('approximate_value')}}</td>
          <td>{{ $errors->first('approximate_value') }}</td>
        </tr>
        {{Form::hidden('uid', Auth::user()->id)}}
        {{Form::hidden('year', '2015')}}
        {{Form::hidden('status', 'Not Delivered')}}
        <!-- Hidden fields tracking user ID from auth, and the current year.-->
      </table>
    </div>
  </div>
  {{Form::submit('Submit')}}
  {{Form::close ()}}
</div>
@stop