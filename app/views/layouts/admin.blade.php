<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>@yield('header')</title>

    <!-- Bootstrap Core CSS -->
    <link href={{asset("css/sb-admin-2.css")}} rel="stylesheet">
    
     <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/cosmo/bootstrap.min.css"
    rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href={{asset("css/plugins/metisMenu/metisMenu.min.css")}} rel="stylesheet">

    <!-- DataTables CSS -->
    <link href={{asset("css/plugins/dataTables.bootstrap.css")}} rel="stylesheet">
    <link href={{asset("css/plugins/dataTables.colVis.css")}} rel="stylesheet">
    <link href={{asset("css/plugins/dataTables.tableTools.css")}} rel="stylesheet">

     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

    <!-- Custom CSS -->
    

    <!-- Custom Fonts -->
    <link href={{asset("font-awesome-4.1.0/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    </head>

    <body>
    
    
  <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <!-- img here -->
            <div class="navbar-header">
                
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand">Project Gettysburg-León Admin</a>

            </div>
            <!-- /.navbar-header -->

            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href={{route('users.index')}}><i class="fa fa-user fa-fw"></i> Users</a>
                        </li>
                       
                        <li>
                            <a href="forms.html"> <i class="fa fa-bar-chart-o fa-fw"></i> Projects<span class="fa arrow"></span></a>
                            
                              <ul class="nav nav-second-level">
                                <li>
                                    {{link_to("projects/", 'List All') }}
                                </li>
                                <li>
                                    {{link_to("projects/create/", 'Create') }}
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user()->type==="treasurer")
                        <li>
                            <a href='#'><i class="fa fa-table fa-fw"></i> Monetary Donations<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                    {{link_to("monetaryDonations/", 'List All') }}
                                </li>
                                <li>
                                    {{link_to("monetaryDonations/create/", 'Create') }}
                                </li>
                                
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="#"> <i class="fa fa-files-o fa-fw"></i> Auction Donations<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    {{link_to_route("auctionDonations.index",'List All', AuctionDonationsController::currentYear()) }}
                                </li>
                                <li>
                                    {{link_to_route("auctionDonations.admin_create", 'Create Donation') }}
                                </li>
                                <li>
                                {{link_to_route("booklet", 'Generate booklet')}} 
                            </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href={{route('eventAttendances.managePortal')}}><i class="fa fa-wrench fa-fw"></i> Manage Event Attendance</a>
                        </li>
                        <li>
                        {{link_to("logout", 'Logout') }}
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- /#page-wrapper -->

   <div id="page-wrapper">
    <h1> @yield('header')</h1>
   @yield('content')
   </div>   <!-- /#wrapper -->

    <!-- jQuery -->
    <script src={{asset("js/jquery.js")}}></script>

    <!-- Bootstrap Core JavaScript -->
    <script src={{asset("js/bootstrap.min.js")}}></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src={{asset("js/plugins/metisMenu/metisMenu.min.js")}}></script>

    <!-- DataTables JavaScript -->
    <script src={{asset ("js/plugins/dataTables/jquery.dataTables.js")}}></script>
    <script src={{asset("js/plugins/dataTables/dataTables.bootstrap.js")}}></script>
    <script src={{asset("js/plugins/dataTables/dataTables.colVis.js")}}></script>
    <script src={{asset("js/plugins/dataTables/dataTables.tableTools.js")}}></script>

    <!-- DatePicker UI -->
    <script src={{asset ("js/jquery-ui.js")}}></script>

    <!-- Custom Theme JavaScript -->
    <script src={{asset("js/sb-admin-2.js")}}></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    
    @yield('scripts')
</body>
</html>
