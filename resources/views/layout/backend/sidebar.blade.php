<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fa fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-Course</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @can('admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endcan

    @can('user')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-paper-plane"></i>
            <span>Course</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.enrolled') }}">
            <i class="fas fa-fw fa-pencil-alt"></i>
            <span>Enrolled Course</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction.index') }}">
            <i class="fas fa-fw fa-check"></i>
            <span>Transaction History</span></a>
    </li>
    @elseCan('admin')
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>User Dashboard</span></a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('course.index') }}">
            <i class="fas fa-fw fa-paper-plane"></i>
            <span>Course</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('instructor.index') }}">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Instructor</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('qualification.index') }}">
            <i class="fas fa-fw fa-pen"></i>
            <span>Qualification</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Report</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage User</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('chart') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> -->
    @endCan

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>