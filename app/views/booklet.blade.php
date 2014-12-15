@extends('layouts.default_noheader')

@section('header')
  <title>Donations Booklet</title>

@stop


@section('content')

<?php 
$currentLocation="none";
$currentCategory="none";
?>

@foreach($donationsTable as $donation)

    @if ($currentLocation!==$donation->location)
        <h2><strong>{{$currentLocation=$donation->location}}</strong></h2>
        <h3><strong>{{$currentCategory=$donation->category}}</strong></h3>
    @elseif ($currentCategory!==$donation->category)
        <h3><strong>{{$currentCategory=$donation->category}}</strong></h3>
    @endif
        <h4>{{$donation->title}}</h4>
        <h5><i>{{$donation->user->first." ".$donation->user->last}}</i></h5>
		<p>{{$donation->description}} </p>

@endforeach

@stop           

