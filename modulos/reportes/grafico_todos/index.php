<!DOCTYPE html>
<?php
$t_asistencias=$_GET["t_asistencias"];
$t_faltas=$_GET["t_faltas"];
$t_tardanzas=$_GET["t_tardanzas"];
$t_sin_marcar=$_GET["t_sin_marcar"];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Stock Actual</title>

        <script type="text/javascript" src="jquery.min.js"></script>
        <style type="text/css">

        </style>
        <script type="text/javascript">

            $(function () {
                $(document).ready(function () {
                    // Build the chart
                    $('#container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Porcentajes Totales'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        series: [{
                                name: 'Total',
                                colorByPoint: true,
                                data: [
                                     {
                                        name: 'Total Asistencias', y: <?php echo $t_asistencias;?>, sliced: true, selected: true
                                    },
                                    {
                                        name: 'Total Faltas', y: <?php echo $t_faltas;?>
                                    },
                                              {
                                        name: 'Total Tardanzas', y: <?php echo $t_tardanzas;?>
                                    },
                                    {
                                        name: 'Total sin Marcar', y: <?php echo $t_sin_marcar;?>
                                    },
                                ]
                            }]
                    });
                });
            });
        </script>
    </head>
    <body>
        <script src="highcharts.js"></script>
        <script src="exporting.js"></script>

        <div id="container" style="min-width: 200px; height: 350px; max-width: 500px; margin: 0 auto"></div>

    </body>
</html>
