@extends('layouts.default')
  
  
@section('header')
  <title>Events</title>

@stop
@section('content')
  
  <h1>Donation Information</h1>
  {{Form::model($donation, array('method'=>'PUT', 'route' => array('auctionDonations.update', $donation->id)))}}
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
      {{ Form::label('title', 'Donation Title: ')}}
      {{ Form::text('title')}}
      {{ $errors->first('title') }}
    </div>
    <div>
      {{ Form::label('Category', 'Category: ')}}
      {{ Form::text('Category')}}
      {{ $errors->first('Category') }}
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
    <div>
    {{ Form::label('year', 'Auction Year: ')}}
    {{ Form::text('year')}}
    {{ $errors->first('year') }}
    </div>
    <div>
    {{ Form::label('amount', 'Amount: $')}}
    {{ Form::text('amount')}}
    {{ $errors->first('amount') }}
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
      {{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}<br>{{link_to("auctionDonations/", 'Auction Donations Main') }}
@stop