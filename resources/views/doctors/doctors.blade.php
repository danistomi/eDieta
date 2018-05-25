@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>@lang('app.my_doctors')</h2></div>

        @if($doctors->count())
            <div class="card-columns">
                @foreach($doctors as $doctor)
                    <div class="card my-3">
                        <a href="{{ url('/surgery', [$doctor->workplace->id]) }}">
                            <div class="card-header">{{ $doctor->workplace->name }}</div>
                        </a>
                        <div class="card-body">
                            <dl>
                                <dt>@lang('surgery.doctor_name')</dt>
                                <dd>{{ $doctor->workplace->properties['doctorName'] }}</dd>
                                <dt>@lang('surgery.address')</dt>
                                <dd>{{ $doctor->workplace->address }}</dd>
                                <dt>@lang('surgery.chamber')</dt>
                                <dd>{{ $doctor->settings->properties['chamber'] }}</dd>
                            </dl>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if($notVerifiedDoctors->count())
            <h5>@lang('surgery.waiting_verification')</h5>
            <div class="card-columns">
                @foreach($notVerifiedDoctors as $doctor)
                    <div class="card my-3">
                        <div class="card-header">{{ $doctor->workplace->name }}</div>
                        <div class="card-body">
                            <dl>
                                <dt>@lang('surgery.doctor_name')</dt>
                                <dd>{{ $doctor->workplace->properties['doctorName'] }}</dd>
                                <dt>@lang('surgery.address')</dt>
                                <dd>{{ $doctor->workplace->address }}</dd>
                                <dt>@lang('surgery.chamber')</dt>
                                <dd>{{ $doctor->settings->properties['chamber'] }}</dd>
                            </dl>
                            <form method="post" action="{{ url('verify_doctor') }}">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                    <label for="code">@lang('surgery.code')</label>
                                    <input type="text" name="code" id="code"
                                           class="form-control{{ session()->has('error') ? ' is-invalid' : '' }}">
                                    @if (session()->has('error'))
                                        <div class="invalid-feedback">{{ session()->get('error') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">@lang('surgery.verify')</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">@lang('surgery.no_doctor')</div>
        @endif
    </div>
@endsection