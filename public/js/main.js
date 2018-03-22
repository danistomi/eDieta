$(document).ready(function () {
    var date_input = $('input[name="date_of_birth"]');
    var options = {
        format: 'yyyy-dd-mm',
        todayHighlight: true,
        viewMode: 'years'
    };
    date_input.datepicker(options);

    $("#add-child-button").click(function () {
        $("#add-child-form").show();
        $(this).hide();
    })
});