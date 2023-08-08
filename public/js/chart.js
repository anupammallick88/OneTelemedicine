(function() {
    "user strict";

    //Dynamic variables
    let jsvar = document.getElementById('js_variable_data');
    let ds = jsvar.getAttribute('data-jsvar');
    let avar = JSON.parse(ds);

    //Line chart
    $(document).ready(function () {
        new Chartist.Line('#lineChart_area', {
            labels: avar.earningYear.split(","),
            series: [
                avar.earningArraytoString.split(","),
            ]
        }, {
            low: 0,
            showArea: true
        });
    });
})()
