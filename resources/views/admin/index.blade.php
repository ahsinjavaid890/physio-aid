<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,900&amp;display=swap" rel="stylesheet" />
      <script src="../../cdn-cgi/apps/head/OkbNSnEV_PNHTKP2_EYPrFNyZ8Q.js"></script>
      <link href="{{ asset('public/admin/css/icons.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('public/admin/css/app.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('public/admin/css/app-dark.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('public/admin/css/') }}" rel="stylesheet" />
</head>
<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
                                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                                </div>

                                <form action="{{url('admin/dashboard')}}">

                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group">
                                        <a href="pages-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary" href="{{url('admni/dashboard')}}" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- bundle -->
        <script src="{{ asset('public/admin/js/vendor.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('public/admin/js/app.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('public/admin/js/vendor/apexcharts.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('public/admin/js/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('public/admin/js/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
          <script src="{{ asset('public/admin/js/demo.dashboard-analytics.js') }}" type="text/javascript"></script>
          <script src="{{ asset('public/admin/js/') }}" type="text/javascript"></script>
        
    </body>
</html>
