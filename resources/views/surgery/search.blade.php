@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>@lang('search.sarch_doctor')</h2></div>
        <form method="get" action="{{ url('/surgery/search') }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="specialization">@lang('surgery.specialization')</label>
                        <input type="text" id="specialization" class="form-control" name="specialization"
                               value="{{ app('request')->input('specialization') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="city">@lang('surgery.city')</label>
                        <input type="text" id="city" class="form-control" name="city"
                               value="{{ app('request')->input('city') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="name">
                            <nobr>@lang('surgery.doctor_name')</nobr>
                        </label>
                        <input type="text" id="name" class="form-control" name="name"
                               value="{{ app('request')->input('name') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="zone">@lang('surgery.zone')</label>
                        <input type="text" id="zone" class="form-control" name="zone"
                               value="{{ app('request')->input('zone') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="region">@lang('surgery.region')</label>
                        <input type="text" id="region" class="form-control" name="region"
                               value="{{ app('request')->input('region') }}">
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <button class="btn btn-primary btn-lg float-right" type="submit">@lang('search.search')</button>
            </div>
        </form>
        <div class="card-columns">
            @forelse($surgeries as $surgery)
                <div class="card my-3">
                    <a href="{{ url('/surgery', [$surgery->id]) }}">
                        <div class="card-header">{{ $surgery->name }}</div>
                    </a>
                    <div class="card-body">
                        <dl>
                            <dt>@lang('surgery.doctor_name')</dt>
                            <dd>{{ $surgery->properties['doctorName'] }}</dd>
                            <dt>@lang('surgery.address')</dt>
                            <dd>{{ $surgery->address }}</dd>
                            <dt>@lang('surgery.chamber')</dt>
                            <dd>{{ $surgery->doctor->settings->properties['chamber'] }}</dd>
                        </dl>
                    </div>
                </div>
            @empty
                Empty
            @endforelse
        </div>
    </div>
@endsection