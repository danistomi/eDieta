<form method="post"
      action="@if(isset($ajaxVaccination)) {{ url('/vacc'.'/'.$ajaxVaccination->id) }} @else {{ url('/vacc') }} @endif">
    {{ csrf_field() }}
    @if(isset($ajaxVaccination))
        {{ method_field('put') }}
    @endif
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="v-name">Vaccination name:</label>
            <input type="text" class="form-control" id="v-name" name="v_name" value="{{$ajaxVaccination->name or ''}}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="min-age">From</label>
            <div class="custom-control custom-radio d-inline">
                <input type="radio" class="custom-control-input" id="min-age-range-m" value="months"
                       name="min_age_range" checked>
                <label class="custom-control-label" for="min-age-range-m"
                       onclick="toggleMonthsAges(this)">Months</label>
            </div>
            <div class="custom-control custom-radio d-inline">
                <input type="radio" class="custom-control-input" id="min-age-range-a" value="ages"
                       name="min_age_range">
                <label class="custom-control-label" for="min-age-range-a" onclick="toggleMonthsAges(this)">Ages</label>
            </div>
            <input type="number" step="0.1" class="form-control" id="min-age" name="min_age"
                   value="{{$ajaxVaccination->recommended_min_age or ''}}">
        </div>
        <div class="col-lg-3 mb-3">
            <label for="max-age">To</label>
            <div class="custom-control custom-radio d-inline">
                <input type="radio" class="custom-control-input" id="max-age-range-m" value="months"
                       name="max_age_range" checked>
                <label class="custom-control-label" for="max-age-range-m"
                       onclick="toggleMonthsAges(this)">Months</label>
            </div>
            <div class="custom-control custom-radio d-inline">
                <input type="radio" class="custom-control-input" id="max-age-range-a" value="ages"
                       name="max_age_range">
                <label class="custom-control-label" for="max-age-range-a" onclick="toggleMonthsAges(this)">Ages</label>
            </div>
            <input type="number" step="0.1" class="form-control" id="max-age" name="max_age"
                   value="{{$ajaxVaccination->recommended_max_age or ''}}">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3">
            <label for="immunization">Immunization</label>
            <textarea class="form-control" id="immunization"
                      name="immunization">{{$ajaxVaccination->immunization or ''}}</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{$ajaxVaccination->type or ''}}">
            <hr class="mb3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="recommended"
                       name="recommended" <?php if ( ! empty( $ajaxVaccination->recommended ) )
					echo 'checked'?>>
                <label class="custom-control-label" for="recommended">Recommended</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="recurrent"
                       name="recurrent"<?php if ( ! empty( $ajaxVaccination->recurrent ) )
					echo 'checked'?>>
                <label class="custom-control-label" for="recurrent">Recurrent</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block"
            name="submit">@if(isset($ajaxVaccination)) @lang('app.update') @else @lang('app.save') @endif</button>
</form>