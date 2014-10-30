@extends('layouts.admin_index')
@section('header')
  <title>Auction Donations</title>
@stop 
@section('tablecontent')

<thead>
  
     {{link_to("auctionDonations/create", 'Create a new Donation')}} 
    
    <tr>
      <th class="text-center">Donation ID</th>
        <th class="text-center">Last</th>
        <th class="text-center">First</th>
        <th class="text-center">Title</th>
        <th class="text-center">Status</th>
        
        
        
    </tr>
</thead>
<tbody>


    @foreach ($table as $entry)


    <tr class="text-center">
      <td>{{link_to("auctionDonations/{$entry->id}", $entry->id) }}</td>
      <td>{{$entry->last}}</td>
        <td>{{$entry->first}}</td>
        <td> {{$entry->title}}</td>
        <td> {{$entry->status}}</td>
    </tr>
    
      @endforeach
     
</tbody>
@stop
