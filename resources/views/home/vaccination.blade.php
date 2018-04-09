@extends('home.home')

@section('section')
    {{--<div class="panel-body">--}}
    {{--@forelse($vaccinations as $vaccination)--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">--}}
    {{--{{ $vaccination->vacation_type }}--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
    {{--<b>Date:</b> {{ $vaccination->date_of_vacation }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@empty--}}
    {{--No Vacations.--}}
    {{--@endforelse--}}
    {{--</div>--}}
    <div class="panel-body mt-3">
        <div class="panel panel-default">
            <table class="table table-striped table-responsive-lg">
                <thead>
                <tr>
                    <th>Meno</th>
                    <th>Vek</th>
                    <th>Typ</th>
                    <th>Povinné</th>
                </tr>
                </thead>
                <tr class="table-success">
                    <td>Prvá</td>
                    <td>3</td>
                    <td>1. dávka (základné očkovanie)</td>
                    <td>áno</td>
                </tr>
                <tr class="table-danger">
                    <td>Druhá</td>
                    <td>5</td>
                    <td>2. dávka (základné očkovanie)</td>
                    <td>áno</td>
                </tr>
                <tr class="table-warning">
                    <td>Tretia</td>
                    <td>11</td>
                    <td>3. dávka (základné očkovanie)</td>
                    <td>áno</td>
                </tr>
                <tr class="">
                    <td>Štvrtá</td>
                    <td>15-18</td>
                    <td>základné očkovanie</td>
                    <td>áno</td>
                </tr>
            </table>
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