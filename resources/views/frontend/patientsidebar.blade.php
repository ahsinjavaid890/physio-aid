<div class="profile-sidebar">
    <!-- SIDEBAR USER TITLE -->
    <div class="profile-usertitle">
        <img src="{{ url('public/images') }}/{{ Auth::user()->profileimage }}" class="img-circle" width="100px">

        <div class="profile-usertitle-name">
        {{ Auth::user()->name }}
        </div>
        <div class="profile-usertitle-job">
            {{ Auth::user()->email }}
        </div>
    </div>
    
    <div class="profile-usermenu">
        <ul>
            <li>
                <a href="{{url('add-case')}}">
                    <i class="fa fa-shopping-cart"></i>
                    Add New Case </a>
            </li>
            <li >
                <a href="{{url('user-dashboard')}}">
                    <i class="fa fa-shopping-cart"></i>
                    My Cases </a>
            </li>
            <li class="active">
                <a href="{{url('user-profile')}}">
                    <i class="fa fa-download"></i>
                    Profile </a>
            </li>
             <li class="">
                <a href="{{url('messages')}}">
                    <i class="fa fa-download"></i>
                    Messages </a>
            </li>
            <li>
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
                    <i class="fa fa-edit"></i>
                    Logout </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
            </li>
        </ul>
    </div>
    <!-- END MENU -->
</div>