@extends('layouts.create')


@section('header')
Auction Donations

@stop
@section('content')

{{Form::model($donation, array('method'=>'PUT', 'route' => array('auctionDonations.update', $donation->id)))}}
<table>
  <thead>
    <th>
      Donor First Name
    </th>
    <th>
      Donor Last Name
    </th>
    <th>
      Donation Title
    </th>
    <th>
      Category
    </th>
    <th>
      Quantity
    </th>
    <th>
      Description
    </th>
    <th>
      Approximate Value
    </th>
    <th>
      Amount
    </th>
  </thead>
  <tbody>
    <tr>
      <td>
  {{ Form::text('first', $donation->user->first)}}
  {{ $errors->first('first') }}
</td>
<td>
  {{ Form::text('last', $donation->user->last)}}
  {{ $errors->first('last') }}
</td>
<td>
  {{ Form::text('title')}}
  {{ $errors->first('title') }}
</td>
<td>
  {{ Form::text('category')}}
  {{ $errors->first('category') }}
</td>
<td>
  {{ Form::text('quantity')}}
  {{ $errors->first('quantity') }}
</td>
<td>
  {{ Form::text('description')}}
  {{ $errors->first('description') }}
</td>
<td>
  {{ Form::text('approximate_value')}}
  {{ $errors->first('approximate_value') }}
</td>
<td>
  {{ Form::text('amount')}}
  {{ $errors->first('amount') }}
</td>
<td>
  {{Form::hidden('uid',$donation->uid)}}
  {{Form::hidden('year', $donation->year)}}
  {{Form::hidden('status', 'Not Delivered')}}
</td>
</tr>
</tbody>
</table>


{{Form::submit('Submit')}}
{{Form::close ()}}
  @stop