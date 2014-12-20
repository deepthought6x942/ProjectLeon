@extends('layouts.default')
@section('header') Make Auction Donation
@stop
@section('content')
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table">
                    {{Form::model($donation, ['route' => array('auctionDonations.store')])}}
                    <tr>
                        <td>{{ Form::label('title', 'Donation Title: ')}}</td>
                        <td>{{ Form::text('title')}}</td>
                        <td>{{ $errors->first('title') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('category', 'Category: ')}}</td>
                        <td>{{ Form::select('category', $categories)}}</td>
                        @if(Auth::user()->type!=='member')
                            <td>{{Form::text('Other category', "Input Other")}}</td>
                        @endif
                        <td>{{ $errors->first('category') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('quantity', 'Quantity: ')}}</td>
                        <td>{{ Form::text('quantity', '1')}}</td>
                        <td>{{ $errors->first('quantity') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('description', 'Description: ')}}</td>
                        <td>{{ Form::textarea('description')}}</td>
                        <td>{{ $errors->first('description') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('approximate_value', 'Approximate Value: $')}}</td>
                        <td>{{ Form::text('approximate_value')}}</td>
                        <td>{{ $errors->first('approximate_value') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('location', 'Location: ')}}</td>
                        <td>{{ Form::select('location', $locations)}}</td>
                        @if(Auth::user()->type!=='member')
                            <td>{{Form::text('Other location', "Input Other")}}</td>
                        @endif
                        <td>{{ $errors->first('location') }}</td>
                    </tr>
                    {{Form::hidden('uid', Auth::user()->id)}}
                    {{Form::hidden('status', 'Not Delivered')}}
                    <!-- Hidden fields tracking user ID from auth.-->
                </table>
            </div>
        </div>
        {{Form::submit('Submit')}}
        {{Form::close ()}}
        @if($table!=="N/A")
            <h4> Resubmit past donation </h4>
            <p> Select the donation from the table below to use as a template for a new donation</p>

            <div class="table-responsive">
                {{$table->setOptions(['pageLength'=> 10, "dom"=>'C<"clear">lfrtip'])->render()}}
            </div>
        @endif

    </div>
@stop
@section('scripts')
    @if($table!=="N/A")
        {{str_replace("\\/","/",$table->script())}}
    @endif
@stop