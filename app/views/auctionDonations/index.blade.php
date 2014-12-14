@extends('layouts.index')
@section('header') Auction Donations @stop   
@section('table')
  @if($table!=="N/A")
    {{$table->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
                            'tableTools' => array(
                                    "sRowSelect" =>"multi",
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ],
                                    "select_all", "select_none"]
                        )])->render()}}
  @endif
@stop
@section('scripts')
  @if($table!=="N/A")
    {{str_replace("\\/","/",$table->script())}}
  @endif
@stop
@section('otherContent')
  {{Form::open(['route'=>'auctionDonations.changeYear'])}}
  {{Form::label("year", "Select Year: ")}}
  {{Form::select("year",$years)}}
  {{Form::submit("Select")}}
  {{Form::close()}}
@stop
@section('noneFound')
  <h1>There are no Donations for this year</h1>
  <p> You can create one {{link_to_route('auctionDonations.admin_create', 'here')}} </p>


@endsection