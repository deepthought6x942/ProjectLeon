@extends('layouts.admin_create')

@section('header') Register @stop


@section('content')

<h1> Create New Users</h1>
{{ Form::open(['route'=>'users.store']) }}
<div>
{{ Form::label('first', 'First Name: ')}}
{{ Form::text('first')}}
{{ $errors->first('first') }}
</div>
<div>
{{ Form::label('last', 'Last Name: ')}}
{{ Form::text('last')}}
{{ $errors->first('last') }}
</div>
<div>
{{ Form::label('email', 'E-mail: ')}}
{{ Form::text('email')}}
{{ $errors->first('email') }}
</div>
<div>
{{ Form::label('password', 'Password') }}
{{ Form::password('password') }}
</div>
{{Form::submit('Create User')}}
{{ Form::close() }}

@stop