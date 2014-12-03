<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Gettysburg-León</title>

    <!-- Bootstrap CSS served from a CDN -->
    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/cosmo/bootstrap.min.css"
    rel="stylesheet">
    
   
    <ul class="dropdown menu left">
      @if (Auth::user()->type==='admin')

  	<li >{{link_to("projects/", 'Project Records') }}</li>
  	<li>{{link_to("users/", 'User Records') }}</li>
 	 <li>{{link_to("monetaryDonations/", 'Monetary Donations') }}</li>
 	 <li>{{link_to("auctionDonations/", 'Auction Donations') }}</li>
   @else
    <li>{{link_to('users/'.Auth::User()->id, 'Your info') }}
    <li>{{link_to("auctionDonations/create", 'Make Auction Donation') }}</li>
  @endif
   <li>{{link_to("logout", 'Logout') }}</li>
	</ul>
	
	
  </head>

  <body>

    <div class="container">
      <div class="row">
       @yield('content')
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  </body>
</html>
