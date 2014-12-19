@extends('layouts.default_noheader')

@section('header')
  <title>Donations Booklet</title>

@stop


@section('content')

<?php 
$currentLocation="none";
$currentCategory="none";
?>
<h1><strong><center>Live Auction Items</center> </strong></h1>
<ol>
    @foreach($liveAuctionItems as $lai)
    <h4><li>{{$lai->title}}</h4>
        <h5><i>{{$lai->user->first." ".$lai->user->last}}</i></h5>
        <p>{{$lai->description}} </p>
    </li>
    @endforeach
</ol>
@foreach($donationsTable as $donation)
    
    @if ($currentLocation!==$donation->location)
        <h1><strong><center>{{$currentLocation=$donation->location}}</center></strong></h1>
        <h2><strong><center>{{$currentCategory=$donation->category}}</center></strong></h2>
    @elseif ($currentCategory!==$donation->category)
        <h3><center><strong>{{$currentCategory=$donation->category}}</center></strong></h3>
    @endif
        <h4>{{$donation->title}}</h4>
        <h5><i>{{$donation->user->first." ".$donation->user->last}}</i></h5>
		<p>{{$donation->description}} </p>

@endforeach

@stop           

