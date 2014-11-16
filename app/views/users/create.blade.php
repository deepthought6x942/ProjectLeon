@extends('layouts.admin_create')

@section('header') Create New Users @stop


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
{{Form::submit('Create User')}}
{{ Form::close() }}

@stop