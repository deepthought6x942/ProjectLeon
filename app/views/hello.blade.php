
@extends('layouts.admin_landing')
@section('header')

@stop	
@section('content')

<h1> Welcome {{Auth::user()->first}} </h1>
@stop
