@extends('doctors.patients')

@section('patients')

    @if($patients->count())
        <table class="table table-striped">
            <tr>
                <th>@lang('user.first_name') @lang('user.last_name')</th>
                <th>@lang('user.email')</th>
                <th>@lang('surgery.code')</th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->fullName }}</td>
                    <td>{{ $patient->email}}</td>
                    <td>{{ $patient->pivot->verify_code}}</td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-success">@lang('surgery.no_awaiting_patients')</div>
    @endif
@endsection