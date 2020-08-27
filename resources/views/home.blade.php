@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @role('developer')
                        Hello developer, <br/>
                    @endrole

                    {{ __('You are logged in!') }}

                    @can('create')
                        <br/>Hello You can Create the post.
                    @endcan

                    @can('edit')
                        <br/>Hello You can Edit the post.
                    @endif 

                    @can('view')
                        <br/>Hello You can View the post.
                    @endcan

                    @can('delete')
                        <br/>Hello You can Delete the post.
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
