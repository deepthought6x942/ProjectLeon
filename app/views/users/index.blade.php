


@extends('layouts.index')
@section('header') Users @stop	

@section('tablecontent')
<thead>

{{link_to("users/create", 'Create a new user') }} 

  <tr>
    <th class="text-center">User ID</th>
    <th class="text-center">First Name</th>
    <th class="text-center">Last Name</th>
  </tr>
</thead>
<tbody>
@foreach ($users as $user)


<tr class="text-center">
  <td>{{link_to("users/{$user->id}", $user->id) }}</td>
  <td>{{$user->first}}</td>
  <td>{{$user->last}}</td>
</tr>

@endforeach

</tbody>
@stop