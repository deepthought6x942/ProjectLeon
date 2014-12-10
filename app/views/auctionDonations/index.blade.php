@extends('layouts.index')
@section('header') Auction Donations @stop   
@section('table')

  {{$table->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
                          'tableTools' => array(
                              "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                              "aButtons" => ["csv"]
                      )])->render()}}

@stop
@section('scripts')
  {{str_replace("\\/","/",$table->script())}}
@stop
@section('otherContent')
{{Form::open(['route'=>'auctionDonations.changeYear'])}}
{{Form::label("year", "Select Year: ")}}
{{Form::select("year",$years)}}
{{Form::submit("Select")}}
{{Form::close()}}
@stop