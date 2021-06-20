<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <!-- Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,900&amp;display=swap" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/icons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/app.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/app-dark.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" />
  
  <script src="{{ asset('public/admin/js/vendor.min.js') }}" type="text/javascript"></script>


  <!-- Responsive -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>
  <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

    <div class="wrapper">
      @include('includes.admin-sidebar')

      <div class="content-page">
        <div class="content">
          @include('includes.admin-navbar')

          @yield('content-admin')
        </div>
      </div>
    </div>



      <!-- Page Contents -->
    

    <!-- Footer -->

  </body>


  <script src="{{ asset('public/admin/js/app.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/vendor/apexcharts.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/vendor/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/vendor/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/pages/demo.dashboard-analytics.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/app.min.js')}}"></script>

  <script src="{{ asset('public/admin/js/vendor/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/dataTables.bootstrap4.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/dataTables.buttons.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/buttons.html5.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/buttons.flash.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/buttons.print.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/dataTables.keyTable.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/dataTables.select.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/pages/demo.datatable-init.js')}}"></script>

  

  


</html>


