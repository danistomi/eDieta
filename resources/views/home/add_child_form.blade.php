<div id="add-child-form" style="display: none">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Add new child</h4>
        </div>
        <div class="panel-body">
        </div>
    </div>
    <div class="bootstrap-iso">
        <div class="container-fluid">
            <form method="post" action="{{ url('/children') }}">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="first-name">@lang('user.first_name')</label>
                    <input type="text" class="form-control" name="first_name" id="first-name" required>
                </div>
                <div class="mb-3">
                    <label for="last-name">@lang('user.last_name')</label>
                    <input type="text" class="form-control" name="last_name" id="last-name" required>
                </div>
                <div class="form-group">
                    <label for="date-of-birth">@lang('user.date_of_birth')</label>
                    <div class="input-group" id="datetimepickerDOF">
                        <input type="text" class="form-control" name="date_of_birth" id="date-of-birth" required>
                        <div class="input-group-addon"><i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <fieldset class="form-group">
                    <legend class="col-form-label">@lang('user.gender')</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check text-center">
                                <input class="form-check-input" type="radio" name="gender"
                                       id="male" value="male">
                                <label class="form-check-label" for="male">
                                    @lang('user.male')
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check text-center">
                                <input class="form-check-input" type="radio" name="gender"
                                       id="female" value="female">
                                <label class="form-check-label" for="female">
                                    @lang('user.female')
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary btn-block">@lang('app.save')</button>
            </form>
        </div>
    </div>
</div>
<div class="">
    <button id="add-child-button" class="btn btn-primary btn-block">Nové dieťa</button>
</div>