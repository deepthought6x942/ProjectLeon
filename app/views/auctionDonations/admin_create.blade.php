@extends('layouts.create')
@section('header') Select the User @stop
@section('content')
<div class="col-lg-10">
 <div class="table-responsive">
      {{$portalTable->setOptions(['pageLength'=> 10, "dom"=>'C<"clear">lfrtip'])->render()}}
    </div>
</div>

@stop
@section('scripts')
    {{str_replace("\\/","/",$portalTable->script())}}
@stop