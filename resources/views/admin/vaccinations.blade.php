@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Vaccinations</h1>
        </div>
        <div class="row">
            <section>
                <h3>Vaccination list</h3>
                @if(!$vaccinations->isEmpty())
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th style="width: 15%">Name</th>
                                <th style="width: 10%">Age</th>
                                <th style="width: 50%">Immunization</th>
                                <th style="width: 20%">Type</th>
                                <th style="width: 5%">Recommended</th>
                                <th></th>
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
        </div>
        <div class="row">
            <section class="w-100">
                <h3>Add new vaccination</h3>
                <form method="post" action="/vacc">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="v-name">Vaccination name:</label>
                            <input type="text" class="form-control" id="v-name" name="v_name">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="min-month">From (month)</label>
                            <input type="number" class="form-control" id="min-month" name="min_month">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="max-month">To (month)</label>
                            <input type="number" class="form-control" id="max-month" name="max_month">
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
        </div>
    </main>
@endsection