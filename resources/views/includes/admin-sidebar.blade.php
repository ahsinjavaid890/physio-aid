<div class="left-side-menu">
    <!-- LOGO -->
    <a href="{{url('admin/dashboard')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{asset('public/admin/images/logo-mine.png')}}" alt="" height="60" style="margin-left: -30px !important">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_sm.png" alt="" height="16">
        </span>
    </a>
    <!-- LOGO -->
    <a href="{{url('admin/dashboard')}}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{asset('public/admin/images/logo-mine.png')}}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{asset('public/admin/images/logo-mine.png')}}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-title side-nav-item">Navigation</li>

            <li class="side-nav-item">
                <a href="{{url('admin/dashboard')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Specialist </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{url('admin/new/category')}}">Add New</a>
                    </li>
                    <li>
                        <a href="{{url('admin/categories')}}">All Specialist</a>
                    </li>
                </ul>
            </li>
            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Patients </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{url('admin/new/subcategory')}}">Add New</a>
                    </li>
                    <li>
                        <a href="{{url('admin/subcategories')}}">All Patients</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-suitcase-alt"></i>
                    <span> Appointment </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{url('admin/new/case')}}">Add New</a>
                    </li>
                    <li>
                        <a href="{{url('admin/cases')}}">All Appointment</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-suitcase-alt"></i>
                    <span> Messages </span>
                    <span class="menu-arrow"></span>
                </a>
<!--                 <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{url('admin/new/case')}}">Chat With Patient</a>
                    </li>
                    <li>
                        <a href="{{url('admin/cases')}}">Chat With Doctor</a>
                    </li>
                </ul> -->
            </li>

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="uil-list-ul"></i>
                    <span> Blog </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{url('admin/add-blog')}}">Add New</a>
                    </li>

                    <li>
                        <a href="{{url('admin/blogs')}}">All Blogs</a>
                    </li>
                </ul>
            </li>

            <li class="side-nav-item">
                <a href="{{url('admin/users')}}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Users </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{url('admin/websitesettings')}}" class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span> Website Settings </span>
                </a>
            </li>

            
            <li class="side-nav-item">
                <a href="{{url('admin/messages')}}" class="side-nav-link">
                    <i class="uil-envelope"></i>
                    <span> Contact Messages </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{url('admin/profile')}}" class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span> Settings </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="side-nav-link">
                    <i class=" uil-left-arrow-from-left"></i>
                    <span> Logout </span>
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>