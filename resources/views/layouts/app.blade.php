<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta name="description" content=""/>
	<meta name="author" content=""/>
	<title>Inventory Application</title>
      <!--favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset('styling/assets/inventory.jpg')}}}" type="image/x-icon"/>
	  <!-- Vector CSS -->
	<link href="{{asset('styling/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	  <!-- simplebar CSS-->
	<link href="{{asset('styling/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
	  <!-- Bootstrap core CSS-->
	<link href="{{asset('styling/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
	  <!-- animate CSS-->
	<link href="{{asset('styling/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
	  <!-- Icons CSS-->
	<link href="{{asset('styling/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
	  <!-- Sidebar CSS-->
	<link href="{{asset('styling/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
	  <!-- Custom Style-->
	<link href="{{asset('styling/assets/css/app-style.css')}}" rel="stylesheet"/>

	<link href="{{asset('styling/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
  	<link href="{{asset('styling/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="app">
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @guest

    @else
        @include('layouts.sidebar')
    @endguest
    
    
  </div>
  <script src="{{asset('styling/assets/js/jquery.min.js')}}"></script>
  <script src="{{asset('styling/assets/js/popper.min.js')}}"></script>
  <script src="{{asset('styling/assets/js/bootstrap.min.js')}}"></script>
	
 <!-- simplebar js -->
  <script src="{{asset('styling/assets/plugins/simplebar/js/simplebar.js')}}"></script>
  <!-- sidebar-menu js -->
  <script src="{{asset('styling/assets/js/sidebar-menu.js')}}"></script>
  <!-- loader scripts -->
  <script src="{{asset('styling/assets/js/jquery.loading-indicator.html')}}"></script>
  <!-- Custom scripts -->
  <script src="{{asset('styling/assets/js/app-script.js')}}"></script>
  <!-- Chart js -->
  <script src="{{asset('styling/assets/js/widgets.js')}}"></script>
  <script src="{{asset('styling/assets/plugins/Chart.js/Chart.min.js')}}"></script>
  <!-- Vector map JavaScript -->
  <script src="{{asset('styling/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
  <script src="{{asset('styling/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- Easy Pie Chart JS -->
  <script src="{{asset('styling/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
  <!-- Sparkline JS -->
  <script src="{{asset('styling/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('styling/assets/plugins/jquery-knob/excanvas.js')}}"></script>
  <script src="{{asset('styling/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/jszip.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('styling/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js')}}"></script>

    
  <script>
    $(document).ready(function() {
     //Default data table
      $('#default-datatable').DataTable();


      var table = $('#example').DataTable( {
       lengthChange: false,
       buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
     } );

    table.buttons().container()
       .appendTo( '#example_wrapper .col-md-6:eq(0)' );
     
     } );

   </script>
  <!-- Index js -->
  <script src="{{asset('styling/assets/js/index.js')}}"></script>

    <script>
      function confirmToDelete(){
          return confirm("Click Okay to Delete Details and Cancel to Stop");
      }
    </script>

    <script>
      function confirmToEdit(){
          return confirm("Click Okay to Edit and Cancel to Stop");
      }
    </script>

    <script>
      function confirmToRestore(){
          return confirm("Click Okay to Restore The Deleted Data and Cancel to Stop");
      }
    </script>
    <script>
      function confirmToPay(){
          return confirm("Click Okay to Make The Payment and Cancel to Stop");
      }
    </script>

    <script>
      function confirmToPayCredit(){
          return confirm("Click Okay to Clear The Credit and Cancel to Stop");
      }
    </script>



    
    
  </body>
  </html>