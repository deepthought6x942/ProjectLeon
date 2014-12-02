@extends('layouts.index')
@section('header') Users @stop	

@section('tablecontent')
<thead>



  <tr>
    <th class="text-center">User ID</th>
    <th class="text-center">First Name</th>
    <th class="text-center">Last Name</th>
    <th class="text-center">Type</th>
  </tr>
</thead>
<tbody>
@foreach ($users as $user)


<tr class="text-center">
  <td>{{link_to("users/{$user->id}", $user->id) }}</td>
  <td>{{$user->first}}</td>
  <td>{{$user->last}}</td>
  <td>{{$user->type}}</td>
</tr>

@endforeach

</tbody>
@stop