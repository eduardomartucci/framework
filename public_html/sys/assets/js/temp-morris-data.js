$(function() {

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Gradua��o",
            value: 60
        }, {
            label: "P�s-gradua��o",
            value: 30
        }, {
            label: "Outros",
            value: 10
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2012',
            a: 50,
            b: 40,
            c: 60
        }, {
            y: '2013',
            a: 75,
            b: 65,
            c: 60
        }, {
            y: '2014',
            a: 50,
            b: 40,
            c: 60
        }, {
            y: '2015',
            a: 75,
            b: 65,
            c: 60
        }, {
            y: '2016',
            a: 100,
            b: 90,
            c: 60
        }],
        xkey: 'y',
        ykeys: ['a', 'b','c'],
        labels: ['Gradua��o', 'P�s-gradua��o','Outros'],
        hideHover: 'auto',
        resize: true
    });
    
});
