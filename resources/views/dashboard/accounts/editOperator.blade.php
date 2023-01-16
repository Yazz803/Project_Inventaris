@extends('dashboard.layouts.main')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Check menu in sidebar</h1>
        <div class="section-header-breadcrumb">
            <ul style="list-style-type: none">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex justify-content-center align-items-center">
                <img alt="image" src="{{ asset('assets/dashboard/img/avatar/avatar-1.png') }}" width="30" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi {{ auth()->user()->name }}</div></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                  </a>
                </div>
              </li>
            </ul>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
          <div class="card-header justify-content-between align-items-center">
            <h4>Edit Account Form</h4>
            <p class="text-muted">Please <span class="text-danger">fill all</span> input form with right value.</p>
          </div>
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show mx-3  " role="alert">
            {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div class="card-body table-categories w-100">
            <form action="{{ route('dashboard.accounts.update', auth()->user()->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="name" style="font-size: 15px">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ auth()->user()->name }}">
                @error('name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="email" style="font-size: 15px">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ auth()->user()->email }}">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="password" style="font-size: 15px">New Password <span class="text-warning">optional</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                @error('password')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-flex justify-content-end" style="gap: 10px">
                <a href="{{ route('dashboard.accounts.' . auth()->user()->role) }}" class="btn btn-secondary text-dark">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
      </div>
    </div>
</section>
@endsection