<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Gettysburg-León</title>

    <!-- Bootstrap CSS served from a CDN -->


<link href="css/bootstrap.css" rel="stylesheet">
	 <div class="container">
    
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    </div>
	
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
