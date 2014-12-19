@extends('layouts.default')

@section('header') Create New Users
@stop


@section('content')

{{ Form::open(['route'=>'users.store']) }}
<div class="form-group">
{{ Form::label('first', 'First Name: ')}}
{{ Form::text('first')}}
{{ $errors->first('first') }}

</div>
<div class="form-group">
{{ Form::label('last', 'Last Name: ')}}
{{ Form::text('last')}}
{{ $errors->first('last') }}
</div>
<div class="form-group">
{{ Form::label('email', 'E-mail: ')}}
{{ Form::text('email')}}
{{ $errors->first('email') }}
</div>
<div class="form-group">
{{ Form::label('password', 'Password') }}
{{ Form::password('password') }}
</div>
<div class="form-group">

 {{ Form::label('address1', 'Address One: ')}}
{{ Form::text('address1')}}
 {{ $errors->first('address1') }}
</div>
<div class="form-group">
{{ Form::label('address2', 'Address Two: ')}}
{{ Form::text('address2')}}
{{ $errors->first('address2') }}
</div>
<div class="form-group">
{{ Form::label('city', 'City: ')}}
{{ Form::text('city')}}
{{ $errors->first('city') }}
</div>
<div class="form-group">
{{ Form::label('state', 'State: ')}}
{{ Form::text('state')}}
{{ $errors->first('state') }}
</div>
<div class="form-group">
{{ Form::label('zip', 'Zipcode: ')}}
{{ Form::text('zip')}}
{{ $errors->first('zip') }}
</div>
<div class="form-group">
{{Form::label('type', 'Type: ')}}
{{ Form::select('type', ['administrator'=>'administrator', 'treasurer'=>'treasurer','member'=>'member'])}}
 {{ $errors->first('type') }}
</div>
<div class="form-group">
{{ Form::label('telephone', 'Phone Number: ')}}
{{ Form::text('telephone')}}
{{ $errors->first('telephone') }}
</div>
{{Form::submit('Create User')}}
{{ Form::close() }}

@stop