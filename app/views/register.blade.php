@extends('layouts.default_noheader')

@section('header')
    <title>Register</title>

@stop


@section('content')

    {{ Form::open(['route'=>'users.store']) }}

    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Register Users</div>
                <h5 style="color:red;"> (*) denotes required field </h5>
            </div>


            <table class="table">
                <tbody>
                <tr>
                    <td>{{ Form::label('first', 'First Name')}}(<span>*</span>):</td>
                    <td>{{ Form::text('first')}}</td>
                    <td style="color:red;">{{ $errors->first('first') }}</td>

                </tr>
                <tr>
                    <td>{{ Form::label('last', 'Last Name')}}(<span>*</span>):</td>
                    <td>{{ Form::text('last')}}</td>
                    <td style="color:red;">{{ $errors->first('last') }}</td>

                </tr>

                <tr>
                    <td>{{ Form::label('email', 'E-mail')}}(<span>*</span>):</td>
                    <td>{{ Form::text('email')}}</td>
                    <td style="color:red;">{{ $errors->first('email') }}</td>

                </tr>

                <tr>
                    <td>{{ Form::label('password', 'Password') }}(<span>*</span>):</td>
                    <td>{{ Form::password('password') }}</td>
                    <td style="color:red;">{{ $errors->first('password') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('password_confirmation', 'Password Confirmation') }}(<span>*</span>):</td>
                    <td>{{ Form::password('password_confirmation') }}</td>
                    <td style="color:red;">{{ $errors->first('password_confirmation') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('contact_preference', 'Contact Preference:') }}</td>
                    <td>{{ Form::select('contact_preference', ['E-mail'=>'E-mail', 'Phone'=>'Phone']) }}</td>

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
                    <td>{{ Form::select('state', ['Not selected' => 'Not selected','Not From the US' => 'Not From the US', 'AL'=> 'AL', 'AZ' => 'AZ',
        'AR' => 'AR', 'CA' => 'CA', 'CO' => 'CO', 'CT' => 'CT', 'DE' => 'DE', 'DC' => 'DC', 'FL' => 'FL',
        'GA' => 'GA', 'HI' => 'HI', 'ID' => 'ID', 'IL' => 'IL', 'IN' => 'IN', 'IA' => 'IA', 'KS' => 'KS',
        'KY' => 'KY', 'LA' => 'LA', 'ME' => 'ME', 'MD' => 'MD', 'MA' => 'MA', 'MI' => 'MI', 'MN' => 'MN',
        'MS' => 'MS', 'MO' => 'MO', 'MT' => 'MT', 'NE' => 'NE', 'NV' => 'NV', 'NH' => 'NH', 'NJ' => 'NJ',
        'NM' => 'NM', 'NY' => 'NY', 'NC' => 'NC', 'ND' => 'ND', 'OH' => 'OH', 'OK' => 'OK', 'OR' => 'OR',
        'PA' => 'PA', 'RI' => 'RI', 'SC' => 'SC', 'SD' => 'SD', 'TN' => 'TN', 'TX' => 'TX', 'UT' => 'UT',
        'VT' => 'VT', 'VA' => 'VA', 'WA' => 'WA', 'WV' => 'WV', 'WI' => 'WI', 'WY' => 'WY'])}}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('zip', 'Zip: ') }}</td>
                    <td>{{ Form::text('zip') }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('country', 'Country: ') }}</td>
                    <td>{{ Form::text('country') }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('telephone', 'Phone Number: ') }}</td>
                    <td>{{ Form::text('telephone') }}</td>
                </tr>


                <tr>
                    <td></td>
                    <td>{{Form::submit('Create User')}}</td>


                </tr>
                </tbody>
            </table>

        </div>
    </div>



    {{ Form::close() }}

@stop