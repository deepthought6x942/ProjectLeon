@extends('layouts.create')

@section('header')Users@stop
@section('content')
<div class="col-lg-8">
  {{Form::model($user, array('method'=>'PUT', 'route' => array('users.update', $user->id)))}}

  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <td>{{ Form::label('first', 'First Name: ')}}</td>
            <td>{{ Form::text('first')}}</td>
            <td>{{ $errors->first('first') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('last', 'Last Name: ')}}</td>
            <td>{{ Form::text('last')}}</td>
            <td>{{ $errors->first('last') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('email', 'E-mail: ')}}</td>
            <td>{{ Form::text('email')}}</td>
            <td>{{ $errors->first('email') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('address1', 'Address One: ')}}</td>
            <td>{{ Form::text('address1')}}</td>
            <td>{{ $errors->first('address1') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('address2', 'Address Two: ')}}</td>
            <td>{{ Form::text('address2')}}</td>
            <td>{{ $errors->first('address2') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('city', 'City: ')}}</td>
            <td>{{ Form::text('city')}}</td>
            <td>{{ $errors->first('city') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('state', 'State: ')}}</td>
            <td>{{ Form::text('state')}}</td>
            <td>{{ $errors->first('state') }}</td>
          </tr>
          <tr>
            <td>{{ Form::label('zip', 'Zipcode: ')}}</td>
            <td>{{ Form::text('zip')}}</td>
            <td>{{ $errors->first('zip') }}</td>
          </tr>
          @if(Auth::user()->type!=='member')
          <tr>
            <td>{{Form::label('type', 'Type: ')}}
             <td>{{ Form::select('type', ['administrator'=>'administrator', 'treasurer'=>'treasurer','member'=>'member'])}}</td>
             <td> {{ $errors->first('type') }}</td>
           </tr>
           @endif
           <tr>
            <td>{{ Form::label('telephone', 'Phone Number: ')}}</td>
            <td>{{ Form::text('telephone')}}</td>
            <td>{{ $errors->first('telephone') }}</td>
          </tr>
          <tr><td></td><td>{{Form::submit('Edit User')}}{{Form::close ()}}</td></tr>
        </tbody>
      </table>
    </div>
  </div>
  @if($user->auctionDonations->count()>0)
  <div class="panel panel-default">
    <div class="panel-heading">
      Auction Donations:
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
      <div class="table-responsive">
        {{$adtable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
  </div>
  <!-- /.panel -->
  @endif 
  @if(Auth::user()->type!=='member')
    @if($user->eventAttendance->count()>0)
    <div class="panel panel-default">
      <div class="panel-heading">
        Event Attendance:
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          {{$eatable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
    @endif
    <!-- Remind me to check if they want users to be able to view their own monetary donations-->
    @if($user->monetaryDonations->count()>0 && Auth::user()->type==="treasurer")
    <div class="panel panel-default">
      <div class="panel-heading">
        Monetary Donations: 
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          {{$mdtable->setOptions(['pageLength'=> 5, "dom"=>'C<"clear">lfrtip'])->render()}}
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel --> 
    @endif 
  @endif
</div>
 

  @stop
  @section('scripts')
  @if($mdtable!=="N/A")
    {{str_replace("\\/","/",$mdtable->script())}}
  @endif
  @if($adtable!=="N/A")
    {{str_replace("\\/","/",$adtable->script())}}
  @endif
  @if($eatable!=="N/A")
    {{str_replace("\\/","/",$eatable->script())}}
  @endif
  @stop