<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BinCom | @yield('title')</title>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{secure_asset('assets/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{secure_asset('assets/css/styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{secure_asset('assets/font-awesome-4.1.0/css/font-awesome.min.css')}}">
@section('extra-styles')
@show
  <body>
      <div class="container">
      <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{route('index')}}">INEC Portal</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="{{route('index')}}">Home</a></li>
                <li><a href="{{route('lga_polls')}}">L.G.A Polling Units</a></li>
                <li><a href="{{route('new_result')}}">Add New result</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        @section('content')
        @show()
      </div>
<script src="{{secure_asset('assets/js/jQuery.min.js')}}"></script>
<script src="{{secure_asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{secure_asset('assets/js/sweetalert/sweetalert.min.js')}}"></script>
@section('extra-js')
@show()
</body>
</html>
