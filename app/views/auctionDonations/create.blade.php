@extends('layouts.admin_create')
  
  
@section('header') Create Auction Donation @stop
@section('content')
  <h1> Enter New Auction Donation</h1>
  {{ Form::open(['route'=>'auctionDonations.store']) }}
     <div>
      {{ Form::label('title', 'Donation Title: ')}}
      {{ Form::text('title')}}
      {{ $errors->first('title') }}
    </div>
    <div>
      {{ Form::label('category', 'Category: ')}}
      {{ Form::text('category')}}
      {{ $errors->first('category') }}
    </div>
    <div>
      {{ Form::label('quantity', 'Quantity: ')}}
      {{ Form::text('quantity')}}
      {{ $errors->first('quantity') }}
    </div>
    <div>
    {{ Form::label('description', 'Description: ')}}
    {{ Form::text('description')}}
    {{ $errors->first('description') }}
    </div>
    <div>
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
  <br>{{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}
  
@stop