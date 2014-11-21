@extends('layouts.create')

@section('header')
Users

@stop
@section('content')
{{Form::model($user, array('method'=>'PUT', 'route' => array('users.update', $user->id)))}}
<table>
  <thead>
    <th>
      First Name
    </th>
    <th>
      Last Name
    </th>
    <th>
      Email
    </th>
    <th>
      Type
    </th>
  </thead>
  <tbody>
    <tr>
      <td>
        {{ Form::text('first')}}
        {{ $errors->first('first') }}
      </td>

      <td>
        {{ Form::text('last')}}
        {{ $errors->first('last') }}
      </td>
      <td>
        {{ Form::text('email')}}
        {{ $errors->first('email') }}
      </td>
      <td>
        {{ Form::select('type', ['admin'=>'admin', 'member'=>'member'])}}
        {{ $errors->first('type') }}
      </td>
    </tr>

  </tbody>
</table>
{{Form::submit('Edit User')}}
{{Form::close ()}}


@if($user->eventAttendance->count()>0)
  <div class="panel panel-default">
    <div class="panel-heading">
      Event Attendance:
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th> Id</th>
            <th>Name</th>
            <th>Role</th>
          </thead>
          <tbody>
            @foreach ($user->eventAttendance as $ea)
            <tr><td>{{link_to("projects/{$ea->eid}", $ea->eid) }} </td><td> {{$ea->project->name}}</td><td> {{$ea->role}}</td></tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <!-- /.table-responsive -->
    </div>
  <!-- /.panel-body -->
  </div>
<!-- /.panel -->
@endif
@if($user->auctionDonations->count()>0)
  <div class="panel panel-default">
    <div class="panel-heading">
      Auction Donations:
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th> Id</th>
            <th>Title</th>
            <th>Status</th>
          </thead>
          <tbody>
            @foreach ($user->auctionDonations as $ad)
            <tr><td>{{link_to("auctionDonations/{$ad->id}", $ad->id) }}</td><td>  {{$ad->title}}</td><td> {{$ad->status}}</td></tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <!-- /.table-responsive -->
    </div>
  <!-- /.panel-body -->
  </div>
<!-- /.panel -->
@endif 
<br>
@if($user->monetaryDonations->count()>0)
  <div class="panel panel-default">
    <div class="panel-heading">
      Monetay Donations: 
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th> Check Number</th>
            <th>Associated Project</th>
            <th>Amount</th>
          </thead>
          <tbody>
            @foreach ($user->auctionDonations as $ad)
            <tr><td>{{link_to("auctionDonations/{$ad->id}", $ad->id) }}</td><td>  {{$ad->title}}</td><td> {{$ad->status}}</td></tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <!-- /.table-responsive -->
    </div>
  <!-- /.panel-body -->
  </div>
<!-- /.panel -->
@endif 

@stop