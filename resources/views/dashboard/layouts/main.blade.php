<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-00R8F6D0PD"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-00R8F6D0PD');
  </script>
  <title>Dashboard Admin</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
  <!-- CSS Libraries -->
  {{-- <link rel="stylesheet" href="../../node_modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="../../node_modules/summernote/dist/summernote-bs4.css"> --}}
  <link rel="stylesheet" type="text/css" href="{{ url('assets/admin/dataTables/css/datatables-bootstrap.min.css') }}"/>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('/assets/dashboard/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/dashboard/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/dashboard/css/progres.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/dashboard/css/card.css') }}">

  <link href="" rel='shortcut icon'>

  <style>
    .navbar-bg {
        background-image: url("{{ asset('/assets/dashboard/img/bg2.png') }}");
    }

    
    @media (max-width: 442px){
      .navbar-left h5 {
        font-size: 1rem;
      }
      .navbar-right h5 {
        font-size: 1rem;
      }
      .table-categories {
        overflow: scroll;
      }
    }
  </style>

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3 navbar-left">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <h5 class="text-dark rounded p-2" style="background-color: rgb(255, 255, 255)">Selamat Datang {{ ucfirst(auth()->user()->role) }} Wikrama</h5>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
            <h5 class="text-dark rounded p-2" style="background-color: rgb(255, 255, 255)">{{ today()->translatedFormat('d F, Y') }}</h5>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <ul class="sidebar-menu">
              <li class="menu-header mt-3 ml-3 text-light">Menu</li>
              <li class="nav-item dropdown">
                <a href="{{ route('dashboard.index') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header mt-3 ml-3 text-light">Items Data</li>
              @if(auth()->user()->role == 'admin')
              <li class="nav-item dropdown">
                <a href="{{ route('category.index') }}"><i class="fas fa-bars"></i> <span>Categories</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{ route('item.index') }}"><i class="fas fa-file"></i> <span>Items</span></a>
              </li>
              <li class="menu-header mt-3 ml-3 text-light">Accounts</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('dashboard.accounts.admin') }}">o Admin</a></li>
                  <li><a class="nav-link" href="{{ route('dashboard.accounts.operator') }}">o Operator</a></li>
                </ul>
              </li>
              @elseif(auth()->user()->role == 'operator')
              <li class="nav-item dropdown">
                <a href="{{ route('dashboard.operator.item.index') }}"><i class="fas fa-window-restore"></i> <span>Items</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="{{ route('dashboard.operator.lending.index') }}"><i class="fas fa-spinner"></i> <span>Lending</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('dashboard.accounts.editOperator') }}">o Edit</a></li>
                </ul>
              </li>
              @endif
            </ul>
        </aside>
      </div>

      <div class="main-content">
        <section class="content">
          @yield('content')
        </section>
      </div>
      </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{ date('Y') }} <div class="bullet"><a>PPLG SMK Wikrama Bogor | M. Yazid Akbar</a></div>
        </div>
      </footer>
    </div>
  </div>

  @stack('scripts')

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  {{-- <script src="{{ url('assets/dashboard/js/stisla.js')}}"></script> --}}

  <!-- JS Libraies -->
  {{-- <script src="{{ url('assets/dashboard/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script> --}}
  {{-- <script src="{{ url('assets/dashboard/node_modules/chart.js/dist/Chart.min.js')}}"></script> --}}
  {{-- <script src="{{ url('assets/dashboard/node_modules/owl.carousel/dist/owl.carousel.min.js')}}"></script> --}}
  {{-- <script src="{{ url('assets/dashboard/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
  <script src="{{ url('assets/dashboard/node_modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Template JS File -->
  <script src="{{ url('assets/dashboard/js/scripts.js')}}"></script>
  <script src="{{ url('assets/dashboard/js/custom.js')}}"></script>
  <script src="{{ url('assets/dashboard/js/newCustom.js')}}"></script>

</body>
</html>
