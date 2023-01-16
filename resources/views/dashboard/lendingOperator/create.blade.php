@extends('dashboard.layouts.main')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
            <h4>Add Lending Forms</h4>
            <p class="text-muted">Please <span class="text-danger">fill all</span> input form with right value.</p>
          </div>
          @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {!! session('error') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <form action="{{ route('dashboard.operator.lending.store') }}" method="POST">
            <div class="card-body table-categories w-100" id="dynamicForm">
              @csrf
              <div class="border border-dark p-3 rounded mb-3">
                <div class="form-group">
                    <label for="name" style="font-size: 15px">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="addmore[0][name]" id="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name" style="font-size: 15px">Items</label>
                    <select class="custom-select @error('item_id') is-invalid @enderror" name="addmore[0][item_id]" id="divisionPJ">
                    <option selected disabled hidden>Select Items</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}" @selected(old('item_id') == $item->id)>{{ $item->name }}</option>
                    @endforeach
                    </select>
                </div>
                @error('item_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="name" style="font-size: 15px">Total</label>
                    <input type="number" class="form-control @error('total') is-invalid @enderror" name="addmore[0][total]" id="total" placeholder="Masukan Total">
                    @error('total')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan" style="font-size: 15px">Keterangan</label>
                    <textarea class="form-control" name="addmore[0][keterangan]" id="keterangan" rows="3" cols="10"></textarea>
                </div>
                <input type="hidden" name="addmore[0][edited_by]" value="{{ auth()->user()->name }}">
              </div>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-dark font-weight-bold" id="add">More <i class="fas fa-arrow-down"></i></button>
                <div class="d-flex justify-content-end" style="gap: 10px">
                  <a href="{{ route('item.index') }}" class="btn btn-secondary text-dark">Back</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </div>
        </form>
      </div>
    </div>
</section>

<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicForm").append(`
        <div class="remove-div border border-dark p-3 rounded mb-3">
            <div class="form-group">
                    <label for="name" style="font-size: 15px">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="addmore[${i}][name]" id="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name" style="font-size: 15px">Items</label>
                    <select class="custom-select @error('item_id') is-invalid @enderror" name="addmore[${i}][item_id]" id="divisionPJ">
                    <option selected disabled hidden>Select Items</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}" @selected(old('item_id') == $item->id)>{{ $item->name }}</option>
                    @endforeach
                    </select>
                </div>
                @error('item_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="name" style="font-size: 15px">Total</label>
                    <input type="number" class="form-control @error('total') is-invalid @enderror" name="addmore[${i}][total]" id="total" placeholder="Masukan Total">
                    @error('total')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan" style="font-size: 15px">Keterangan</label>
                    <textarea class="form-control" name="addmore[${i}][keterangan]" id="keterangan" rows="3" cols="10"></textarea>
                </div>
                <input type="hidden" name="addmore[${i}][edited_by]" value="{{ auth()->user()->name }}">
                <button type="button" class="btn btn-outline-danger remove-tr">Cancel</button>
        </div>
        `);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('.remove-div').remove();
    });  
   
</script>
@endsection