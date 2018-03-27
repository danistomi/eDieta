@extends('home.home')

@section('section')
    <div class="panel-body">
        @forelse($vaccinations as $vaccination)
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $vaccination->vacation_type }}
                </div>
                <div class="panel-body">
                    <b>Date:</b> {{ $vaccination->date_of_vacation }}
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
                <form method="post" action="{{ url('/vaccination') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="vaccination-type">Vacation type:</label>
                        <input type="text" name="vaccination_type" id="vaccination-type">
                    </div>
                    <input type="hidden" name="child_id" id="child_id"
                           value="{{ $selectedChild->id }}">
                    <div class="form-group">
                        <label for="date-of-vaccination">Date of vacation:</label>
                        <input type="date" name="date_of_vaccination" id="date-of-vaccination"
                               value="<?php print( date( "Y-m-d" ) ); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection