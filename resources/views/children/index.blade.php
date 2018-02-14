@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>{{ $child->fullName }}</h1></div>

                    <div class="panel-body">
                        @forelse($vacations as $vacation)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ $vacation->vacation_type }}
                                </div>
                                <div class="panel-body">
                                    <b>Date:</b> {{ $vacation->date_of_vacation }}
                                </div>
                            </div>
                        @empty
                            No Vacations.
                        @endforelse
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>Add new vacation</strong>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="{{ url('/vacation') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="vacation-type">Vacation type:</label>
                                        <input type="text" name="vacation_type" id="vacation-type">
                                    </div>
                                    <input type="hidden" name="child_id" id="child_id"
                                           value="{{ $child->id }}">
                                    <div class="form-group">
                                        <label for="date-of-vacation">Date of vacation:</label>
                                        <input type="date" name="date_of_vacation" id="date-of-vacation"
                                               value="<?php print( date( "Y-m-d" ) ); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
