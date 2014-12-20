@extends('layouts.default')
@section('header') Select Member
@stop

@section('content')
    <div class="col-lg-10">
        Donate for yourself {{link_to_route('auctionDonations.create', 'here', Auth::user()->id)}} 
        @if($portalTable!=="N/A")
        or select a member from the list below
        <div class="table-responsive">
            {{$portalTable->setOptions(['pageLength'=> 10, "dom"=>'C<"clear">lfrtip'])->render()}}
        </div>
        @endif
    </div>

@stop
@section('scripts')
	@if ($portalTable!=="N/A")
    	{{str_replace("\\/","/",$portalTable->script())}}
    @endif
@stop