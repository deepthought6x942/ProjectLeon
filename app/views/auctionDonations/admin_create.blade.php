@extends('layouts.create')
@section('header') Select Member @stop
@section('content')
<div class="col-lg-10">
  Donate for yourself {{link_to_route('auctionDonations.create', 'here', Auth::user()->id)}} or select a member from the list below
 <div class="table-responsive">
    {{$portalTable->setOptions(['pageLength'=> 10, "dom"=>'C<"clear">lfrtip'])->render()}}
  </div>
</div>

@stop
@section('scripts')
    {{str_replace("\\/","/",$portalTable->script())}}
@stop