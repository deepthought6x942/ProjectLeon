@extends('layouts.default_noheader')

@section('header')
  <title>Register</title>

@stop


@section('content')

{{ Form::open(['route'=>'users.store']) }}
<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Register Users</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
						
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="text-center">
    							 <span class="text-center input-group-addon">
                                        {{ Form::label('first', 'First Name: ')}}
      									{{ Form::text('first')}}</i></span>
      									{{ $errors->first('first') }}
                                                                               
                                    </div>
                              <div style="margin-bottom: 25px" class="text-center">
    							 <span class="text-center input-group-addon">
                                        {{ Form::label('last', 'Last Name: ')}}
      									{{ Form::text('last')}}</i></span>
      									{{ $errors->first('last') }}
                                                                               
                                    </div>
                                    
                                    
    								
    								
    							<div style="margin-bottom: 25px" class="text-center">
    							 <span class="text-center input-group-addon">
                                    {{ Form::label('email', 'E-mail: ')}}
    								{{ Form::text('email')}}</i></span>
    							    {{ $errors->first('email') }}
                                                                               
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="text-center">
                                        <span class="text-center input-group-addon">
                                        {{ Form::label('password', 'Password') }}
										{{ Form::password('password') }}</i></span>
                                    </div>

                            

                                    <div style="margin-bottom: 25px" class="text-center">
                                        <span class="text-center input-group-addon">
                                        {{ Form::label('address1', 'Address 1') }}
                                        {{ Form::text('address1') }}</i></span>
                                    </div>

                                    <div style="margin-bottom: 25px" class="text-center">
                                        <span class="text-center input-group-addon">
                                        {{ Form::label('address2', 'Address 2') }}
                                        {{ Form::text('address2') }}</i></span>
                                    </div>

                                    <div style="margin-bottom: 25px" class="text-center">
                                        <span class="text-center input-group-addon">
                                        {{ Form::label('city', 'City') }}
                                        {{ Form::text('city') }}</i></span>
                                    </div>

                                    <div style="margin-bottom: 25px" class="text-center">
                                        <span class="text-center input-group-addon">
                                        {{ Form::label('state', 'State') }}
                                        {{ Form::text('state') }}</i></span>
                                    </div>

                                    <div style="margin-bottom: 25px" class="text-center">
                                        <span class="text-center input-group-addon">
                                        {{ Form::label('telephone', 'Phone Number') }}
                                        {{ Form::text('telephone') }}</i></span>
                                    </div>
                                    


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="text-center">
                                      <a id="btn-login" href="#" class="btn btn-default">{{Form::submit('Create User')}}</a>

                                    </div>
                                </div>
								

                            </form>     



                        </div>                     
                    </div>  
        			
                    
         {{ Form::close() }}
         
         @stop