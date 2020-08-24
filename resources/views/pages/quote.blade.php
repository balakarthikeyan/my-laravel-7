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
    <div class="quote-container" style="background-image: url('images/banners/{{$quote->background}}')">
		<p class="text">{{$quote->description}}</p>
		<p class="author">— {{$quote->author}}</p>
	</div>
@endsection