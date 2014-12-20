@extends('layouts.default')
@section('header') Make Auction Donation
@stop
@section('content')
    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table">
                    {{ Form::open(['route'=>'auctionDonations.store']) }}
                    <tr>
                        <td>{{ Form::label('title', 'Donation Title ')}} (<span>*</span>):</td>
                        <td>{{ Form::text('title')}}</td>
                        <td style="color:red;">{{ $errors->first('title') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('category', 'Category')}} (<span>*</span>):</td>
                        <td>{{ Form::select('category', $categories)}}</td>
                        @if(Auth::user()->type!=='member')
                            @if(count($categories) > 1)
                                <td>{{Form::text('Other category', "Input Other", array('id' => 'Other1', 'disabled'))}}</td>
                            @else
                                <td>{{Form::text('Other category', "Input Other")}}</td>
                            @endif
                        @endif
                        <td style="color:red;">{{ $errors->first('category') }}</td>

                    </tr>
                    <tr>
                        <td>{{ Form::label('quantity', 'Quantity: ')}}</td>
                        <td>{{ Form::text('quantity', '1')}}</td>
                        <td style="color:red;">{{ $errors->first('quantity') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('description', 'Description: ')}}</td>
                        <td>{{ Form::textarea('description')}}</td>
                        <td style="color:red;">{{ $errors->first('description') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('approximate_value', 'Approximate Value: $')}}</td>
                        <td>{{ Form::text('approximate_value')}}</td>
                        <td style="color:red;">{{ $errors->first('approximate_value') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('location', 'Location')}}(<span>*</span>):</td>
                        <td>{{ Form::select('location', $locations)}}</td>
                        @if(Auth::user()->type!=='member')
                            @if(count($locations) > 1)
                                <td>{{Form::text('Other location', "Input Other", array('id' => 'Other2', 'disabled'))}}</td>
                            @else
                                <td>{{Form::text('Other category', "Input Other")}}</td>
                            @endif
                        @endif
                        <td style="color:red;">{{ $errors->first('location') }}</td>
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
    <script type=text/javascript>
        jQuery(document).ready(function ($) {
            $('#location').change(function () {
                if ($(this).val() == 'Other') {
                    document.getElementById('Other2').disabled = false;
                } else {
                    document.getElementById('Other2').disabled = true;
                }

            });
        });
    </script>

    <script type=text/javascript>
        jQuery(document).ready(function ($) {
            $('#category').change(function () {
                if ($(this).val() == 'Other') {
                    document.getElementById('Other1').disabled = false;
                } else {
                    document.getElementById('Other1').disabled = true;
                }

            });
        });
    </script>

@stop