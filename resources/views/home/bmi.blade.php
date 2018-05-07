@extends('home.home')

@section('section')
    <div class=" col-md-12 mt-3">
        <h3>@lang('bmi.bmi')</h3>
        <canvas id="bmiChart" class="my-3" width="900" height="380"></canvas>
        <h4 class="my-3">Pridaj</h4>
        <form method="post" action="{{ url('/bmi') }}">
            <div class="row mt-3">
                {{ csrf_field() }}
                <input type="hidden" name="child" value="{{ $selectedChild->id }}">
                <div class="col-md-6 mb-3">
                    <label for="height">@lang('bmi.height')</label>
                    <input type="number" name="height" id="height"
                           class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('height'))
                        <div class="invalid-feedback">{{ $errors->first('height') }}</div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="weight">@lang('bmi.weight')</label>
                    <input type="number" name="weight" id="weight"
                           class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('weight'))
                        <div class="invalid-feedback">{{ $errors->first('weight') }}</div>
                    @endif
                </div>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Save</button>
                </div>
            </div>
        </form>


        @if(!$bmis->isEmpty())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>@lang('bmi.weight')</th>
                        <th>@lang('bmi.height')</th>
                        <th>@lang('bmi.bmi')</th>
                        <th>@lang('base.date')</th>
                    </tr>
                    </thead>
                    @foreach($bmis as $bmi)
                        <tr class="table">
                            {{--{{ dd($bmi->child) }}--}}
                            <td>{{ $bmi->weight }}</td>
                            <td>{{ $bmi->height }}</td>
                            <td>{{ $bmi->bmi }}</td>
                            <td>{{ @date($bmi->created_at) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $bmis->links() }}
        @endif
    </div>
@endsection