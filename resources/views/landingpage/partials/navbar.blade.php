<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>SMK Wikrama<span>.</span></h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('landingpage.index') }}" class="active">Home</a></li>
          @if(auth()->check())
          <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
          <li><button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary">Logout</button></li>
          @else
          <li><button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-primary">Login</button></li>
          @endif
        </ul>
      </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->

{{-- Modal Login --}}
  
  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-4" id="exampleModalLabel">Login</h1>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="modal-body">
                <p class="text-center text-danger fw-bold">{{ session('loginError') }}</p>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                    <script type="text/javascript">
                        $(window).on('load', function() {
                          $('#loginModal').modal('show');
                        });
                    </script>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    @error('password')
                    <p class="text-danger fw-bold">{{ $message }}</p>
                    <script type="text/javascript">
                        $(window).on('load', function() {
                          $('#loginModal').modal('show');
                        });
                    </script>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  @if(session('loginError'))
      <script type="text/javascript">
        $(window).on('load', function() {
          $('#loginModal').modal('show');
        });
      </script>
  @endif