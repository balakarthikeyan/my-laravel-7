@extends('layouts.default')
@section('content')

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