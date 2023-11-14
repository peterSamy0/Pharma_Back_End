
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Pharma</title>
<!-- plugins:css -->
<link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<!-- End Plugin css for this page -->
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="../../assets/css/style.css">
<!-- End layout styles -->
<link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" style="background-color: #3c6167;" id="sidebar">
<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background-color: #3c6167">
{{-- <a class="sidebar-brand brand-logo" href="../../index.html"><img src="../../assets/images/logo.svg" alt="logo" /></a> --}}
<a class="sidebar-brand brand-logo " href="../../index.html" style="color: azure; font-size:20px; font-weight:bold; text-decoration:none;">Pharma</a>
<a class="sidebar-brand brand-logo-mini" href="/" style="color: azure; font-size:20px; font-weight:bold; text-decoration:none;">Ph</a>
</div>
<ul class="nav">
<li class="nav-item profile">
<div class="profile-desc">
<div class="profile-pic">
<div class="count-indicator">
<img class="img-xs rounded-circle " src="../../assets/images/logo.png" alt="">
<span class="count bg-success"></span>
</div>
{{-- <div class="profile-name">
<h5 class="mb-0 font-weight-normal">rawan ramadan</h5>
<span>Gold Member</span>
</div> --}}
{{-- <div class="profile-name">
<h5 class="mb-0 font-weight-normal">{{ $name }}</h5>
<span>
    Gold Member</span>
</div>
--}}
@if (Auth::check())
<div class="profile-name">
<h5 class="mb-0 font-weight-normal" style="color: aliceblue">{{ Auth::user()->name }}</h5>
<span style="color: aliceblue">{{ Auth::user()->role}}</span>
</div>
@else
<div class="profile-name">
<h5 class="mb-0 font-weight-normal"></h5>
</div>
@endif
</div>
{{-- <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a> --}}
<div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
<a href="#" class="dropdown-item preview-item">
<div class="preview-thumbnail">
<div class="preview-icon bg-dark rounded-circle">
<i class="mdi mdi-settings text-primary"></i>
</div>
</div>
<div class="preview-item-content">
<p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
</div>
</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item preview-item">
<div class="preview-thumbnail">
<div class="preview-icon bg-dark rounded-circle">
<i class="mdi mdi-onepassword text-info"></i>
</div>
</div>
<div class="preview-item-content">
<p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
</div>
</a>
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item preview-item">
<div class="preview-thumbnail">
<div class="preview-icon bg-dark rounded-circle">
<i class="mdi mdi-calendar-today text-success"></i>
</div>
</div>
<div class="preview-item-content">
<p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
</div>
</a>
</div>
</div>
</li>
<li class="nav-item nav-category">
<span class="nav-link" style="color:aliceblue">Navigation</span>
</li>
<li class="nav-item menu-items">
<a checked class="nav-link" href="/">
<span class="menu-icon">
<i class="mdi mdi-speedometer"></i>
</span>
<span class="menu-title" style="color:aliceblue">Dashboard</span>
</a>
</li>
<li class="nav-item menu-items">
<a class="nav-link" href="{{ route('medications.index') }}">

<span class="menu-icon">
<i class="mdi mdi-laptop"></i>
</span>
<span class="menu-title" style="color: aliceblue">Medication</span>
</a>
</li>
<li class="nav-item menu-items">
<a class="nav-link" href="{{ route('pharmacies.index') }}">
<span class="menu-icon">
<i class="mdi mdi-playlist-play"></i>
</span>
<span class="menu-title" style="color: aliceblue">Pharmacy</span>
</a>
</li>

<li class="nav-item menu-items">
    <a class="nav-link" href="{{ route('clients.index') }}">
    <span class="menu-icon">
    <i class="mdi mdi-playlist-play"></i>
    </span>
    <span class="menu-title" style="color: aliceblue">Client</span>
    </a>
    </li>
    <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('deliveries.index') }}">
        <span class="menu-icon">
        <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title" style="color: aliceblue">Delivery</span>
        </a>
    </li>
    <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('orders.index') }}">
        <span class="menu-icon">
        <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title" style="color: aliceblue">Order</span>
        </a>
    </li>
