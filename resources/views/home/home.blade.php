@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="py-5 text-left"><h2>@lang('app.dashboard')</h2></div>
        <div class="row">
            <div class="col-md-3">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    Moje deti
                </h4>
                <ul class="list-group mb-3">
                    @forelse($children as $child)

                        <li class="list-group-item, d-flex justify-content-between children-list-group-item
                                @if($selectedChild->id == $child->id)
                                children-list-group-item-selected
                                @endif ">
                            <div>
                                <a href="{{action('HomeController@'.$section, [$child->id])}}">
                                    <h6>{{ $child->fullName }}</h6></a>
                                <nobr>
                                    <small>{{ $child->date_of_birth }}</small>
                                </nobr>
                            </div>
                            <nobr>
                                <span class="text-muted"> @if($child->age[1] === 'months')
                                        @lang('user.age.months', ['age'=>$child->age[0]])
                                    @else
                                        @lang('user.age.years', ['age'=>$child->age[0]])
                                    @endif </span>
                            </nobr>
                        </li>
                    @empty
                        valami
                    @endforelse
                </ul>
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('home.add_child_form')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row home-nav">
                    <div class="col-md-6 home-nav-item<?php /** @var string $section */
                    if ( $section == 'vaccination' )
	                    echo "-selected" ?>">
                        <a class="home-nav-item-a<?php if ( $section == 'vaccination' )
	                        echo "-selected" ?>"
                           href="{{action('HomeController@vaccination', [$selectedChild->id])}}">@lang('vaccination.vaccinations')</a>
                    </div>
                    <div class="col-md-6 home-nav-item<?php if ( $section == 'bmi' )
	                    echo "-selected" ?>">
                        <a class="home-nav-item-a<?php if ( $section == 'bmi' )
	                        echo "-selected" ?>"
                           href="{{action('HomeController@bmi', [$selectedChild->id])}}">@lang('bmi.bmi')</a>
                    </div>
                </div>
                @yield('section')
            </div>

        </div>
    </div>
@endsection
