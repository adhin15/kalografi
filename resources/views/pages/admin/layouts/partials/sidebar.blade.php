<div class="navbar-nav sidebar-dark sidebar accordion" id="accordionSidebar" style="background-color: #8F9C69;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}" style="background-color:#8F9C69; ">
        <img src="{{ asset('placeholders/kalografi.png') }}" alt="kalografiLogo" style="width: 75%; height: auto;">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="color: white;">

    <!-- Nav Item - Dashboard -->
    <div class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider" style="color: white;">

    <!-- Nav Item - Discounts -->
    <div class="nav-item">
        <a class="nav-link" href="{{ route('admin.search') }}">
            <i class="fas fa-fw fa-search"></i>
            <span>Search Booking</span></a>
    </div>

    <!-- Nav Item - Packages -->
    <div class="nav-item">
        <a class="nav-link" href="{{ route('admin.paket.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Packages</span></a>
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <div class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFeatures"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Features</span>
        </a>
        <div id="collapseFeatures" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--<h6 class="collapse-header">Login Screens:</h6>--}}
                <a class="collapse-item" href="{{ route('admin.photobook.index') }}">Photobook</a>
                <a class="collapse-item" href="{{ route('admin.printedphoto.index') }}">Printed Photo</a>
                <a class="collapse-item" href="{{ route('admin.additionals.index') }}">Additional Services</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </div>

    <!-- Nav Item - Discounts -->
    <div class="nav-item">
        <a class="nav-link" href="{{ route('admin.discount.index') }}">
            <i class="fas fa-fw fa-percent"></i>
            <span>Discounts</span></a>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="color: white;">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <p class="text-center mb-2"><strong>din mau roko :(</strong> </p>
        <a class="btn btn-success btn-sm" href="#">very sad button</a>
    </div>

</div>
