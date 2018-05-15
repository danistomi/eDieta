@extends('layouts.app')

@inject('sortedDays', 'App\Components\WeekdaySort')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>{{ $surgery->name }}</h2></div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset(Storage::url('blankUser/profile.svg')) }}" alt="profile">
                    <div class="card-body">
                        <h5 class="card-title">{{ $surgery->properties['doctorName'] === null ? $surgery->doctor->fullName : $surgery->properties['doctorName'] }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <dl>
                    <dt>@lang('surgery.address'):</dt>
                    <dd>{{ $surgery->city }}, {{ $surgery->address }}</dd>
                    <dt>@lang('surgery.zone'):</dt>
                    <dd>{{ $surgery->zone }}</dd>
                    <dt>E-mail:</dt>
                    <dd>{{ $surgery->doctor->email }}</dd>
                </dl>
            </div>
            <div class="col-xl-4">
                <h4>@lang('surgery.ordination_hours')</h4>
                <dl class="row mt-3">
                    @foreach($sortedDays::getSortedDays() as $day)
				        <?php
				        $hour = $surgery->properties['ordinationHours'][ $day ]
				        ?>
                        @if($hour['from'] === null || $hour['from'] == '' || $hour['to'] === null || $hour['to'] == '')
                            @continue
                        @endif
                        <dt class="col-sm-3">@lang('surgery.days.'.$day)</dt>
                        <dd class="col-sm-3">
                            <dl class="row">
                                <dt class="col-sm-4">@lang('surgery.hours.from'):</dt>
                                <dd class="col-sm-8">{{ $hour['from'] }}</dd>
                            </dl>
                        </dd>
                        <dd class="col-sm-6">
                            <dl class="row">
                                <dt class="col-sm-4">@lang('surgery.hours.to'):</dt>
                                <dd class="col-sm-8">{{ $hour['to'] }}</dd>
                            </dl>
                        </dd>
                    @endforeach
                </dl>
            </div>
        </div>
        @if(Auth::user() && Auth::user()->hasrole('doctor'))
            <a href="{{ url('surgery', [$surgery->id, 'edit']) }}">Edit</a>
        @endif
    </div>
@endsection