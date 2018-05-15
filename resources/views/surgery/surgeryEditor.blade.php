@extends('layouts.app')

@inject('sortedDays', 'App\Components\WeekdaySort')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>{{ $surgery->name }}</h2></div>
        <div class="mb-3">
            <div class="col-md-6 offset-md-3">
                <h4 class="mb-3">@lang('surgery.surgery_data')</h4>
                <form method="post" action="{{ url('surgery', ['surgery'=>$surgery->id]) }}">
                    <div class="mb-3">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="mb-3">
                            <label for="name">@lang('surgery.surgery_name')</label>
                            <input type="text" id="name"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ $errors->has('name') ? old('name') : $surgery->name }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="zone">@lang('surgery.zone')</label>
                            <input type="text" id="zone"
                                   class="form-control{{ $errors->has('zone') ? ' is-invalid' : '' }}"
                                   name="zone" value="{{ $errors->has('zone') ? old('zone') : $surgery->zone }}">
                            @if ($errors->has('zone'))
                                <div class="invalid-feedback">{{ $errors->first('zone') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="address">@lang('surgery.address')</label>
                            <input type="text" id="address"
                                   class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                                   value="{{ $errors->has('address') ? old('address') : $surgery->address }}">
                        </div>
                        <div class="row">
                            <div class="col-sm-8 mb-3">
                                <label for="city">@lang('surgery.city')</label>
                                <input type="text" id="city"
                                       class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city"
                                       value="{{ $errors->has('city') ? old('city') : $surgery->city }}">
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label for="zip">@lang('surgery.zip')</label>
                                <input type="text" id="zip"
                                       class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip"
                                       value="{{ $errors->has('zip') ? old('zip') : $surgery->zip }}">
                            </div>
                        </div>
                        @if($errors->has('address') && $errors->has('city') && $errors->has('zip'))
                            <div class="alert alert-danger my-3">@lang('validation.address_exists')</div>
                        @endif
                        <hr class="mb-4">
                        <h4 class="mb-3">@lang('surgery.ordination_hours')</h4>
                        @foreach($sortedDays::getSortedDays() as $day)
							<?php
							$hour = $surgery->properties['ordinationHours'][ $day ]
							?>
                            <h6 class="mt-3">@lang('surgery.days.'.$day)</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="{{ $day.'_from' }}">@lang('surgery.hours.from')</label>
                                    <input type="time" id="{{ $day.'_'.$hour['from'] }}" class="form-control"
                                           name="{{ $day.'_from' }}" value="{{ $hour['from'] }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="{{ $day.'_to' }}">@lang('surgery.hours.to')</label>
                                    <input type="time" id="{{ $day.'_'.$hour['to'] }}" class="form-control"
                                           name="{{ $day.'_to' }}" value="{{ $hour['to'] }}">
                                </div>
                            </div>
                        @endforeach
                        <hr class="mb-4">
                        <h4 class="mb-3">@lang('surgery.doctor_data')</h4>
                        <div class="mb-3">
                            <label for="display_name">@lang('surgery.doctor_display_name')</label>
                            <input type="text" id="display_name"
                                   class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}"
                                   name="display_name"
                                   value="{{ $errors->has('display_name') ? old('display_name') : $surgery->properties['doctorName']===null ? $surgery->doctor->fullName : $surgery->properties['doctorName'] }}">
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">@lang('surgery.send')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()