@extends('home.home')

@section('section')
    <div class="panel-body mt-3">
        @if($vaccinations)
            <table class="table table-striped table-responsive-lg">
                <thead>
                <tr>
                    <th>@lang('vaccination.name')</th>
                    <th>@lang('vaccination.age')</th>
                    <th>@lang('vaccination.type')</th>
                    <th>@lang('vaccination.recommended')</th>
                    <th></th>
                </tr>
                </thead>
                @foreach($vaccinations as $vaccination)
                    <tr class="table-{{ $vaccination->getStatus($selectedChild) }}">
                        <td>{{ $vaccination->name }}</td>
                        <td>{{ $vaccination->age }}</td>
                        <td>{{ $vaccination->type }}</td>
                        <td>{{ $vaccination->recommended }}</td>
                        <td>
                            <form method="POST" action="/childrenVacc">
                                {{ csrf_field() }}
                                <input type="hidden" name="child_id" value="{{ $selectedChild->id }}">
                                <input type="hidden" name="vaccination_id" value="{{ $vaccination->id }}">
                                <button class="btn btn-primary">Ok</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            No Vaccinations.
        @endif
    </div>
    <div class="panel-body mt-3">
        <div class="panel panel-default">

            {{--<div class="panel-heading">--}}
            {{--<strong>Add new vacation</strong>--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
            {{--<form method="post" action="{{ url('/vaccination') }}">--}}
            {{--{{ csrf_field() }}--}}
            {{--<div class="form-group">--}}
            {{--<label for="vaccination-type">Vacation type:</label>--}}
            {{--<input type="text" name="vaccination_type" id="vaccination-type">--}}
            {{--</div>--}}
            {{--<input type="hidden" name="child_id" id="child_id"--}}
            {{--value="{{ $selectedChild->id }}">--}}
            {{--<div class="form-group">--}}
            {{--<label for="date-of-vaccination">Date of vacation:</label>--}}
            {{--<input type="date" name="date_of_vaccination" id="date-of-vaccination"--}}
            {{--value="--}}<?php //print( date( "Y-m-d" ) ); ?>{{--">--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn btn-primary">Send</button>--}}
            {{--</form>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection