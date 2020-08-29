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
            <a class="btn btn-success" id="create-new-product" href="javascript:void(0);{{-- route('products.create') --}}">Create New Product</a>
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
            <th>Id</th>
            <th>S. No</th>
            <th>Name</th>
            <th>Details</th>
            <th>Created on</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="productCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="productForm" name="productForm" class="form-horizontal" method="post" action="javascript:void(0)">
           <input type="hidden" name="product_id" id="product_id">
           @csrf
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name" value="" maxlength="50" required="">
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="detail" name="detail" placeholder="Enter Description" value="" required="">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
            </div>
        </form>
    </div>
    <div class="modal-footer"></div>
</div>
</div>
</div>  
<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("input[name='_token']").val(),
            },
        });        
        $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ajax.products.list') }}",
                type: 'GET',
            },
            columns: [
                    { data: 'id', name: 'id', 'visible': false },
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false  },
                    { data: 'name', name: 'name' },
                    { data: 'detail', name: 'detail' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false},
                 ],
            order: [[0, 'desc']]
        });

        $('#create-new-product').click(function () {
            $('#btn-save').val("create-product");
            $('#product_id').val(0);
            $('#productForm').trigger("reset");
            $('#productCrudModal').html("Add Product");
            $('#ajax-product-modal').modal('show');
        });

        $("#btn-save").click(function (e) {
            e.preventDefault();
            var product_id = $("input[name=product_id]").val();
            var name = $("input[name=name]").val();
            var detail = $("input[name=detail]").val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: "{{ route('ajax.products.store') }}",
                data: { _token:_token, product_id: product_id, name: name, detail: detail },
                success: function (data) {
                    if($.isEmptyObject(data.error)){
                        console.log(data.success);
                        $('#productForm').trigger("reset");
                        $('#ajax-product-modal').modal('hide');
                        var oTable = $('#laravel_datatable').dataTable();
                        oTable.fnDraw(false);                        
                    } else {
                        console.log(data.error);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        /* Edit */
        $('body').on('click', '.edit-product', function (e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            $.get( "product-list/edit/" + product_id , function (data) {
                $('#productCrudModal').html("Edit Product");
                $('#ajax-product-modal').modal('show');
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#detail').val(data.detail);
            })
        });

        /* Delete */
        $('body').on('click', '.delete-product', function (e) { 
            e.preventDefault(); 
            var product_id = $(this).data("id");            
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "GET",
                    url: "product-list/delete/" + product_id,
                    success: function (data) {
                        console.log(data.success);
                        var oTable = $('#laravel_datatable').dataTable(); 
                        oTable.fnDraw(false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

    });
  </script>
@endsection