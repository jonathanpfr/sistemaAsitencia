<!DOCTYPE html>
<?php
$s_faltas=$_GET["s_faltas"];
$todos_asistencia=$_GET["total_asistencias"];
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
                            text: 'Porcentaje de Faltas'
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
                                        name: 'Total Faltas', y: <?php echo $s_faltas;?>, sliced: true, selected: true
                                    },
                                    {
                                        name: 'Otros', y: <?php echo $todos_asistencia;?>
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
