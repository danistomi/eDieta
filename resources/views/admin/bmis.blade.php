@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">@lang('admin.bmis')</h1>
        </div>
        <section>
            <form method="post" action="{{ url('/uploadBmiData') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class="custom-file">
                    <input type="file" id="file" class="custom-file-input" name="bmiData">
                    <span class="custom-file-control"></span>
                </label>
                <button type="submit">Save</button>
                <label class="custom-file">
                    <input type="file" id="file" class="custom-file-input">
                    <span class="custom-file-control"></span>
                </label>
            </form>
            @if($files)

                @foreach($files as $file)
                    {{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->toDateTimeString() }}
                @endforeach
            @endif
        </section>
    </main>

@endsection