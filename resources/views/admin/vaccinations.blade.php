@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('vaccination.vaccination_calendar')</h1>
        </div>
        <section>
            <h3>Vaccination list</h3>
            @if(!$vaccinations->isEmpty())
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th style="width: 15%">@lang('vaccination.name')</th>
                            <th style="width: 5%">@lang('vaccination.age')</th>
                            <th style="width: 50%">@lang('vaccination.immunization')</th>
                            <th style="width: 20%">@lang('vaccination.type')</th>
                            <th style="width: 5%">@lang('vaccination.recommended')</th>
                            <th style="width: 5%"></th>
                        </tr>
                        </thead>
                        @foreach($vaccinations as $vaccination)
                            <tr>
                                <td>{{ $vaccination->name }}</td>
                                <td>{{ $vaccination->age }}</td>
                                <td>{{ $vaccination->immunization }}</td>
                                <td>{{ $vaccination->type }}</td>
                                <td>{{ $vaccination->recommended }}</td>
                                <td>
                                    <button class="btn btn-primary mb-1">Edit</button>
                                    <form method="POST" action="/vacc/{{$vaccination->id}}">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                No vaccinations
            @endif
        </section>
        <section class="w-100">
            <h3>Add new vaccination</h3>
            <form method="post" action="{{ url('/vacc') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="v-name">Vaccination name:</label>
                        <input type="text" class="form-control" id="v-name" name="v_name">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="min-age">From</label>
                        <div class="custom-control custom-radio d-inline">
                            <input type="radio" class="custom-control-input" id="min-age-range-m" value="months"
                                   name="min_age_range" checked>
                            <label class="custom-control-label" for="min-age-range-m">Months</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input type="radio" class="custom-control-input" id="min-age-range-a" value="ages"
                                   name="min_age_range">
                            <label class="custom-control-label" for="min-age-range-a">Ages</label>
                        </div>
                        <input type="number" step="0.1" class="form-control" id="min-age" name="min_age">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="max-age">To</label>
                        <div class="custom-control custom-radio d-inline">
                            <input type="radio" class="custom-control-input" id="min-age-range-m" value="months"
                                   name="max_age_range" checked>
                            <label class="custom-control-label" for="max-age-range-m">Months</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input type="radio" class="custom-control-input" id="max-age-range-a" value="ages"
                                   name="max_age_range">
                            <label class="custom-control-label" for="max-age-range-a">Ages</label>
                        </div>
                        <input type="number" step="0.1" class="form-control" id="max-age" name="max_age">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="immunization">Immunization</label>
                        <textarea class="form-control" id="immunization" name="immunization"></textarea>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="type">Type</label>
                        <input type="text" class="form-control" id="type" name="type">
                        <hr class="mb3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="recommended" name="recommended">
                            <label class="custom-control-label" for="recommended">Recommended</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="recurrent" name="recurrent">
                            <label class="custom-control-label" for="recurrent">Recurrent</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
            </form>
        </section>
    </main>
@endsection