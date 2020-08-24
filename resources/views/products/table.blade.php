@extends('products.layout') 

@push('styles')
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>CRUD Example</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('products.create') }}">Create New Product</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered" id="laravel_datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Created on</th>
        </tr>
    </thead>
</table>
  
<script>
    $(document).ready( function () {
        $('#laravel_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('productslist') }}",
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'detail', name: 'detail' },
                    { data: 'created_at', name: 'created_at' }
                 ]
        });
    });
  </script>
@endsection