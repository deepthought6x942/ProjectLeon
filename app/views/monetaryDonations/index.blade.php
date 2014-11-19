@extends('layouts.index')
@section('header') Monetary Donations @stop	
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
	  @foreach ($monetaryDonations as $donation)	
    <tr class="text-center">
    	<td>{{link_to("monetaryDonations/{$donation->id}", $donation->id) }}</td>
    	<td>{{$donation->user->last}}</td>
        <td>{{$donation->user->first}}</td>
        <td> {{$donation->project->name}}</td>
        <td> ${{$donation->amount}}</td>
    </tr>
    @endforeach
     
</tbody>
                                
@stop
