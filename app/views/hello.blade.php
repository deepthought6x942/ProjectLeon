@extends('layouts.landing')

@section('header') 
Welcome {{Auth::user()->first}} !
@stop

@section('content')


<p> 	This web page serves as a dashboard for your CPS Project Leon profile. The navigation bar located on the left side of the screen allows you to make donations for the upcoming auction and view your donations made in previous auctions. If you have any questions please contact Jeffrey Rioux at jrioux@gettysburg.edu or contact CPS. Thanks! </p>
<br>
<p>	The Center for Public Service</p>
<p> Gettysburg College, Box 2456 </p>
<p> Gettysburg, PA  17325-1486 </p>
<p> Phone: 717-337-6490 </p>

@stop
