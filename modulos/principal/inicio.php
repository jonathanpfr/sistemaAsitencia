<?php
@session_start();
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Inicio</title>
        <link rel="stylesheet" href="../../paquetes/bootstrap/css/bootstrap.min.css">

        <script type="text/javascript" src="../../paquetes/js/jquery-1.11.3.js"></script>
        <script src="../../paquetes/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/recordatorio.js"></script>

        <script type="text/javascript">

            function sacarDate() {
                var ahora = new Date();//crea una fecha cogiendola del sistema
                var hora = ahora.getHours(); //acumulando horas, minutos, segundos, dia, mes y año
                var minuto = ahora.getMinutes();
                var segundos = ahora.getSeconds();
                var dia = ahora.getDate();
                var año = ahora.getFullYear();

                var diad = new Array(7);
                diad[0] = "Domingo";
                diad[1] = "Lunes";
                diad[2] = "Martes";
                diad[3] = "Miercoles";
                diad[4] = "Jueves";
                diad[5] = "Viernes";
                diad[6] = "Sabado";

                var mes = new Array(12);
                mes[0] = "Enero";
                mes[1] = "Febrero";
                mes[2] = "Marzo";
                mes[3] = "Abril";
                mes[4] = "Mayo";
                mes[5] = "Junio";
                mes[6] = "Julio";
                mes[7] = "Agosto";
                mes[8] = "Septiembre";
                mes[9] = "Octubre";
                mes[10] = "Noviembre";
                mes[11] = "Diciembre";

                if (hora < 10) {
                    hora = "0" + hora;
                }
                if (minuto < 10) {
                    minuto = "0" + minuto;
                }

                var mostrarReloj = hora + ":" + minuto + ":" + segundos;
                var mostrarFecha = diad[ahora.getDay()] + "," + ' ' + dia + ' ' + "de" + ' ' + mes[ahora.getMonth()];
                var mostrarAño = año;

                document.tiempo.reloj.value = mostrarReloj;
                document.tiempo.fecha.value = mostrarFecha;
                document.tiempo.año.value = mostrarAño;

                setTimeout("sacarDate()", 1000);


            }
            function modal() {
                $('#myModalEliminar').modal('show');
            }
        </script>

        <style>
            .tiempo{
                margin-top: 20px;
            }

            .tiempo .time{
                color:rgb(0, 45, 86);
                font-weight: 800;
                font-size: 28px;
                border:0;
                background: none;
                font-family:century gothic;

            }

            .tiempo .fecha{
                color:rgb(0, 45, 86);
                font-weight: 800;
                font-size: 18px;
                border:0;
                background: none;
                font-family:century gothic;
            }

            .tiempo .año{
                color:rgb(0, 45, 86);
                font-weight: 800;
                font-size: 18px;
                border:0;
                background: none;
                font-family:century gothic;
            }
        </style>

        <style>
            html{
                height: 100%;
                width: 100%;
                margin:0;
            }

            body{
                height: 100%;
                width: 100%;
                margin:0;
            }

            .valign-wrapper {
                display: -webkit-box;
                display: -moz-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-flex-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }

            .valign-wrapper .valign {
                display: block;
            }
        </style>
    </head>
    <body class="valign-wrapper" onLoad="sacarDate()">
        <div class="valign container">
            <h3>BIENVENIDO AL SISTEMA DE CONTROL DE ASISTENCIA ,&nbsp;<?php echo $_SESSION['username']; ?> </h3>
            <br><br>
            <img src="../../paquetes/img/logos/logo_inicio.jpg" width="500" height="300" alt="logo"  class="img-responsive center-block"><!-- CAMBIAR EL LOGO -->
            <br>
            <div class="pull-right">
                <form name="tiempo" class="tiempo">
                    <input class="time pull-right" type="button" name="reloj"><br>
                    <input class="fecha" type="button" name="fecha"><br>
                    <input class="año pull-right" type="button" name="año">
                </form>

            </div>
        </div>
        <div id="myModalEliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="text-center">
                            BIENVENIDO AL SISTEMA DE LA EMPRESA  "ELECTROCLIMA" S.A. , LE BRINDAMOS 
                            UN MANUAL PARA QUE PUEDA ACCEDER A SUS ACTIVIDADES
                            SIN NINGUNA DIFICULTAD
                        </div>
                        <h4 align="center"> ¿Desea Descargar el Manual?</h4>
                        <div class="text-center">
                            <button type="button" class="btn btn-success btn-sm" id="btn_manual"><span class="glyphicon glyphicon-ok"></span>Sí</button>
                            <button type="button" data-dismiss="modal" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span>No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!--ModalEliminar--> 


    </body>
</html>