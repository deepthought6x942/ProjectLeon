@extends('layouts.create')

@section('header')
Projects
@stop
@section('content')


{{ Form::model($project, array('method'=>'PUT', 'route' => array('projects.update', $project->id))) }}
<table>
    <thead>
      <th>
      Project Name
    </th>
    <th>
      Start Date
    </th>
    <th>
      End Date
    </th>
    <th>
      Type
    </th>
    <th>
      Description
    </th>
  </thead>
  <tbody>
  <tr>
  <td>
  {{ Form::text('name')}}
  {{ $errors->first('name') }}
</td>
<td>
  {{ Form::text('start_date')}}
  {{ $errors->first('start_date') }}
</td>
<td>
  {{ Form::text('end_date')}}
  {{ $errors->first('end_date') }}
</td>
 <td>
    {{ Form::text('type')}}
    {{ $errors->first('type') }}
  </td>
  <td>
    {{ Form::text('description')}}
    {{ $errors->first('description') }}
  </td>
</tr>
</tbody>
</table>
  {{Form::submit('Edit Event/Project')}}
  {{Form::close ()}}
  @if($project->eventAttendance->count()>0)
    <h2> Attendees </h2>
    Id: Name, Role  <br>
    @foreach ($project->eventAttendance as $ea)
      <li>{{link_to("users/{$ea->uid}", $ea->uid) }}: {{$ea->user->first}} {{$ea->user->last}}, {{$ea->role}}</li>

    @endforeach
    <br>
  @endif
  @if($project->monetaryDonations->count()>0)
    <h2> Donations </h2>
    Check Number: Name, Amount  <br>
    @foreach ($project->monetaryDonations as $md)
      <li>{{link_to("monetaryDonations/{$md->id}", $md->check_number) }}: {{$md->user->first}} {{$md->user->last}}, {{$md->amount}}</li>

    @endforeach
    <br>
  @endif
  <br>
  

  @stop