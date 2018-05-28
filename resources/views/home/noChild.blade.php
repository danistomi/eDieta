@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <section>
            <div class="py-5 text-left"><h2>@lang('app.new_child')</h2></div>
            <div class="row">
                <div class="col-md-6 mx-auto text-center">
                    @if(Config::get('app.locale') == 'sk')
                        <p>Zatiaľ nemáte pridané žiadne dieťa, pridajte prvé.</p>
                    @endif
                    @include('home.add_child_form')
                </div>
            </div>
        </section>
    </div>
@endsection