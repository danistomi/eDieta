var CHILDBMICOLOR = '#0040ff';
var DEFAULTBMICOLOR = {
    'sd3neg': '#EB6100',
    'sd2neg': '#F39800',
    'sd1neg': '#FFF100',
    'sd0': '#22AC38',
    'sd1': '#FFF100',
    'sd2': '#F39800',
    'sd3': '#EB6100'
};


function getContentWidth(element) {
    var styles = getComputedStyle(element)

    return element.clientWidth
        - parseFloat(styles.paddingLeft)
        - parseFloat(styles.paddingRight)
}

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
    if (bmiChart != null) {
        var chart = new BmiChart(bmiChart);
        chart.loadChildBmiData(bmiData);
        chart.loadDefaultBmiData(defaultBmiData);
        chart.draw()
    }

});

function Bmi(age, bmi) {
    this.age = age;
    this.bmi = bmi;

}


function BmiChart(canvas) {
    this.childBmis = [];
    this.defaultBmis = {'sd3neg': [], 'sd2neg': [], 'sd1neg': [], 'sd0': [], 'sd1': [], 'sd2': [], 'sd3': []};
    this.minBmi = Infinity;
    this.maxBmi = 0;
    this.minAge = Infinity;
    this.maxAge = 0;
    this.canvas = canvas;
    this.padding = 30
}

BmiChart.prototype.loadChildBmiData = function (bmiData) {
    for (var i = 0; i < bmiData.length; i++) {
        if (bmiData[i].bmi > this.maxBmi) this.maxBmi = bmiData[i].bmi
        if (bmiData[i].bmi < this.minBmi) this.minBmi = bmiData[i].bmi
        if (bmiData[i].age > this.maxAge) this.maxAge = bmiData[i].age
        if (bmiData[i].age < this.minAge) this.minAge = bmiData[i].age
        this.childBmis.push(new Bmi(bmiData[i].age, bmiData[i].bmi))
    }
}

BmiChart.prototype.loadDefaultBmiData = function (bmiData) {
    for (var i = 0; i < bmiData.length; i++) {
        if (bmiData[i].age < this.minAge) continue;
        if (bmiData[i].bmi > this.maxBmi) this.maxBmi = bmiData[i].bmi
        if (bmiData[i].bmi < this.minBmi) this.minBmi = bmiData[i].bmi
        this.defaultBmis[bmiData[i].percentile].push(new Bmi(bmiData[i].age, bmiData[i].bmi))
    }
    console.log(this.defaultBmis);
}

BmiChart.prototype.draw = function () {
    var canvas = document.getElementById("bmiChart");
    var ctx = canvas.getContext("2d");
    canvas.width = parseInt(getContentWidth(canvas.parentNode));
    canvas.height = canvas.width / 2;


    ctx.fillText("BMI", 0, 10);
    ctx.fillText("mesiace", canvas.width - 40, canvas.height - 3);

    var self = this;
    drawHorizontalLines();
    drawVerticalLines();

    for (var key in this.defaultBmis) {
        for (var i = 0; i < this.defaultBmis[key].length; i++) {
            var j = i > 0 ? i - 1 : 0;
            if (this.defaultBmis[key][j].age >= this.maxAge) continue;
            drawDBmiChart(this.defaultBmis[key][j], this.defaultBmis[key][i], DEFAULTBMICOLOR[key], false);
        }
    }

    for (var i = 0; i < this.childBmis.length; i++) {
        var j = i > 0 ? i - 1 : 0
        drawDBmiChart(this.childBmis[j], this.childBmis[i], CHILDBMICOLOR, true);
    }


    function drawDBmiChart(prevBmi, bmi, color, drawCircle) {
        if (drawCircle) {
            ctx.lineWidth = 4;
            ctx.beginPath();
            ctx.arc(x(bmi), y(bmi), 5, 0, 2 * Math.PI);
            ctx.fillStyle = color;
            ctx.fill();
        }

        ctx.beginPath();
        ctx.moveTo(x(prevBmi), y(prevBmi));
        ctx.lineTo(x(bmi), y(bmi));
        ctx.strokeStyle = color;
        ctx.stroke();

        function x(bmi) {
            var minmax = Math.ceil(self.maxAge) - Math.floor(self.minAge);
            var one = (canvas.width - self.padding * 2) / minmax;
            var dx = self.minAge - Math.floor(self.minAge);

            return self.padding + one * (bmi.age - self.minAge + dx);
        }

        function y(bmi) {
            var minmax = Math.ceil(self.maxBmi) - Math.floor(self.minBmi);
            var one = (canvas.height - self.padding * 2) / minmax;
            var dy = self.minBmi - Math.floor(self.minBmi);

            return canvas.height - self.padding - one * (bmi.bmi - self.minBmi + dy);
        }
    }

    function drawHorizontalLines() {
        var fromX = self.padding;
        var toX = self.canvas.width - self.padding;

        var minmax = Math.ceil(self.maxBmi) - Math.floor(self.minBmi);
        var one = (canvas.height - self.padding * 2) / minmax;

        for (var i = 0; i <= minmax; i++) {
            var y = canvas.height - self.padding - one * i;
            ctx.beginPath()
            ctx.moveTo(fromX, y);
            ctx.lineTo(toX, y);
            ctx.stroke();

            ctx.fillText(Math.floor(self.minBmi) + i, 0, y);
        }
    }

    function drawVerticalLines() {
        var fromY = self.padding;
        var toY = self.canvas.height - self.padding;

        var minmax = Math.ceil(self.maxAge) - Math.floor(self.minAge);
        var w = (self.canvas.width - self.padding * 2) / minmax;

        for (var i = 0; i <= minmax; i++) {
            var x = self.padding + w * i;
            ctx.beginPath();
            ctx.lineWidth = (canvas.width > 700) ? ctx.lineWidth = 3 : ctx.lineWidth = 1
            ctx.moveTo(x, fromY);
            ctx.lineTo(x, toY);
            ctx.stroke();

            ctx.fillText(Math.floor(self.minAge) + i, x, canvas.height - self.padding + 10)

            if (canvas.width < 700) continue;
            if (i + 1 > minmax) continue;
            ctx.lineWidth = 0.5
            for (var j = 1; j < 4; j++) {
                x += w / 4;
                ctx.moveTo(x, fromY);
                ctx.lineTo(x, toY);
                ctx.stroke();
            }
        }
    }
}

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

function toggleVacc(element) {
    var x = element.parentNode.childNodes[3].childNodes[3];

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
