@extends('pages.layout') 

@section('title', 'Motivaitonal — Your daily source of motivation!')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@push('styles')
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" type="text/css" />
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Alegreya:400,700|Roboto+Condensed' type='text/css'>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ URL::asset('scripts/theme.js') }}"></script>
@endpush

@section('content')
    <div class="col-sm-8">
    @if (count($images) > 0)
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ $image['src'] }}">
                        <div class="carousel-caption">
                            <form action="{{ url('images/' . $image['name']) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-default">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @else
            <p>Nothing found</p>
        @endif
    </div>
    <div class="col-sm-4">
        <div class="card border-0 text-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif        
            <form action="{{ url('/test-fileupload') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>    
@endsection