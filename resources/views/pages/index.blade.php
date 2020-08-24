@extends('layouts.default')
@section('content')
    {{--
    @foreach ($sessions as $session)
    <div>
        <span>{{ $session->user->name }}</span> at <span>{{ $session->created_at }}</span>
    </div>
    @endforeach
    --}}
    @component('components.alert')
        @slot('class')
            alert-success
        @endslot
        @slot('title')
            Success Message
        @endslot
        <h3>Welcome To Laravel</h3>
    @endcomponent

    <x-panel title="Welcome Panel!!!" class="shadow-lg">
        <h3>Welcome To Laravel</h3>
    </x-panel>

    <x-alert title="Welcome Alert!!!" class="alert-danger" message="Welcome To Laravel" />

@endsection