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
        <h2><strong>{{$currentLocation=$donation->location}}</strong></h2> <br>
        <h3><strong>{{$currectCategory=$donation->category}}</strong></h3><br>
    @elseif ($currentCategory!==$donation->category)
        <h3>{{$currectCategory=$donation->category}}</h3><br>
    @endif

        <h4>{{$donation->title}}</h4><br>

        <p>{{$donation->description}} </p><br>

@endforeach

@stop           

