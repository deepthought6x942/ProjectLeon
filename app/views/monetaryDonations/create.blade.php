@extends('layouts.create')



@section('header') Enter New Monetary Donation
@stop


@section('content')

  <!--Implement later: Accessing from different sections will allow you to autofill pieces of this form
    Will require some fiddling, but I can see a structure that might work nicely. 
  -->
<div class="col-lg-8">
  {{ Form::open(['route'=>'monetaryDonations.store']) }}
  
  <div class="panel panel-default">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <td>{{ Form::label('check_number', 'Check Number: ')}}</td>
          <td>{{ Form::text('check_number')}}</td>
          <td style="color:red;">{{ $errors->first('check_number') }}</td>
        </tr><tr>
          <td>{{ Form::label('date', 'Date: ')}}</td>
          <td>{{ Form::text('date',null, array('id' => 'datepicker'))}}</td>
          <td style="color:red;">{{ $errors->first('date') }}</td>
        </tr><tr>
          <td>{{ Form::label('amount', 'Amount: $')}}</td>
          <td>{{ Form::text('amount')}}</td>
          <td style="color:red;">{{ $errors->first('amount') }}</td>
        </tr>
        <tr>
          <td>{{ Form::label('notes', 'Notes:')}}</td>
          <td>{{ Form::textarea('notes')}}</td>
          <td style="color:red;" >{{ $errors->first('notes') }}</td>
        </tr>
      </table>
    </div>
  </div>
  
@if($projectsTable!=="N/A")
    <p>Select the Associated Event or Project from the table below. If it is not present, you can create a new one {{link_to_route('projects.create','here')}}
    <div class="table-responsive">
    <h2> Events and Projects </h2>
    {{$projectsTable->setOptions(['pageLength'=> 10, "dom"=>'C<"clear">lfrtip'])->render()}}
    </div>
@else
  <p>There are no projects, make one {{link_to_route('projects.create','here')}} </p>
@endif

  <p> Select the user from the table below. If they are not present in the database, enter their name and email in the boxes below the table and select submit.
  
  <div class="panel panel-default">
    <div class="table-responsive">
      {{$usersTable->setOptions(['pageLength'=> 10, "dom"=>'C<"clear">lfrtip'])->render()}}
    </div>
  </div>
  {{ Form::label('email', 'Email: ')}} {{Form::text('email') }} {{Form::label('first', 'First: ')}}{{Form::text('first')}} {{Form::label('last', 'Last: ')}}{{Form::text('last')}}
  {{ $errors->first('email')}} {{$errors->first('first')}} {{$errors->first('last')}}
  {{Form::submit('Submit')}}
  {{Form::close ()}}
</div>
@stop

@section('scripts')
  @if($projectsTable!=="N/A")
      @if($usersTable!=="N/A")
        {{str_replace("\\/","/",$usersTable->script())}}
      @endif
    {{str_replace("\\/","/",$projectsTable->script())}}
  @endif
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
@endsection


@section('scripts')

<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>

  @stop