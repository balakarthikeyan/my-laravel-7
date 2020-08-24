@extends('products.layout') 

@section('title', ' :: Add New Product')

@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ URL::asset('scripts/theme.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}">Back</a>
        </div>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br /><br />
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- <form action="{{ route('products.store') }}" method="post"> --}}
<form id="post-form" method="post" action="javascript:void(0)">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Name"
                />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea
                    class="form-control"
                    style="height:150px"
                    name="detail"
                    placeholder="Detail"
                ></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $("input[name='_token']").val(),
        },
    });

    $(".btn-submit").click(function (e) {
        e.preventDefault();
        var name = $("input[name=name]").val();
        var detail = $("textarea[name=detail]").val();
        var _token = $("input[name='_token']").val();
        $.ajax({
            type: "POST",
            url: "{{ route('ajax.products') }}",
            data: { _token:_token, name: name, detail: detail },
            success: function (data) {
                if($.isEmptyObject(data.error)){
                    alert(data.success);
                } else {
                    alert(data.error);
                }
            },
        });
    });
</script>
@endsection
