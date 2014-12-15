@extends('layouts.index')
@section('header') Users
@stop	
@section('table')

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

@stop
@section('noneFound')
<!--They should never be able to see this, but it's here for redundancy -->
  <h1>There are no Users</h1>
  <p> You can create one {{link_to_route('users.create', 'here')}} </p>


@endsection