</ul>
</nav>
<div class="container-fluid page-body-wrapper">
<nav class="navbar p-0 fixed-top d-flex flex-row" style="background-color: #3c6167">
<div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center "  style="background-color:  #3c6167"> 
<a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
</div>
<div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
<button class="navbar-toggler navbar-toggler align-self-center" style="color: aliceblue" type="button" data-toggle="minimize">
<span class="mdi mdi-menu"></span>
</button>
<ul class="navbar-nav w-100">
<h4 class="text-center" style="position: relative; left:40%">Admin Dashboard</h4>
{{-- <li class="nav-item w-100"> --}}
{{-- <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
<input type="text" class="form-control" placeholder="Search products">
</form> --}}
{{-- </li> --}}
</ul>
{{-- <ul class="navbar-nav navbar-nav-right">

<li> --}}
    {{-- <ul class="navbar-nav ms-auto"> --}}
        {{-- <li class="nav-item dropdown">
            <h2 id="navbarDropdown" style="" class="nav-link dropdown-toggle " role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </h2>
            
            <div class="dropdown-menu dropdown-menu-end" style=" background-color:aliceblue"  aria-labelledby="navbarDropdown">
                
                <a style="color:#9ecfd3; background-color:aliceblue" class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
        
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li> --}}
        <li class="nav-item dropdown" style=" list-style-type: none; top:20%">
            <a id="navbarDropdown" style="color: aliceblue" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
        
            <div class="dropdown-menu dropdown-menu-end" style="background-color:aliceblue">
                
                <h6 class="dropdown-header" style="color: #3c6167">{{ __('Options') }}</h6>
                
                <a class="dropdown-header" style="color: #3c6167" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    {{-- </ul>         --}}
</li>

</ul>
{{-- <li class="nav-item dropdown">
<a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
<div class="navbar-profile">
    <img class="img-xs rounded-circle " src="../../assets/images/logo.png" alt="">
</div> 
@if (Auth::check())
<div class="profile-name">
<h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
</div>
@else
<div class="profile-name">
<h5 class="mb-0 font-weight-normal"></h5>
</div>
@endif
</a>
<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
<h6 class="p-3 mb-0">Profile</h6>
<div class="dropdown-divider"></div>
<a class="dropdown-item preview-item">
<div class="preview-thumbnail">
<div class="preview-icon bg-dark rounded-circle">
<i class="mdi mdi-settings text-success"></i>
</div>
</div>
<div class="preview-item-content">
<p class="preview-subject mb-1">Settings</p>
</div>
</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item preview-item">
<div class="preview-thumbnail">
<div class="preview-icon bg-dark rounded-circle">
<i class="mdi mdi-logout text-danger"></i>
</div>
</div>
<div class="preview-item-content">
<p class="preview-subject mb-1">Log out</p>
</div>
</a>
<div class="dropdown-divider"></div>
<p class="p-3 mb-0 text-center">Advanced settings</p>
</div>
</li> --}}
</ul>
<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
<span class="mdi mdi-format-line-spacing"></span>
</button>
</div>
</nav>
<!-- partial -->
<div class="main-panel">
    
<div class="content-wrapper">
@if(isset($medications))
@include('Medication.index')
@endif
@if(isset($pharmacies))
@include('Pharmacy.index')
@endif
@if(isset($clients))
@include('Client.index')
@endif
 @if(isset($deliveries))
@include('Delivery.index')
@endif
 @if(isset($orders))
@include('Order.index')
@endif
{{-- @if(isset($tourguides))
@include('Tourguide.index') 
@endif    --}}

</div>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
{{-- <footer class="footer">
<div class="d-sm-flex justify-content-center justify-content-sm-between">
<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Ta-meri.com 2023</span>
</div>
</footer> --}}
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>

<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
{{-- <script>
const adminUsersRoute = "{{ route('admin.users') }}";
</script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
$('#tourists').on('click', function(e) {
e.preventDefault();
$.get("{{ route('tourists.index') }}", function(data) {
$('#displayContent').html(data);
});
});

$('#users').on('click', function(e) {
e.preventDefault();
$.get("{{ route('users.index') }}", function(data) {
$('#displayContent').html(data);
});
}); --}}
{{-- </script> --}}
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/hoverable-collapse.js"></script>
<script src="../../assets/js/misc.js"></script>
<script src="../../assets/js/settings.js"></script>
<script src="../../assets/js/todolist.js"></script>
{{-- <script src="../../assets/js/fetchUsers.js"></script> --}}

<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
</body>
</html>