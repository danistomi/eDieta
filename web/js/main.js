$(document).ready(function () {
    var date_input = $('input[name="date_of_birth"]');
    if (date_input.length !== 0) {
        var options = {
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            viewMode: 'years'
        };
        date_input.datepicker(options);
    }

    $("#add-child-button").click(function () {
        $("#add-child-form").show();
        $(this).hide();
    });

    var bmiChart = document.getElementById("bmiChart");
    //console.log(bmiData);
    if (bmiChart != null) {
        var labels = [];
        var chartData = [];
        for (var i = 0; i < bmiData.length; i++) {
            labels.push(bmiData[i]['age']);
            chartData.push(bmiData[i]['bmi']);
        }
        var data = {
            labels: labels,
            datasets: [{
                data: chartData,
                // lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#00b000',
                // borderWidth: 4,
                // pointBackgroundColor: '#007bff'
            }]
        };
        var opt = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            }
        };
        var myChart = new Chart(bmiChart, {
            type: 'line',
            data: data,
            options: opt
        });
    }

});

function showVaccinationForm(element, vaccId) {
    var token = window.Laravel.csrfToken;
    $.ajax({
        type: 'POST',
        url: '/getVaccinationForm',
        data: {
            _token: token,
            vaccId: vaccId
        },
        success: function (data) {
            if (data.success) {
                var tr = $(element).parent();
                var td = $(document.createElement('td'));
                td.attr('colspan', 6);
                td.html(data.html);
                tr.html(td);
            }

        }
    })
}

function toggleMonthsAges(element) {
    element = $(element);
    var input = element.parent().siblings('input');
    var radio = element.siblings('input');
    if (!radio.is(':checked')) {
        if (radio.val() === 'months') {
            input.val(input.val() * 12)
        }
        if (radio.val() === 'ages') {
            input.val(input.val() / 12)
        }
    }
}
