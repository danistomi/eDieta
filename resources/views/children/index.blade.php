@extends('layouts.app')

@section('content')
    <div class="conainer">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{ $child->fullName }}</h1></div>
                </div>
            </div>
        </div>
    </div>
@endsection