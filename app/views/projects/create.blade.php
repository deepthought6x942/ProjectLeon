@extends('layouts.default')


@section('header') Create New Event/Project
@stop
@section('content')

    <div class="col-lg-10">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table">

                    {{ Form::open(['route'=>'projects.store']) }}
                    <tr>
                        <td>{{ Form::label('name', 'Name: ')}}(<span class="form">*</span>)</td>
                        <td>{{ Form::text('name')}}</td>
                        <td style="color:red;">{{ $errors->first('name') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('start_date', 'Start Date: ')}} (<span class="form">*</span>)</td>
                        <td>{{ Form::text('start_date',  null, array('id' => 'datepicker'))}}</td>
                        <td style="color:red;">{{$errors->first('start_date') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('end_date', 'End Date: ')}} (<span class="form">*</span>)</td>
                        <td>{{ Form::text('end_date', null, array('id' => 'datepicker2'))}}</td>
                        <td style="color:red;">{{ $errors->first('end_date') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('type', 'Type: ')}}</td>
                        <td>{{ Form::select('type', $types)}}</td>
                        @if(Auth::user()->type!=='member')
                            <td>{{Form::text('Other', "Input Other", array('id' => 'Other', 'disabled'))}}</td>
                        @endif
                        <td style="color:red;">{{ $errors->first('type') }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('description', 'Description: ')}}</td>
                        <td>{{ Form::textarea('description')}}</td>
                        <td style="color:red;">{{ $errors->first('description') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{Form::submit('Create Event/Project')}}</td>
                    </tr>
                    {{Form::close ()}}
                </table>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script type=text/javascript>
        jQuery(document).ready(function ($) {
            $('#type').change(function () {
                if ($(this).val() == 'Other') {
                    document.getElementById('Other').disabled = false;
                } else {
                    document.getElementById('Other').disabled = true;
                }

            });
        });
    </script>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>

    <script>
        $(function () {
            $("#datepicker2").datepicker();
        });
    </script>
@stop