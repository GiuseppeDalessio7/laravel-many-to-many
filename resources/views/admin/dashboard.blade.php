@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>

        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header"><span class="text-danger">{{ Auth::user()->name }}</span>{{ __(' Dashboard') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Hi <span class="text-danger">{{ Auth::user()->name }}</span> {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
