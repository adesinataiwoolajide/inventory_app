
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>Inventory Application | {{$ink}}</title>

    <!-- Scripts -->
   <!--  <script src="{{ asset('js/app.js') }}" defer></script> -->
    <link rel="icon" href="{{asset('styling/assets/inventory.jpg')}}" type="image/x-icon">
      <!-- Bootstrap core CSS-->
      <link href="{{asset('styling/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
      <!-- animate CSS-->
      <link href="{{asset('styling/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Icons CSS-->
      <link href="{{asset('styling/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
      <!-- Custom Style-->
      <link href="{{asset('styling/assets/css/app-style.css')}}" rel="stylesheet"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    <div id="app">
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('styling/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('styling/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('styling/assets/js/bootstrap.min.js')}}"></script>
        
      <!-- sidebar-menu js -->
    <script src="{{asset('styling/assets/js/sidebar-menu.js')}}"></script>
      
      <!-- Custom scripts -->
    <script src="{{asset('styling/assets/js/app-script.js')}}"></script>
</body>
</html>
