<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<title>Product Application @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9,10" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
            <script src="{{ asset('scripts/bootstrap/js/html5shiv.min.js')}}"></script>
            <script src="{{ asset('scripts/bootstrap/js/respond.min.js')}}"></script>
    <![endif]-->
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('scripts/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('scripts/jquery/jquery-migrate.js')}}"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('scripts/bootstrap/css/bootstrap.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('scripts/bootstrap/css/bootstrap-theme.min.css')}}" type="text/css" />
    <script type="text/javascript" src="{{ asset('scripts/bootstrap/js/bootstrap.min.js')}}"></script>    
    <!-- fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
    <!-- page style & scripts -->
    @stack('styles')
    @stack('scripts')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
