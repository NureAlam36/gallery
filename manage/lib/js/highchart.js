function formatDate(date) {
    var dd = date.getDate();
    var mm = date.getMonth() + 1;
    var yyyy = date.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    date = mm + '/' + dd + '/' + yyyy;
    return date
}

function getDayName(dateStr, locale) {
    var date = new Date(dateStr);
    return date.toLocaleDateString(locale, {
        weekday: 'long'
    });
}

function Last7Days() {
    var result = [];
    for (var i = 0; i < 7; i++) {
        var d = new Date();
        d.setDate(d.getDate() - i);
        var dateStr = formatDate(d);
        var day = result.push(getDayName(dateStr).substring(0, 3));
    }

    return result.reverse();
}

console.log(Last7Days())

Highcharts.chart('container', {

    title: {
        text: 'Daily Visitors Statistics'
    },

    subtitle: {
        text: 'Hits in the last 7 days'
    },

    yAxis: {
        title: {
            text: 'Visits / Visitors'
        }
    },

    xAxis: {
        categories: Last7Days()
    },

    series: [{
        name: 'Daily Visits',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133]
    }, {
        name: 'Daily Visitors',
        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});