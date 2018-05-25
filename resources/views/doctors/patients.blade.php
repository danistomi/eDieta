@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="pt-5 text-left"><h2>@lang('app.my_patients')</h2></div>
        <ul class="nav justify-content-center my-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('patients') }}">@lang('surgery.verified_patients')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('patients/awaiting') }}">@lang('surgery.awaiting_patients')</a>
            </li>
        </ul>

        @yield('patients')

    </div>
@endsection