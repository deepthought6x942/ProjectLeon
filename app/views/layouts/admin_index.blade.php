<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('header')

    <!-- Bootstrap CSS served from a CDN -->
    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/superhero/bootstrap.min.css"
    rel="stylesheet">
    <link rel=stylesheet href="ProjectLeon/public/css/bootstrap.css">
    <link rel=stylesheet href="ProjectLeon/public/css/filtertable.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
   

    <!-- Bootstrap Core CSS -->
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <ul class="dropdown menu left">
          @if (Auth::user()->type==='admin')

          <li>{{link_to("projects/", 'Project Records') }}</li>
          <li>{{link_to("users/", 'User Records') }}</li>
          <li>{{link_to("monetaryDonations/", 'Monetary Donations') }}</li>
          <li>{{link_to("auctionDonations/", 'Auction Donations') }}</li>
          @else
          <li>{{link_to('users/'.Auth::User()->id, 'Your info') }}
            <li>{{link_to("auctionDonations/create", 'Make Auction Donation') }}</li>
            @endif
            <li>{{link_to("logout", 'Logout') }}</li>
        </ul>
        
        
        <h1 class="page-header">@yield('header')</h1>


    </head>

    <body>
   <div class="container">
    
    <hr>
   
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
                    </tr>
                </thead>
                <tbody>
                   @yield('tablecontent')
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- jQuery Version 1.11.0 -->
<script type="text/javascript" src="ProjectLeon/public/js/bootstrap.js"></script>
<script type="text/javascript" src="ProjectLeon/public/js/filtertable.js"></script>

</body>
</html>
