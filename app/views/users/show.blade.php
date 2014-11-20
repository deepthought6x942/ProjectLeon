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

    <?php
    $memberType=array();
    array_push($memberType, 'admin', 'member');
    ?>
    {{ Form::select('type', $memberType)}}
    {{ $errors->first('type') }}
  </td>
    </tr>
   
    </tbody>
    </table>
    {{Form::submit('Edit User')}}
  {{Form::close ()}}


  @if($user->eventAttendance->count()>0)
    <h2>Event Attendance: </h2>
    Id: name, Role  <br>
        @foreach ($user->eventAttendance as $ea)
          <li>{{link_to("projects/{$ea->eid}", $ea->eid) }}: {{$ea->project->name}}, {{$ea->role}}</li>
        @endforeach
   @endif
      <br>
    @if($user->auctionDonations->count()>0)
    <h2>Auction Donations: </h2>
    Auction ID, Title, Status  <br>
        @foreach ($user->auctionDonations as $ad)
          <li>{{link_to("auctionDonations/{$ad->id}", $ad->id) }}: {{$ad->title}}, {{$ad->status}}</li>
        @endforeach
   @endif 
      <br>
    @if($user->monetaryDonations->count()>0)
    <h2>Monetay Donations: </h2>
    Auction ID, Title, Status  <br>
        @foreach ($user->monetaryDonations as $md)
          <li>{{link_to("monetaryDonations/{$md->id}", $md->check_number) }}: {{$md->project->name}}, {{$md->amount}}</li>
        @endforeach
   @endif 

@stop