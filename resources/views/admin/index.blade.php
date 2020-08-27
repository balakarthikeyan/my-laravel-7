@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <h1>Welcome To Admin Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <a href="admin/logout">Logout</a>
        </div>
    </div>
</div>
@endsection