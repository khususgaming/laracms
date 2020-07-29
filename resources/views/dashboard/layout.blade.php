@php $_title = 'Dashboard' @endphp
@extends('layouts.app')
@section('content')
    @if (Auth::user()->roles >= 0 AND Auth::user()->roles <= 1)
        <div class="container">
            @yield('content')
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="alert alert-danger" role="alert">
                        Invalid akses `roles` pada database!
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection