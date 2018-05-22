@extends('home.home')

@section('section')
	<?php function printAge( $arr ) {
	?>
    {{ trans_choice('user.age.'.$arr[1],floor($arr[0]), ['age'=>$arr[0]]) }}
	<?php
	} ?>
    <div class=" col-md-12 mt-3">
        <h3>@lang('vaccination.vaccination_calendar')</h3>
        @forelse($vaccinations as $vaccination)
		    <?php $vaccStatus = $vaccination->getStatus( $selectedChild ) ?>
            <div class="card mb-3 card-hhi-{{ $vaccStatus }}">
                <div class="card-header" onclick="toggleVacc(this)">
                    {{ $vaccination->name }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @if(is_array($vaccination->age[0]))
                                @lang('user.age.age') {{ printAge($vaccination->age[0])}}
                                - {{ printAge($vaccination->age[1]) }}
                            @else
                                @lang('user.age.age') {{ printAge($vaccination->age) }}
                            @endif
                        </div>
                        <div class="col-md-6">{{ $vaccination->type }}</div>
                        <div class="col-md-3 text-center">
                            <form method="POST" action="{{ url('/childrenVacc') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="child_id" value="{{ $selectedChild->id }}">
                                <input type="hidden" name="vaccination_id" value="{{ $vaccination->id }}">
                                <button class="btn btn-primary">@if($vaccStatus == 'success') @lang('vaccination.remove') @else @lang('vaccination.add') @endif</button>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3 mx-3" style="display: none;">
                        <div class="md-12">
                            {{ $vaccination->immunization }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert-warning">@lang('vaccination.no_vacc')</div>
        @endforelse
    </div>
@endsection