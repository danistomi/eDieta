@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>{{ $surgery->name }}</h2></div>
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset(Storage::url('blankUser/profile.svg')) }}" alt="profile">
                <a href="{{ asset('sorage/asd.txt') }}">sdfs</a>
                {{ asset('storage/asd.txt') }}
            </div>
            <div class="col-md-9"></div>
        </div>
        {{ $surgery->doctor->workplace }}
    </div>
@endsection