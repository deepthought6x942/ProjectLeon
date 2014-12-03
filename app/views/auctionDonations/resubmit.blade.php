@extends('layouts.create')
@section('header') Make Auction Donation
@stop
@section('content')

  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        {{Form::model($donation, ['route' => array('auctionDonations.store')])}}
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
        <tr>
          <td>{{ Form::label('location', 'Location: ')}}</td>
          <td>{{ Form::select('location', $locations)}}</td>
          @if(Auth::user()->type!=='member')
           <td>{{Form::text('other location', "Input other")}}</td>
          @endif
          <td>{{ $errors->first('location') }}</td>
        </tr>
        {{Form::hidden('uid', Auth::user()->id)}}
        {{Form::hidden('status', 'Not Delivered')}}
        <!-- Hidden fields tracking user ID from auth.-->
      </table>
    </div>
  </div>
  {{Form::submit('Submit')}}
  {{Form::close ()}}
  <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" id="users">
    <thead>
      <tr>
        <th class="text-center">Select</th>
        <th class="text-center">Title</th>
        <th class="text-center">Description</th>
        <th class="text-center">Year</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($userDonations as $donation)
        <!--unless([User is already attending]) -->
        <tr class="text-center">
          <td>{{link_to("auctionDonations/resubmit/{$donation->id}", 'Select') }}</td>
          <td>{{$donation->title}}</td>
          <td>{{$donation->description}}</td>
          <td>{{$donation->year}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@stop