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
            <h4>Lending Table</h4>
            {{-- <p>Data of <span class="text-danger">lendings</span></p> --}}
            <a href="{{ route('item.index') }}" class="btn btn-secondary text-dark">Back</a>
          </div>
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show mx-3  " role="alert">
            {!! session('success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div class="card-body table-categories">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Total</th>
                        <th scope="col">Name</th>
                        <th scope="col">Ket.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Returned</th>
                        <th scope="col">Edited By</th>
                    </tr>
                </thead>
                @foreach($item->lendings as $lending)
                <tbody>
                  <tr>
                    <th scope="row">{{ $lending->id }}</th>
                    <td>{{ $lending->item->name }}</td>
                    <td>{{ $lending->total }}</td>
                    <td>{{ $lending->name }}</td>
                    <td>{{ $lending->keterangan }}</td>
                    <td>{{ $lending->created_at->translatedFormat('d F, Y') }}</td>
                    @if($lending->returned != NULL)
                    <td>
                        <button class="btn btn-outline-success">{{ $lending->updated_at->translatedFormat('d F, Y') }}</button>
                    </td>
                    @else
                    <td>
                        <button class="btn btn-outline-warning">Not Returned</button>
                    </td>
                    @endif
                    <td>{{ $lending->edited_by }}</td>
                  </tr>
                </tbody>
                @endforeach
              </table>
          </div>
      </div>
    </div>
</section>

@endsection