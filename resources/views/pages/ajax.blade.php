@extends('pages.layout') 

@section('title', 'Ajax Request Example')

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
    <h1>Ajax example</h1>
    <form id="post-form" method="post" action="javascript:void(0)">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input
                type="text"
                name="name"
                class="form-control"
                placeholder="Name"
                required=""
            />
        </div>
        <div class="form-group">
            <label>Detail:</label>
            <input
                type="text"
                name="detail"
                class="form-control"
                placeholder="Detail"
                required=""
            />
        </div>
        <div class="form-group">
            <label>Category:</label>
            <select name="category" id="category" class="form-control">
                <option value="0">-- Select Cateory --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Sub Category:</label>
            <select name="sub_category" id="sub_category" class="form-control"></select>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </form>
@endsection

@section('extra-script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $(".btn-submit").click(function (e) {
            e.preventDefault();
            var name = $("input[name=name]").val();
            var detail = $("input[name=detail]").val();
            var _token = $("input[name='_token']").val();
            $.ajax({
                type: "POST",
                url: "{{ route('ajax.post') }}",
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

        $('#category').on('change',function(e) {                 
            var category_id = e.target.value;
            if(category_id>0) {
                $.ajax({
                    url:"{{ url('categories') }}/"+category_id,
                    type:"POST",
                    data: {
                        id: category_id
                    },                      
                    success:function (data) {
                        if(data) {
                            $('#sub_category').empty();
                            $('#sub_category').append('<option value="0">-- Select Sub Category --</option>');
                            $.each(data, function(index, subcategory) {   
                                console.log("data : ", index, subcategory);                      
                                $('#sub_category').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                            });
                        } else {
                            $('#sub_category').empty();
                        }
                    }
                });
            }

        });
    </script>
@endsection