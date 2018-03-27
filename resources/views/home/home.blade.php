@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="py-5 text-left"><h2>@lang('app.dashboard')</h2></div>
        <div class="row">
            <div class="col-md-3">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    My Children
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
                            <nobr><span class="text-muted">Age {{ $child->age }}</span></nobr>
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
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{action('HomeController@vaccination', [$selectedChild->id])}}">Vacation</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{action('HomeController@bmi', [$selectedChild->id])}}">Bmi</a>
                    </div>
                </div>
                @yield('section')
            </div>

        </div>
    </div>
@endsection
