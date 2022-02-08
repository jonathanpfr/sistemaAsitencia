<?php
@session_start();
$id_usuario_sesion = $_SESSION["id_user"];
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");
require_once '../../clases/usuario/class_usuario.php';
require_once '../../clases/asistencia/class_asistencia.php';
require_once '../../clases/permiso/class_permiso.php';
require_once '../../clases/conexion.php';
$clase_u = new usuario();
$regaw = $clase_u->seleccion_usuario($id_usuario_sesion);

$dni_usuario = $regaw[0]["dni"];
$nombre_usuario = $regaw[0]["nombre"];
$apellido_usuario = $regaw[0]["apellidos"]; //nombre_cargo
$nombre_cargo_usuario = $regaw[0]["nombre_cargo"];
$nombre_perfil_usuario = $regaw[0]["nombre_perfil"]; //nombre_perfil

$fecha_inicio_contrato = $regaw[0]["fecha_inicio_contrato"];
$fecha_termino_contrato = $regaw[0]["fecha_termino_contrato"];

$clase_h = new asistencia();
$reg = $clase_h->buscar_horario($id_usuario_sesion);
$id_dias=$reg[0]["id_dias"];
$hora_entrada = $reg[0]["hora_entrada"];
$hora_salida = $reg[0]["hora_salida"];

$hora_re_entrada = $reg[0]["hora_re_entrada"];
$hora_re_salida = $reg[0]["hora_re_salida"];

$array_hora_salida = split(":", $hora_salida);
$minutos_salida = ($array_hora_salida[0] * 60) + $array_hora_salida[1];


$array_hora_re_salida = split(":", $hora_re_salida);
$minutos_re_salida = ($array_hora_re_salida[0] * 60) + $array_hora_re_salida[1];

$id_tipo_contrato = $reg[0]["id_tipo_contrato"]; //1 tiempo completo, 2 medio tiempo
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="../../paquetes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../paquetes/css/style.css">
        <link rel="stylesheet" type="text/css" href="../../paquetes/autocomplete/jquery.autocomplete.css" />
        <link rel="stylesheet" href="../../paquetes/autocomplete/jquery-ui.css"/>
        <script type="text/javascript" src="../../paquetes/js/jquery-1.11.3.js"></script>
        <script src="../../paquetes/bootstrap/js/bootstrap.min.js"></script>
        <script language="javascript" type="text/javascript" src="../../paquetes/autocomplete/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../../paquetes/autocomplete/jquery.min.js"></script>
        <script type="text/javascript" src="../../paquetes/autocomplete/jquery-ui.min.js"></script>
        <script src="../../paquetes/autocomplete/jquery-ui.js"></script>
        <script src="../../paquetes/autocomplete/jquery.autocomplete.js"></script>
        <script src="../../paquetes/jquery/jquery.numeric.js"></script>
        <script src="../../paquetes/js/jquery.numeric.min.js"></script>
        <script src="js/funciones.js"></script>

        <script>
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
//                var mostrarFecha = diad[ahora.getDay()] + "," + ' ' + dia + ' ' + "de" + ' ' + mes[ahora.getMonth()];
//                var mostrarAño = año;

                $("#i_horas").val(mostrarReloj);

//                document.tiempo.reloj.value = mostrarReloj;
//                document.tiempo.fecha.value = mostrarFecha;
//                document.tiempo.año.value = mostrarAño;

                setTimeout("sacarDate()", 1000);


            }
        </script>
        <style>
            .manito{
                cursor:pointer;
            }
        </style>
    </head>
    <body  onLoad="sacarDate()">
        <?php
        echo "<input type='hidden' id='i_id_tipo_contrato' value='$id_tipo_contrato' />";
        echo "<input type='hidden' id='fecha_inicio_contrato' value='$fecha_inicio_contrato' />";
        echo "<input type='hidden' id='fecha_termino_contrato' value='$fecha_termino_contrato' />";

