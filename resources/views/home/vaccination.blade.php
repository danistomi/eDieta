@extends('home.home')

@section('section')
	<?php function printAge( $arr ) {
	?>
    {{ trans_choice('user.age.'.$arr[1],floor($arr[0]), ['age'=>$arr[0]]) }}
	<?php
	} ?>
    <div class=" col-md-12 mt-3">
        <h3>@lang('vaccination.vaccination_calendar')</h3>
        @if($vaccinations)
            <table class="table table-striped table-responsive-lg">
                <thead>
                <tr>
                    <th>@lang('vaccination.name')</th>
                    <th>@lang('vaccination.age')</th>
                    <th>@lang('vaccination.type')</th>
                    <th>@lang('vaccination.recommended')</th>
                    <th></th>
                </tr>
                </thead>
                @foreach($vaccinations as $vaccination)
		            <?php $vaccStatus = $vaccination->getStatus( $selectedChild ) ?>
                    <tr class="table-{{ $vaccStatus }}">
                        <td>{{ $vaccination->name }}</td>
                        <td>
                            @if(is_array($vaccination->age[0]))
                                @lang('user.age.age') {{ printAge($vaccination->age[0])}}
                                - {{ printAge($vaccination->age[1]) }}
                            @else
                                @lang('user.age.age') {{ printAge($vaccination->age) }}
                            @endif
                        </td>
                        <td>{{ $vaccination->type }}</td>
                        <td>{{ $vaccination->recommended }}</td>
                        <td>
                            <form method="POST" action="{{ url('/childrenVacc') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="child_id" value="{{ $selectedChild->id }}">
                                <input type="hidden" name="vaccination_id" value="{{ $vaccination->id }}">
                                <button class="btn btn-primary">@if($vaccStatus == 'success') @lang('vaccination.remove') @else @lang('vaccination.add') @endif</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            No Vaccinations.
        @endif
    </div>
@endsection