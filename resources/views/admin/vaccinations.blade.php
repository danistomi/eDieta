@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('vaccination.vaccination_calendar')</h1>
        </div>
        <section>
            <h3>Zoznam očkovaní</h3>
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
                                <td>
                                </td>
                                <td>{{ $vaccination->immunization }}</td>
                                <td>{{ $vaccination->type }}</td>
                                <td>@if($vaccination->recommended) Áno @else Nie @endif</td>
                                <td>
                                    <button class="btn btn-primary mb-1"
                                            onclick="showVaccinationForm(this.parentNode, {{ $vaccination->id }})">
                                        Upraviť
                                    </button>
                                    <form method="POST" action="/vacc/{{$vaccination->id}}">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger">Zmazať</button>
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
            <h3>Pridaj nové očkovanie</h3>
            @include('admin.new_vaccination_form')
        </section>
    </main>
@endsection