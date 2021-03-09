//Flot Pie Chart
$(document).ready(function() {

    var data = [{
        label: "Painel",
        data: 1
    }, {
        label: "Comunicação",
        data: 3
    }, {
        label: "Simpósio",
        data: 9
    }, {
        label: "Ouvinte",
        data: 20
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});

//Flot Pie Chart
$(document).ready(function() {

    var data = [{
        label: "Painel",
        data: 1
    }, {
        label: "Comunicação",
        data: 3
    }, {
        label: "Simpósio",
        data: 9
    }, {
        label: "Ouvinte",
        data: 20
    }];

    var plotObj = $.plot($("#flot-pie-chart2"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});