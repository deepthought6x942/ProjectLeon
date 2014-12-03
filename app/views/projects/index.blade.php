@extends('layouts.index')
@section('header') Projects @stop	
@section('tablecontent')

<thead>


<tr>
    <th class="text-center">Project ID</th>
    <th class="text-center">Project Name</th>
    <th class="text-center">Start Date</th>
</tr>
</thead>
<tbody>
@foreach ($projects as $project)


    <tr class="text-center">
        <td>{{link_to("projects/{$project->id}", "View/Edit") }}</td>
        <td>{{$project->name}}</td>
        <td>{{$project->start_date}}</td>

    </tr>

@endforeach

</tbody>
                              
@stop
