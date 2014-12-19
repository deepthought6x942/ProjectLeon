@extends('layouts.default_noheader')

@if (Session::has('error'))
  {{ trans(Session::get('reason')) }}
@elseif (Session::has('success'))
  An email with the password reset has been sent.
@endif
 
{{ Form::open(array('route' => 'password.request')) }}
 <div class="container">  
 	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  
 		<div class="panel panel-info" >
 			<div class="panel-heading">
 				<center><div class="panel-title">Enter Email Address Below</div></center>
                       
                    </div>   
   <div style="padding-top:30px" class="panel-body" >
						
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <center>
                        <form id="loginform" class="form-horizontal" role="form">
  							<p>{{ Form::label('email', 'Email') }}
  							{{ Form::text('email') }}</p>
 
  <p>{{ Form::submit('Submit') }}</p>

</center>
</div>
  </div>
 </div>
{{ Form::close() }}