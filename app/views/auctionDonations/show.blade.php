@extends('layouts.default')


@section('header')
<title>Events</title>

@stop
@section('content')

<h1>Donation Information</h1>
{{Form::model($donation, array('method'=>'PUT', 'route' => array('auctionDonations.update', $donation->id)))}}
<div>
  {{ Form::label('first', 'Donor First Name: ')}}
  {{ Form::text('first', $donation->user->first)}}
  {{ $errors->first('first') }}
</div>
<div>
  {{ Form::label('last', 'Donor Last Name: ')}}
  {{ Form::text('last', $donation->user->last)}}
  {{ $errors->first('last') }}
</div>
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
<div>
  {{ Form::label('amount', 'Amount: $')}}
  {{ Form::text('amount')}}
  {{ $errors->first('amount') }}
</div>
<div>
  {{Form::hidden('uid',$donation->uid)}}
  {{Form::hidden('year', $donation->year)}}
  {{Form::hidden('status', 'Not Delivered')}}
</div>


{{Form::submit('Submit')}}
{{Form::close ()}}
<h1> User Info </h2>
  {{link_to("users/{$donation->uid}", $donation->uid) }}: {{$donation->user->last}}, {{$donation->user->first}}
  <br><br>
  {{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}<br>{{link_to("auctionDonations/", 'Auction Donations Main') }}
  @stop