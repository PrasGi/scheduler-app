@extends('partials.index')
@section('script-head')
    <style>
        #welcome {
            position: absolute;
            top: 45%;
            translate: translateY(-50%);
            left: 45%;
            translate: translateX(-50%);
        }
    </style>
@endsection
@section('content')
    <h5 class="card-title fs-1" id="welcome">Welcome to Scheduler</h5>
@endsection
