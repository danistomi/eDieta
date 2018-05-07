@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('admin.bmis')</h1>
        </div>
        <section>
            <form method="post" action="{{ url('/defaultBmiUpload') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="bmiFile"> File </label>
                            <input type="file"
                                   class="form-control-file{{ $errors->has('bmiFile') ? ' is-invalid' : '' }}"
                                   id="bmiFile" name="bmiFile" required>
                            @if ($errors->has('bmiFile'))
                                <div class="invalid-feedback">{{ $errors->first('bmiFile') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
            @if($files)
                <div class="table-responsive-lg my-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Uploaded</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach($files as $file)
                            <tr>
                                <th>{{ Carbon\Carbon::parse($file->created_at)->toDateString() }}</th>
                                <td>{{ $file->file_name }}</td>
                                <td>{{ $file->gender }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <form method="post" action="{{ url('/defaultBmiStore/'.$file->id) }}">
                                                {{ csrf_field() }}
                                                <button class="btn btn-primary btn-block">Store</button>
                                            </form>
                                        </div>
                                        <div class="col-sm-6">
                                            <form method="post" action="{{ url('/defaultBmi/'.$file->id) }}">
                                                {{ csrf_field() }}
                                                {{method_field('DELETE')}}
                                                <button class="btn btn-danger btn-block">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                {{--<th>{{ Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->toDateString() }}</th>--}}
                                {{--<td>{{ basename($file) }}</td>--}}
                                {{--<td>@if(strpos( Storage::url($file), 'female') !== false)--}}
                                {{--@lang('user.felame')--}}
                                {{--@elseif(strpos( Storage::url($file), 'male') !== false)--}}
                                {{--@lang('user.male')--}}
                                {{--@else--}}
                                {{--Undefiened--}}
                                {{--@endif--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--{{ Storage::url($file) }}--}}

                                {{--</td>--}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </section>
    </main>

@endsection