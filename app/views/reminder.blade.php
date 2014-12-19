@extends('layouts.default_noheader')

@section('header')
<title>Password Reminder</title>

@stop


@section('content')

{{ Form::open(array('url' => 'reminder')) }}
<div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title"> Get Password Reminder</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a style = "color:white" href="#">{{link_to("register", 'Sign Up Here') }}</a></div>
            </div>     

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form">
                    <h5> Please enter the email you signed up with </h5>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="text-center glyphicon glyphicon-user">
                            {{ Form::label('email', '') }}
                            {{ Form::text('email', Input::old('email'), array('placeholder' => 'jdoe@example.com')) }} </i></span>

                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <div class="text-center">
                          <a id="btn-login" href="#" class="btn btn-default">{{ Form::submit('Get Reminder') }} </a>
                        </div>
                    </div>
                    <div class="text-center">
                    <div class="col-md-12 control">
                        <div style="color: black; border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            Don't have an account! 
                        </div>
                        <div style="color: violet">
                            <a >{{link_to("register", 'Sign Up Here') }}</a>
                        </div>
                    </div>
                </div>    
            </form>     
        </div>                     
    </div>  
    {{ Form::close() }}
</div>
@stop         