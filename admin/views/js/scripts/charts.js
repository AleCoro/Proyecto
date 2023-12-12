var grafica1 = document.querySelector("#grafica1");
if (grafica1 !== null) {

    var datos = $.getJSON("views/js/consultas/consultaGraficas.php?grafica=grafica1", function () {
        console.log("success grafica1");
        console.log(datos);
    }).done(function (datos) {
        var options = {
            series: datos.datos,
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: datos.titulo,
            title: {
                text: 'Roles de los usuarios',
                align: 'left'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var grafica1 = new ApexCharts(document.querySelector("#grafica1"), options);
        grafica1.render();

    })


}

var grafica2 = document.querySelector("#grafica2");
if (grafica2 !== null) {

    var datos = $.getJSON("views/js/consultas/consultaGraficas.php?grafica=grafica2", function () {
        console.log("success grafica2");
        console.log(datos);
    }).done(function (datos) {
        var options = {
            series: datos.datos,
            chart: {
                width: 440,
                type: 'pie',
            },
            labels: datos.titulo,
            title: {
                text: 'Reservas por asignatura',
                align: 'left'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 250
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var grafica2 = new ApexCharts(document.querySelector("#grafica2"), options);
        grafica2.render();

    })


}

var grafica3 = document.querySelector("#grafica3");
if (grafica3 !== null) {

    var datos = $.getJSON("views/js/consultas/consultaGraficas.php?grafica=grafica3", function () {
        console.log("success grafica3");
        console.log(datos);
    }).done(function (datos) {
    console.log("success grafica3");
    var options = {
        series: [{
            name: "Reservas",
            data: datos.datos
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        title: {
            text: 'Reservas realizadas por fecha',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: datos.fechas,
        }
    };

    var grafica3 = new ApexCharts(document.querySelector("#grafica3"), options);
    grafica3.render();

    })


}