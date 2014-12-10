@extends('layouts.index')
@section('header') Users @stop	
@section('table')

  {{$table->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
                          'tableTools' => array(
                              "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                              "aButtons" => ["csv"]
                      )])->render()}}

@stop
@section('noneFound')
<!--They should never be able to see this, but it's here for redundancy -->
  <h1>There are no Users</h1>
  <p> You can create one {{link_to_route('users.create', 'here')}} </p>


@endsection