@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Moje deti</h1></div>

                    <div class="panel-body">


                        @foreach($children as $child)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="{{ url('/children').'/'.$child->id }}"> {{ $child->fullName }}</a>
                                </div>
                                <div class="panel-body">
                                    <b>Date of birht:</b> {{ $child->date_of_birth }} <br>
                                    <b>Gender:</b> {{ $child->gender }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>Add new child</strong>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="{{ url('/children') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="first-name">First name:</label>
                                        <input type="text" name="first_name" id="first-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name">Last name:</label>
                                        <input type="text" name="last_name" id="last-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="date-of-birth">Date of birth:</label>
                                        <input type="date" name="date_of_birth" id="date-of-birth">
                                    </div>
                                    <fieldset class="form-group">
                                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="male" value="male">
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                       id="female" value="female">
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
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
