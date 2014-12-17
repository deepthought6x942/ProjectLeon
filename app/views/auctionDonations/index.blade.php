@extends('layouts.default')
@section('header') Auction Donations @stop   
@section('content')
  {{Form::open(['route'=>'auctionDonations.changeYear'])}}
  {{Form::label("year", "Select Year: ")}}
  {{Form::select("year",$years, $year)}}
  {{Form::submit("Select")}}
  {{Form::close()}}
  @if(Session::has('auc_donate_success'))
  Donation Saved!
  @endif
  @if(Session::has('auc_edit_success'))
  Donation edited!
  @endif
  @if($ndtable!=="N/A")
  
  <h2> Not Delivered Donations </h2>
  <div class="table-responsive">
    {{ Form::open(['route'=>'auctionDonations.updateStatus']) }}
    {{$ndtable->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
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
  </div>
  {{ Form::label('status', 'Status')}}
    {{ Form::select('status', $statuses, $statuses)}}
    {{ $errors->first('statuses') }}
    {{ Form::label('other', 'Role if other selected')}}
    {{ Form::text('other')}}
    {{ $errors->first('other') }}
    {{Form::submit('Submit')}}
    @endif
  @if($table!=="N/A")
    <h2> Other Donations </h2>
    <div class="table-responsive">
    
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
    </div>
    
  @endif
@stop
@section('scripts')
  @if($ndtable!=="N/A")
    {{str_replace("\\/","/",$ndtable->script())}}
  @endif
  @if($table!=="N/A")
    {{str_replace("\\/","/",$table->script())}}
  @endif
@stop
@section('otherContent')
  
@stop
@section('noneFound')
  <h1>There are no Donations for this year</h1>
  <p> You can create one {{link_to_route('auctionDonations.admin_create', 'here')}} </p>


@endsection