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
            <h4>Edit Category Form</h4>
            <p class="text-muted">Please <span class="text-danger">fill all</span> input form with right value.</p>
          </div>
          <div class="card-body table-categories w-100">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="name" style="font-size: 15px">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Category Name" value="{{ $category->name }}">
                @error('name')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="divisionPJ"><i class="fas fa-users"></i></label>
                </div>
                <select class="custom-select @error('division_pj') is-invalid @enderror" name="division_pj" id="divisionPJ">
                  <option disabled hidden>Select Division PJ</option>
                  <option value="Sarpas" @if($category->division_pj == 'Sarpas') selected @enderror>Sarpas</option>
                  <option value="Tata Usaha" @if($category->division_pj == 'Tata Usaha') selected @enderror>Tata Usaha</option>
                  <option value="Tefa" @if($category->division_pj == 'Tefa') selected @enderror>Tefa</option>
                </select>
              </div>
              @error('division_pj')
                <div class="text-danger">{{ $message }}</div>
              @enderror
              <div class="d-flex justify-content-end" style="gap: 10px">
                <a href="{{ route('category.index') }}" class="btn btn-secondary text-dark">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
      </div>
    </div>
</section>
@endsection