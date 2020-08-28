@extends('layouts.default')
@section('content')
    {{-- 
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
    --}}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form action="{{ route('test-form') }}" method="post">
        @csrf  
        <div>
        <label for="test-field">Test Field</label>
            <input type="text" name="test-field" class="form-control @error('test-field') is-invalid @enderror">
            @error('test-field')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <br>
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