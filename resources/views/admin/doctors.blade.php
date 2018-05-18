@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('admin.doctors')</h1>
        </div>
        @if(!$unverifiedSurgeries->isEmpty())
            <section>
                <h3>Surgeries - avaiting verification</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                        <tr>
                            <th>@lang('surgery.doctor_name')</th>
                            <th>@lang('surgery.surgery_name')</th>
                            <th>@lang('surgery.address')</th>
                            <th>@lang('surgery.chamber')</th>
                            <th>@lang('surgery.reg_num')</th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($unverifiedSurgeries as $surgery )
                            <tr>
                                <td>{{ $surgery->doctor->fullName}}</td>
                                <td>{{ $surgery->name }}</td>
                                <td>{{ $surgery->city }} {{ $surgery->address }} - {{ $surgery->zip }}</td>
                                <td>{{ $surgery->doctor->settings->properties['chamber'] }}</td>
                                <td>{{ $surgery->doctor->settings->properties['reg_num'] }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="POST" action="{{ url('verify_surgery/'.$surgery->id) }}">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary btn-block">Verify</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form method="POST" action="{{ url('surgery/'.$surgery->id) }}">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger btn-block">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </section>
        @endif
        @if(!$surgeries->isEmpty())
            <section>
                <h3>Surgeries</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                        <tr>
                            <th>@lang('surgery.doctor_name')</th>
                            <th>@lang('surgery.surgery_name')</th>
                            <th>@lang('surgery.address')</th>
                            <th>@lang('surgery.zip')</th>
                            <th>@lang('surgery.city')</th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($surgeries as $surgery )
                            <tr>
                                <td>{{ $surgery->doctor->fullName}}</td>
                                <td>{{ $surgery->name }}</td>
                                <td> {{ $surgery->city }} {{ $surgery->address }} - {{ $surgery->zip }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form method="POST" action="{{ url('surgery/'.$surgery->id) }}">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger btn-block">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </section>
        @endif
        <section>
            <h3>Doctors</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Header</th>
                        <th>Header</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->fullName }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->fullName }}</td>
                            <td>{{ $doctor->fullName }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection