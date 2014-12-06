@extends('layouts.default_noheader')

@section('header')
<title>Register</title>

@stop


@section('content')

{{ Form::open(['route'=>'users.store']) }}

<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
        <div class="panel-heading">
            <div class="panel-title">Register Users</div>
            <h5> (*) denotes required field </h5>
        </div>     

       
        <table class="table">
            <tbody>
                <tr>
                    <td>{{ Form::label('first', 'First Name(*): ')}}</td>
                    <td>{{ Form::text('first')}}</td>
                    <td>{{ $errors->first('first') }}</td>

                </tr>
                <tr>
                    <td>{{ Form::label('last', 'Last Name(*): ')}}</td>
                    <td>{{ Form::text('last')}}</td>
                    <td>{{ $errors->first('last') }}</td>

                </tr>

                <tr>
                    <td>{{ Form::label('email', 'E-mail(*): ')}}</td>
                    <td>{{ Form::text('email')}}</td>
                    <td>{{ $errors->first('email') }}</td>

                </tr>

                <tr>
                    <td>{{ Form::label('password', 'Password(*):') }}</td>
                    <td>{{ Form::password('password') }}</td>
                    <td>{{ $errors->first('password') }}</td>
                </tr>



                <tr>
                    <td>{{ Form::label('address1', 'Address One: ') }}</td>
                    <td>{{ Form::text('address1') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('address2', 'Address Two: ') }}</td>
                    <td>{{ Form::text('address2') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('city', 'City: ') }}</td>
                    <td>{{ Form::text('city') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('state', 'State: ') }}</td>
                    <td>{{ Form::text('state') }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('zip', 'Zip: ') }}</td>
                    <td>{{ Form::text('zip') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('telephone', 'Phone Number: ') }}</td>
                    <td>{{ Form::text('telephone') }}</td>
                </tr>



                <tr>
                    <td> </td>
                    <td>{{Form::submit('Create User')}}</td>


                </tr>
            </tbody>
        </table>

    </div>
</div>



{{ Form::close() }}

@stop