@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>{{ $surgery->name }}</h2></div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top" src="{{ asset(Storage::url('blankUser/profile.svg')) }}" alt="profile">
                    <div class="card-body">
                        <h5 class="card-title">{{ $surgery->doctor->full_name }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-9"></div>
        </div>
        {{ $surgery->doctor->workplace }}
    </div>
@endsection