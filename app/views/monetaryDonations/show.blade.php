@extends('layouts.create')
@section('header')
 Monetary Donations
@stop
@section('content')
  {{Form::model($donation, array('method'=>'PUT', 'route' => array('monetaryDonations.update', $donation->id)))}}

  <table>
    <thead>
      <th>
        Donor First Name
      </th>
      <th>
        Donor Last Name
      </th>
      <th>
        Check Number
      </th>
      <th>
        Project
      </th>
      <th>
        Date
      </th>
      <th>
        Amount
      </th>
     </thead>
     <tbody>
      <tr> 
      <td>
      {{ Form::text('first', $donation->user->first)}}
      {{ $errors->first('first') }}
    </td>
    <td>
      {{ Form::text('last', $donation->user->last)}}
      {{ $errors->first('last') }}
    </td>
    <td>
      {{ Form::text('check_number')}}
      {{ $errors->first('check_number') }}
    </td>
    </div>
    <td>
    <?php
      $projects=Project::all();
      $labels=array();
      foreach ($projects as $project) {
        $labels[$project->id]= $project->name.", ".$project->start_date;
      }
    ?>
    {{ Form::select('project_name', $labels)}}
    {{ $errors->first('project_name') }}
    </td>
    <td>
    {{ Form::text('date')}}
    {{ $errors->first('date') }}
    </td>
    <td>
    {{ Form::text('amount')}}
    {{ $errors->first('amount') }}
    </td>
  </tbody>
</table>
    {{Form::submit('Submit')}}
  {{Form::close ()}}

@stop