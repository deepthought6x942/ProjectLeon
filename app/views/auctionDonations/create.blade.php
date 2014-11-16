@extends('layouts.admin_create')
  
  
@section('header') Create Auction Donation @stop
@section('content')
  {{ Form::open(['route'=>'auctionDonations.store']) }}
     <div class="form-group">
      {{ Form::label('title', 'Donation Title: ')}}
      {{ Form::text('title')}}
      {{ $errors->first('title') }}
    </div>
    <div class="form-group">      {{ Form::label('category', 'Category: ')}}
      {{ Form::text('category')}}
      {{ $errors->first('category') }}
    </div>
    <div class="form-group">
      {{ Form::label('quantity', 'Quantity: ')}}
      {{ Form::text('quantity')}}
      {{ $errors->first('quantity') }}
    </div>
    <div class="form-group">
    {{ Form::label('description', 'Description: ')}}
    {{ Form::text('description')}}
    {{ $errors->first('description') }}
    </div>
    <div class="form-group">
    {{ Form::label('approximate_value', 'Approximate Value: $')}}
    {{ Form::text('approximate_value')}}
    {{ $errors->first('approximate_value') }}
    </div>
    {{Form::hidden('uid', Auth::user()->id)}}
    {{Form::hidden('year', '2015')}}
    {{Form::hidden('status', 'Not Delivered')}}
    <!-- Hidden fields tracking user ID from auth, and the current year.-->

    {{Form::submit('Submit')}}
  {{Form::close ()}}
 
  
@stop