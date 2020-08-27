@extends('layouts.default')
@section('content')

    @ishome
        <p>Welcome to Homepage</p>
    @endishome

    @subscribed
        <p>Hurry limited seats available!!</p>
    @unsubscribed
        <p>Bummer! Looks like you need a subscription to access this video.</p>
    @endsubscribed

    @env('local')
        <p>The application is in the local environment</p>
    @elseenv('testing')
        <p>The application is in the testing environment</p>
    @else
        <p>The application is not in the local or testing environment</p>
    @endenv

    <form method="post" action="test-form">
        @csrf  
        <div><label for="test-field">Test Field</label>
        <input type="text" name="test-field"></div><br>
        <div><button type="submit">Submit </button></div>
    </form>

    @if(Session::get('my_session'))
        @foreach (Session::get('my_session') as $key => $value)
        <div>
            <span>{{ $key }}</span> : <span>{{ $value }}</span>
        </div>
        @endforeach
    @endif 

@endsection