<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary custom-black-bg sidebar sidebar-dark accordion" id="accordionSidebar">

   
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>
    
    
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link {{($sidebar =='dashboard' && $subsidebar == 'dashboard')?'active':''}}" href="{{url('admin/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
   
    <li class="nav-item">
        <a class="nav-link {{($sidebar =='entry' && $subsidebar == 'entry')?'active':''}}"  href="{{url('admin/data-entry/type1')}}">
            <i class="fa fa-database"></i>
            <span>Data Entry</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{($sidebar =='entry2' && $subsidebar == 'entry2')?'active':''}}"  href="{{url('admin/data-entry/noting-charge')}}">
            <i class="fa fa-database"></i>
            <span>Data Entry 2</span>
        </a>
    </li>
 
    <li class="nav-item">
        <a class="nav-link {{($sidebar =='bill-books' && $subsidebar == 'bill-books')?'active':''}}"  href="{{url('admin/bill-books/type1')}}">
            <i class="fas fa-fw fa-file"></i>
            <span>Bill Book</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{($sidebar =='day-book' && $subsidebar == 'day-book')?'active':''}}"  href="{{url('admin/day-book')}}">
            <i class="fas fa-fw fa-file"></i>
            <span>Day Book</span>
        </a>
    </li>
    @if(Auth::user()->privilege == 1)
    <li class="nav-item">
        <a class="nav-link {{($sidebar =='users' && $subsidebar == 'users')?'active':''}}"  href="{{url('admin/users')}}">
            <i class="fa fa-users"></i>
            <span>Users</span>
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link {{($sidebar =='attendance' && $subsidebar == 'attendance')?'active':''}}"  href="{{url('admin/attendance')}}">
            <i class="fa fa-compress-alt"></i>
            <span>Attendance</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('logout')}}">
            
            <i class="fa fa-sign-out-alt"></i>

            <span>Logout</span>
        </a>
    </li>
   
   

    <!-- <div class="sidebar-heading">
        Interface
    </div>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>
    -->
  
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
