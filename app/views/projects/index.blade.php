


@extends('layouts.admin_index')
@section('header')
	<title>Projects</title>
@stop	
@section('tablecontent')

<thead>

{{link_to("projects/create", 'Create a new Project') }} 

<tr>
    <th class="text-center">Project ID</th>
    <th class="text-center">Project Name</th>
    <th class="text-center">Start Date</th>
</tr>
</thead>
<tbody>
@foreach ($projects as $project)


    <tr class="text-center">
        <td>{{link_to("project/{$project->id}", $project->id) }}</td>
        <td>{{$project->name}}</td>
        <td>{{$project->start_date}}</td>

    </tr>

@endforeach

</tbody>
                              
@stop
