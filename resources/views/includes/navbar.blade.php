<header>
        <div class="banner--wrap">
            <nav>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand" href="{{url('/')}}">

                                    <h2 style=" font-family:Baskerville,Times,'Times New Roman',serif;
 font-size:50px;
 color:#589017;
 font-variant:small-caps;
 text-align:center;
 font-weight:bold;
 padding:15px 0px 15px 0px; /* Tweak this to your liking */">Physio Aid</h2>
                                    <!-- <img src="{{ asset('public/frontend/images/logo-mine.png') }}" width="360px" alt="#" /> -->


                                </a>
                                <button class="navbar-toggler nav-custome1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle
                                        navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('our-specialists')}}">Our Specialists</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('our-guide')}}">Our Guide</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0)"> Professional Development </a>
                                        </li> -->
                                        @if(Auth::check() )
                                        <li>
                                            <ul class="cart-seperate">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#"><i class="fas fa-bell fa-top-search"></i> <span>2</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#"><i class="fas fa-envelope fa-top-search"></i> <span>2</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        @endif
                                        @if(Auth::check() )
                                            @if(Auth::user()->is_admin == 1)
                                                <li class="nav-item">
                                                    <a class="nav-link btn btn-outline-primary appointment-btn-top" href="{{url('admin/dashboard')}}">Admin Dashboard</a>
                                                </li>
                                            @elseif(Auth::user()->is_admin == 2)   
                                                <li class="nav-item">
                                                    <a class="nav-link btn btn-outline-primary appointment-btn-top" href="{{url('user-dashboard')}}">Dashboard</a>
                                                </li>
                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link btn btn-outline-primary appointment-btn-top" href="{{url('user-dashboard')}}">Dashboard</a>
                                                </li>
                                            @endif    
                                        @else
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-outline-primary appointment-btn-top" href="{{url('login')}}">Login</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>