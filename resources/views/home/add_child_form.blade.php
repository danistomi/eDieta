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
                    <label for="first-name">First name:</label>
                    <input type="text" class="form-control" name="first_name" id="first-name">
                </div>
                <div class="mb-3">
                    <label for="last-name">Last name:</label>
                    <input type="text" class="form-control" name="last_name" id="last-name">
                </div>
                <div class="form-group">
                    <label for="date-of-birth">Date of birth:</label>
                    <div class="input-group" id="datetimepickerDOF">
                        <input type="text" class="form-control" name="date_of_birth" id="date-of-birth"/>
                        <div class="input-group-addon"><i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <fieldset class="form-group">
                    <legend class="col-form-label">Gender</legend>
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
                </fieldset>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
<div class="">
    <button id="add-child-button" class="float-right btn btn-primary">Add new Child</button>
</div>