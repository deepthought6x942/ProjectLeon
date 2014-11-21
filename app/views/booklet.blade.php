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
        <h2>{{$currentLocation=$donation->location}}</h2> <br>
        <h2>{{$currectCategory=$donation->category}}</h2><br>
    @elseif ($currentCategory!==$donation->category)
        <h2>{{$currectCategory=$donation->category}}</h2><br>
    @endif

        <h3>{{$donation->title}}</h3><br>

        <p>{{$donation->description}} </p><br>

@endforeach

@stop           

