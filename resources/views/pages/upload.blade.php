@extends('pages.layout') 

@section('title', 'Ajax Image Upload Example')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@push('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ URL::asset('scripts/theme.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-md-6 offset-3 mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Laravel 7 Image Upload - NiceSnippets.com</h4>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                {{-- action="{{ route('image.store') }}" method="post" --}}
                <form  enctype="multipart/form-data" id="imageUpload">
                    @csrf
                    <div class="form-group">
                        <label><strong>Image : </strong></label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-success" name="submit" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-script')
<script type="text/javascript">
    $('#imageUpload').on('submit',(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ route('image.ajax.store')}}",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {
                if($.isEmptyObject(data.error)){
                    alert(data.success);
                } else {
                    alert(data.error);
                }
            },               

        });
    }));
</script>
@endsection