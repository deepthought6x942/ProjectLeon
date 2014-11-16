@extends('layouts.admin_create')


@section('header')


@stop
@section('content')

{{Form::model($donation, array('method'=>'PUT', 'route' => array('auctionDonations.update', $donation->id)))}}
<div class="form-group">
  {{ Form::label('first', 'Donor First Name: ')}}
  {{ Form::text('first', $donation->user->first)}}
  {{ $errors->first('first') }}
</div>
<div class="form-group">
  {{ Form::label('last', 'Donor Last Name: ')}}
  {{ Form::text('last', $donation->user->last)}}
  {{ $errors->first('last') }}
</div>
<div class="form-group">
  {{ Form::label('title', 'Donation Title: ')}}
  {{ Form::text('title')}}
  {{ $errors->first('title') }}
</div>
<div class="form-group">
  {{ Form::label('category', 'Category: ')}}
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
<div class="form-group">
  {{ Form::label('amount', 'Amount: $')}}
  {{ Form::text('amount')}}
  {{ $errors->first('amount') }}
</div>
<div class="form-group">
  {{Form::hidden('uid',$donation->uid)}}
  {{Form::hidden('year', $donation->year)}}
  {{Form::hidden('status', 'Not Delivered')}}
</div>


{{Form::submit('Submit')}}
{{Form::close ()}}
  @stop