//        $hora_entrada = $reg[0]["hora_entrada"];
//$hora_salida = $reg[0]["hora_salida"];
//
//$hora_re_entrada = $reg[0]["hora_re_entrada"];
//$hora_re_salida = $reg[0]["hora_re_salida"];

        echo "<input type='hidden' id='horario_hora_entrada' value='$hora_entrada' />";
        echo "<input type='hidden' id='horario_hora_salida' value='$hora_salida' />";
        echo "<input type='hidden' id='horario_hora_re_entrada' value='$hora_re_entrada' />";
        echo "<input type='hidden' id='horario_hora_re_salida' value='$hora_re_salida' />";

        //$fec_ini, $fec_fin, $dni
        if (isset($_GET["fec_ini"])) {
            $fec_ini = $_GET["fec_ini"];
            $fec_fin = $_GET["fec_fin"];
            $dni = $dni_usuario;

            $titulo = " del $fec_ini hasta el $fec_fin";
        } else {
            $fec_ini = $hoy;
            $fec_fin = $hoy;
            $dni = $dni_usuario;

            $titulo = " del dia de hoy $fec_ini";
        }
        ?>
        <div class="col-md-12 col-lg-10 col-lg-offset-1">

            <div class="center principal">
                <h2 class="pull-left title" >Listado de Asistencias <small><?php echo $titulo; ?></small></h2>
                <div class="divider pull-left" style="margin-right:10px"></div>
                <button type="button" class="btn btn-cancelar" data-toggle="modal" data-target="#modalNuevo" style="margin-top:15px;
                        margin-bottom: 5px;">
                    Nueva Entrada
                </button>

            </div>
            <div class="clearfix"></div>

            <div class="panel-tabla">
                <div class="row">
                    <div class="form-group form-group-sm col-md-3">
                        <label for="">Fecha Inicio</label>
                        <input type="text" class="form-control" id="b_fec_ini" value="<?php echo $fec_ini; ?>" placeholder="Fecha ini">
                    </div>
                    <div class="form-group form-group-sm col-md-3">
                        <label for="">Fecha Fin</label>
                        <input type="text" class="form-control" id="b_fec_fin" value="<?php echo $fec_fin; ?>" placeholder="Fecha fin">
                    </div>
                    <div class="form-group form-group-sm col-md-3">
                        <label for="">Dni</label>
                        <input type="text" class="form-control" id="b_dni" value="<?php echo $dni_usuario; ?>" disabled="true" placeholder="Dni">
                    </div>
                    <div class="form-group form-group-sm col-md-1">
                        <label for="">.</label>
                        <button type="button" class="btn btn-success" id="btn_consultar">
                            Buscar
                        </button>
                    </div>
                </div>

                <table class="table table-bordered table-condensed table-hover">
                    <thead class="background-thead">
                        <tr>
<!--<th class="text-center">Ebitar</th>-->
                            <th class="text-center">Nombres y Apellidos</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Perfil</th>
                            <th class="text-center"  width="110px">Fecha</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Marco desde</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Permiso</th>
                            <th class="text-center">Horario</th>
<!--<th class="text-center">Eliminar</th>-->
                        </tr>
                    </thead>
                    <tbody class="background-tbody">
                        <?php
                        require_once('../../clases/asistencia/class_asistencia.php');
                        require_once('../../clases/conexion.php');

                        include('controlador/vista.php');
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- modalNuevo -->
        <!--<form name="tiempo" class="tiempo">-->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Registrar Asistencia</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Dni Personal</label>
                                                <input type="text" class="form-control" id="i_dni" value="<?php echo $dni_usuario; ?>" disabled="true" placeholder="dni" maxlength="8">
                                                <input type="hidden" id="i_id_usuario" value="<?php echo $id_usuario_sesion; ?>"/>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Nombre Personal</label>
                                                <input type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" id="i_nombre" placeholder="Nombre" disabled="true">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Apellidos Personal</label>
                                                <input type="text" class="form-control" value="<?php echo $apellido_usuario; ?>" id="i_apellido" placeholder="Apellidos" disabled="true">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fecha</label>
                                                <input type="text" class="form-control" disabled="true"  id="i_fecha" value="<?php echo $hoy; ?>" placeholder="Fecha nacimiento">
                                            </div>


                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora</label><br>
                                                <!--<input type="text" class="form-control"   id="i_horas"  placeholder="Fecha nacimiento"/>-->
                                                <input type="text" class="form-control" disabled="true"  id="i_horas" name="reloj" placeholder="Fecha nacimiento"/>


                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Tipo</label>
                                                <select id="i_tipo" class="form-control" disabled="true">

                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_insertar">Marcar Asistencia</button>
                    </div>
                </div>
            </div>
        </div>
                        <!-- modalHorario -->
        <div id="modalHorario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Horario</h4>
                    </div>
                    <div class="modal-body text-center" >
                        <div id="div_horario">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--</form>-->
    </body>
</html>