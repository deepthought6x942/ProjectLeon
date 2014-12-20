@extends('layouts.default')
@section('header')
    Auction Donations
@stop
@section('content')
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table">
                    @if(Auth::user()->type!=='member')
                        {{Form::model($donation, array('method'=>'PUT', 'route' => array('auctionDonations.update', $donation->id))) }}
                        <tr>
                            <td><strong>Donor Name:</strong></td>
                            <td>{{link_to_route('users.show', $donation->user->first." ".$donation->user->last,$donation->user->id)}}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('title', 'Donation Title: ')}}</td>
                            <td>{{ Form::text('title')}}</td>
                            <td>{{ $errors->first('title') }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('year', 'Year: ')}}</td>
                            <td>{{ Form::text('year')}}</td>
                            <td>{{ $errors->first('year') }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('category', 'Category: ')}}</td>
                            <td>{{ Form::select('category', $categories)}}</td>
                            @if(Auth::user()->type!=='member' && count($categories) > 1)
                                <td>{{Form::text('Other_category', "Input Other", array('id' => 'Other', 'disabled'))}}</td>
                             @elseif(Auth::user()->type!=='member')
                             <td>{{Form::text('Other_category', "Input Other")}}</td>
                            <td>{{ $errors->first('category') }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td>{{ Form::label('quantity', 'Quantity: ')}}</td>
                            <td>{{ Form::text('quantity')}}</td>
                            <td>{{ $errors->first('quantity') }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('description', 'Description: ')}}</td>
                            <td>{{ Form::textarea('description')}}</td>
                            <td>{{ $errors->first('description') }}</td>
                        </tr>
                        <tr>
                            <td>{{Form::label('status', 'Status: ')}}</td>
                            <td>{{ Form::select('status', $statuses)}}</td>
                            @if(count($statuses) > 1)
                                <td>{{Form::text('Other status', "Input Other", array('id' => 'Other1', 'disabled'))}}</td>
                            @else
                                <td>{{Form::text('Other_category', "Input Other")}}</td>
                            @endif
                            <td> {{ $errors->first('status') }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('location', 'Location: ')}}</td>
                            <td>{{ Form::select('location', $locations)}}</td>
                            @if(count($locations) > 1)
                                <td>{{Form::text('Other_location', "Input Other", array('id' => 'Other2', 'disabled'))}}</td>
                            @else
                                <td>{{Form::text('Other_category', "Input Other")}}</td>
                            @endif
                            <td>{{ $errors->first('location') }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('approximate_value', 'Approximate Value: $')}}</td>
                            <td>{{ Form::text('approximate_value')}}</td>
                            <td>{{ $errors->first('approximate_value') }}</td>
                        </tr>
                        <tr>
                            <td>{{ Form::label('sold_for', 'Sold For: ')}}</td>
                            <td>{{ Form::text('sold_for')}}</td>
                            <td>{{ $errors->first('sold_for') }}</td>
                        </tr>
                </table>
            </div>
        </div>
        {{Form::submit('Submit')}}
        {{Form::close ()}}
        @else
            <tr>
                <td>Donation Title:</td>
                <td>{{ $donation->title}}</td>
            </tr>
            <tr>
                <td>Year:</td>
                <td>{{ $donation->year}}</td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>{{ $donation->category}}</td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td>{{ $donation->quantity}}</td>
            </tr>
            <tr>
                <td>Description:</td>
                <td>{{ $donation->description}}</td>
            </tr>
            <tr>
                <td>Location:</td>
                <td>{{$donation->location}}</td>
            </tr>
            <tr>
                <td>Approximate Value:</td>
                <td>{{ $donations->approximate_value}}</td>
            </tr>
            </table>
    </div>
    </div>
    @endif
    </div>
@stop
@section('scripts')

    <script type=text/javascript>
        jQuery(document).ready(function ($) {
            $('#category').change(function () {
                if ($(this).val() == 'Other') {
                    document.getElementById('Other').disabled = false;
                } else {
                    document.getElementById('Other').disabled = true;
                }

            });
        });
    </script>

    <script type=text/javascript>
        jQuery(document).ready(function ($) {
            $('#status').change(function () {
                if ($(this).val() == 'Other') {
                    document.getElementById('Other1').disabled = false;
                } else {
                    document.getElementById('Other1').disabled = true;
                }

            });
        });
    </script>

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

@stop