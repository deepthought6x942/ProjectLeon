@extends('layouts.default')
	
@section('header')
  <title>Users</title>

@stop
@section('content')
  <h1>{{$user->first}} {{$user->last}} </h1>
  {{Form::model($user, array('method'=>'PUT', 'route' => array('users.update', $user->id)))}}
     <div>
      {{ Form::label('first', 'First Name: ')}}
      {{ Form::text('first')}}
      {{ $errors->first('first') }}
    </div>
    <div>
      {{ Form::label('last', 'Last Name: ')}}
      {{ Form::text('last')}}
      {{ $errors->first('last') }}
    </div>
    <div>   
    {{ Form::label('email', 'E-mail: ')}}
    {{ Form::text('email')}}
    {{ $errors->first('email') }}
    </div>
    <div>
    {{ Form::label('type', 'Type: ')}}
    {{ Form::text('type')}}
    {{ $errors->first('type') }}
    </div>
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
   <br>
      {{link_to("projects/", 'Projects Main') }}<br>{{link_to("users/", 'Users Main') }}<br>{{link_to("monetaryDonations/", 'Monetary Donations Main') }}

@stop