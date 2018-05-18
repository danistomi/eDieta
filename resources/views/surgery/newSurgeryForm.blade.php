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
                <form method="post" action="{{ url('surgery') }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="name">@lang('surgery.surgery_name')</label>
                        <input type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="region">@lang('surgery.region')</label>
                        <input type="text" id="region"
                               class="form-control{{ $errors->has('region') ? ' is-invalid' : '' }}"
                               name="region" value="{{ old('region') }}">
                        @if ($errors->has('region'))
                            <div class="invalid-feedback">{{ $errors->first('region') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="zone">@lang('surgery.zone')</label>
                        <input type="text" id="zone" class="form-control{{ $errors->has('zone') ? ' is-invalid' : '' }}"
                               name="zone" value="{{ old('zone') }}">
                        @if ($errors->has('zone'))
                            <div class="invalid-feedback">{{ $errors->first('zone') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="address">@lang('surgery.address')</label>
                        <input type="text" id="address"
                               class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                               value="{{ old('address') }}">
                    </div>
                    <div class="row">
                        <div class="col-sm-8 mb-3">
                            <label for="city">@lang('surgery.city')</label>
                            <input type="text" id="city"
                                   class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city"
                                   value="{{ old('city') }}">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="zip">@lang('surgery.zip')</label>
                            <input type="text" id="zip"
                                   class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip"
                                   value="{{ old('zip') }}">
                        </div>
                    </div>
                    {{--TODO uzeet, ha egyezo a cim--}}
                    @if($errors->has('address') && $errors->has('city') && $errors->has('zip'))
                        <div class="alert alert-danger my-3">@lang('validation.address_exists')</div>
                    @endif
                    <div class="mb-3">
                        <label for="chamber">@lang('surgery.chamber')</label>
                        <input type="text" id="chamber"
                               class="form-control{{ $errors->has('chamber') ? ' is-invalid' : '' }}" name="chamber"
                               value="{{ old('chamber') }}">
                        @if ($errors->has('chamber'))
                            <div class="invalid-feedback">{{ $errors->first('chamber') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="reg_num">@lang('surgery.reg_num')</label>
                        <input type="text" id="reg_num"
                               class="form-control{{ $errors->has('reg_num') ? ' is-invalid' : '' }}" name="reg_num"
                               value="{{ old('reg_num') }}">
                        @if ($errors->has('reg_num'))
                            <div class="invalid-feedback">{{ $errors->first('reg_num') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="specialization">@lang('surgery.specialization')</label>
                        <input type="text" id="specialization"
                               class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}"
                               name="specialization"
                               value="{{ old('specialization') }}">
                        @if ($errors->has('specialization'))
                            <div class="invalid-feedback">{{ $errors->first('specialization') }}</div>
                        @endif
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">@lang('surgery.send')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
