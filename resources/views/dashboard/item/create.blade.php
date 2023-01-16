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
            <h4>Add Item Forms</h4>
            <p class="text-muted">Please <span class="text-danger">fill all</span> input form with right value.</p>
          </div>
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div class="card-body table-categories w-100">
            <form action="{{ route('item.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="name" style="font-size: 15px">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}">
                @error('name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="name" style="font-size: 15px">Category</label>
                <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="divisionPJ">
                  <option selected disabled hidden>Pilih Category</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('category_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <div class="form-group">
                <label for="name" style="font-size: 15px">Total</label>
                <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" id="total" placeholder="Masukan Total">
                @error('total')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="d-flex justify-content-end" style="gap: 10px">
                <a href="{{ route('item.index') }}" class="btn btn-secondary text-dark">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
      </div>
    </div>
</section>
@endsection