



@extends('layouts.admin_index')
@section('header')
	<title>Monetary Donations</title>
	
@stop	
@section('tablecontent')

<thead>
	
     {{link_to("monetaryDonations/create", 'Create a new Donation')}} 
    
    <tr>
    	<th class="text-center">Donation ID</th>
        <th class="text-center">Last</th>
        <th class="text-center">First</th>
        <th class="text-center">Event Name</th>
        <th class="text-center">Amount</th>
    </tr>
</thead>
<tbody>
	  @foreach ($table as $entry)	
    <tr class="text-center">
    	<td>{{link_to("monetaryDonations/{$entry->id}", $entry->id) }}</td>
    	<td>{{$entry->last}}</td>
        <td>{{$entry->first}}</td>
        <td> {{$entry->name}}</td>
        <td> ${{$entry->amount}}</td>
    </tr>
    @endforeach
     
</tbody>
                                
@stop
