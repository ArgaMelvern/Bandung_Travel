<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/global_admin.css')}}">
    @yield('assets_css')
  </head>
  <body style="min-height:100vh">
    <header class="topbar">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- <div class="container">
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img
                    src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
                    class="rounded-circle"
                    height="22"
                    alt="Black and White Portrait of a Man"
                    loading="lazy"
                  />
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="{{route('actionLogout')}}">Logout</a></li>
                </ul>
              </li>
            </ul>

        </div> -->
        </div>
      </nav>
      </header>


    <img src="{{asset('img/bg/Group 38.png')}}" alt="" style="position:absolute;right:0;z-index:-1">
    <div id="mySidebar" class="sidebar">
      <a class="text-center p-0" style="margin-bottom:50px;margin-top: 30px;border:none;"><h1 style="color:#edf1f5">LOGO</h1></a>
      <ul style="padding-left:0px">
        <li><a href=" {{route('admin.dashboard')}}" class="{{ (request()->is('admin')) ? 'active' : '' }}"><i class="bi bi-house"></i>&nbsp;&nbsp;&nbsp;Dashboard</a></li>
        <li><a href=" {{route('admin.destination')}}" class="{{ (request()->is('admin/destination*')) ? 'active' : '' }}"><i class="bi bi-geo-alt"></i>&nbsp;&nbsp;&nbsp;Destination</a></li>
        <li><a href=" {{route('admin.destinationtype')}}" class="{{ (request()->is('admin/type*')) ? 'active' : '' }}"><i class="bi bi-map"></i>&nbsp;&nbsp;&nbsp;Destination Type</a></li>
      </ul>
      <button class="logout-btn"><a href="{{route('actionLogout')}}">Logout&nbsp;&nbsp;&nbsp;<i class="bi bi-door-closed"></i></a></button>
    </div>

    <div id="main">
      <button class="sidebar-toggle" onclick="closeNav()" id="sidebar-btn">&#9776;</button>
      <div class="main-container">
        @yield('content')
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/global_admin.js')}}" charset="utf-8"></script>
    @yield('assets_js')
  </body>
</html>
