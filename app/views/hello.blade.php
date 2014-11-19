@extends('layouts.landing')

@section('header')
 Hello 

@stop

@section('content')

<h1> Welcome {{Auth::user()->first}} </h1>
@stop
