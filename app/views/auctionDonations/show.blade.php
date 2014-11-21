@extends('layouts.create')


@section('header')
Auction Donations

@stop
@section('content')
 <div class="col-lg-6">
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
{{Form::model($donation, array('method'=>'PUT', 'route' => array('auctionDonations.update', $donation->id)))}}


<tr>
  <td>{{ Form::label('first', 'Donor First Name: ')}}</td>
  <td>{{ Form::text('first', $donation->user->first)}}</td>
  <td>{{ $errors->first('first') }}</td>
</tr>
<tr>
  <td>{{ Form::label('last', 'Donor Last Name: ')}}</td>
  <td>{{ Form::text('last', $donation->user->last)}}</td>
  <td>{{ $errors->first('last') }}</td>
</tr><tr>
  <td>{{ Form::label('title', 'Donation Title: ')}}</td>
  <td>{{ Form::text('title')}}</td>
  <td>{{ $errors->first('title') }}</td>
</tr>
<tr>
  <td>{{ Form::label('year', 'Year: ')}}</td>
  <td>{{ Form::text('year')}}</td>
  <td>{{ $errors->first('year') }}</td>
</tr>
<tr>
  <td>{{ Form::label('category', 'Category: ')}}</td>
  <td>{{ Form::text('category')}}</td>
  <td>{{ $errors->first('category') }}</td>
</tr>
<tr>
  <td>{{ Form::label('quantity', 'Quantity: ')}}</td>
  <td>{{ Form::text('quantity')}}</td>
  <td>{{ $errors->first('quantity') }}</td>
</tr>
<tr>
  <td>{{ Form::label('description', 'Description: ')}}</td>
  <td>{{ Form::text('description')}}</td>
  <td>{{ $errors->first('description') }}</td>
</tr>
<tr>
  <td>{{ Form::label('status', 'Status: ')}}</td>
  <td>{{ Form::text('status')}}</td>
  <td>{{ $errors->first('status') }}</td>
</tr>
<tr>
  <td>{{ Form::label('location', 'Location: ')}}</td>
  <td>{{ Form::text('location')}}</td>
  <td>{{ $errors->first('location') }}</td>
</tr>
<tr>
  <td>{{ Form::label('approximate_value', 'Approximate Value: $')}}</td>
  <td>{{ Form::text('approximate_value')}}</td>
  <td>{{ $errors->first('approximate_value') }}</td>
</tr>
<tr>
  <td>{{ Form::label('sold_for', 'Sold For: ')}}</td>
  <td>{{ Form::text('sold_for')}}</td>
  <td>{{ $errors->first('sold_for') }}</td>
</tr>


 </table>
    </div>
  </div>
  {{Form::submit('Submit')}}
  {{Form::close ()}}
</div>  @stop