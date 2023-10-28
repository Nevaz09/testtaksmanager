<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="col-auto">
      <a class="navbar-brand">Test
        <!-- <img src="" alt="" class="brand-image img-circle elevation-3"
             style="opacity: .8" width="90px" height="110px"> -->
        <!-- <span class="brand-text font-weight-bold"><small class="font-weight-light">Test</small>PT Korpora Trainindo Consultant </span> -->
      </a>
    </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{Request::is('dashboard')?'active':''}} ">
            <a class="nav-link" href="{{url('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          @if(Auth::user()->role_as == 1 )
          <li class="nav-item {{ Request::is('users')?'active':''}} ">
            <a class="nav-link" href="{{asset('users')}}">
              <i class="fa-solid fa-users"></i> 
              <p>Users</p>
            </a>
          </li><li class="nav-item {{ Request::is('taks')?'active':''}} ">
            <a class="nav-link" href="{{asset('taks')}}">
              <i class="fa-solid fa-users"></i> 
              <p>Taks</p>
            </a>
          </li>
          @elseif(Auth::user()->role_as ==0)
          <li class="nav-item {{ Request::is('taks')?'active':''}} ">
            <a class="nav-link" href="{{asset('taks')}}">
              <i class="fa-solid fa-users"></i> 
              <p>Taks</p>
            </a>
          </li>
          @endif
          
        </ul>
    </div>
</div>