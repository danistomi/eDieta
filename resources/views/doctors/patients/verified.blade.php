@extends('doctors.patients')

@section('patients')

    @if($patients->count())
        <table class="table table-striped">
            <tr>
                <th>@lang('user.first_name') @lang('user.last_name')</th>
                <th>@lang('user.email')</th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->fullName }}</td>
                    <td>{{ $patient->email}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-info">@lang('surgery.no_patients')</div>
    @endif
@endsection