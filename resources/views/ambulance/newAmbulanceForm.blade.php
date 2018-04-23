@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-5 text-left"><h2>@lang('surgery.new_surgery')</h2></div>
        <div class="mb-3">
            <div class="col-md-6 offset-md-3">
                @if(session()->has('message'))
                    <div class="alert alert-success mt-3 mb-3">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger mt-3 mb-3">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form method="post" action="{{ url('create_ambulance') }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="name">@lang('surgery.ambulance_name')</label>
                        <input type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="address">@lang('surgery.address')</label>
                        <input type="text" id="address"
                               class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                               value="{{ old('address') }}">
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="city">@lang('surgery.city')</label>
                            <input type="text" id="city"
                                   class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city"
                                   value="{{ old('city') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="zip">@lang('surgery.zip')</label>
                            <input type="text" id="zip"
                                   class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip"
                                   value="{{ old('zip') }}">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">@lang('surgery.send')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
