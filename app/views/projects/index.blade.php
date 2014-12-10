@extends('layouts.index')
@section('header') Projects @stop	
@section('table')

  {{$table->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
                          'tableTools' => array(
                              "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                              "aButtons" => ["csv"]
                      )])->render()}}

@stop
@section('noneFound')
  <h1>There are no Projects or Events</h1>
  <p> You can create one here: {{link_to_route('projects.create')}} </p>
@endsection