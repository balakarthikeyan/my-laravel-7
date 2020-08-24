@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form id="sign_in_adm" method="POST" action="{{ route('admin.login.submit') }}">
                {{ csrf_field() }}
                <div class="form-group row">
                    <input type=email name=email placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                </div>
                @if ($errors->has('email'))
                    <span ><strong>{{ $errors->first('email') }}</strong></span>
                @endif
                <br>
                <div class="form-group row">
                    <input type=password name=password placeholder="Password" required>
                </div>
                <br>
                <div class="form-group row">
                    <button type=submit >SIGN IN</button>
                </div>
            </form>
        </div>
    </div>
</div>            
@endsection