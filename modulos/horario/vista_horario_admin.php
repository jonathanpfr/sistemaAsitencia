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
$regaw = $clase_u->seleccion_usuario($_GET["id_usuario"]);

$dni_usuario = $regaw[0]["dni"];
$nombre_usuario = $regaw[0]["nombre"];
$apellido_usuario = $regaw[0]["apellidos"]; //nombre_cargo
$nombre_cargo_usuario = $regaw[0]["nombre_cargo"];
$nombre_perfil_usuario = $regaw[0]["nombre_perfil"]; //nombre_perfil

$fecha_inicio_contrato = $regaw[0]["fecha_inicio_contrato"];
$fecha_termino_contrato = $regaw[0]["fecha_termino_contrato"];

$id_dias = $regaw[0]["id_dias"];
$hora_entrada = $regaw[0]["hora_entrada"];
$hora_salida = $regaw[0]["hora_salida"];

$hora_re_entrada = $regaw[0]["hora_re_entrada"];
$hora_re_salida = $regaw[0]["hora_re_salida"];
$id_tipo_contrato = $regaw[0]["id_tipo_contrato"]; //1 tiempo completo, 2 medio tiempo
 echo "Horario del Perosnal :".$nombre_usuario . " " . $apellido_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; DNI:" . $dni_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; Perfil:" . $nombre_perfil_usuario . "<br><br> Fecha inicio Contrato:" . $fecha_inicio_contrato . "&nbsp;&nbsp;&nbsp;&nbsp; Fecha Termino contrato :" . $fecha_termino_contrato ;

//$array_hora_salida = split(":", $hora_salida);
//$minutos_salida = ($array_hora_salida[0] * 60) + $array_hora_salida[1];
//
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

    </head>
    <body >
        <div class="col-md-12 col-lg-10 col-lg-offset-1">
            <div class="center principal">
                <h2 class="pull-left title" >Horario del Personal : <small><?php echo $nombre_usuario . " " . $apellido_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; DNI:" . $dni_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; Perfil:" . $nombre_perfil_usuario . "<br><br> Fecha inicio Contrato:" . $fecha_inicio_contrato . "&nbsp;&nbsp;&nbsp;&nbsp; Fecha Termino contrato :" . $fecha_termino_contrato ?></small></h2>

<!--<small><?php // echo "Fecha inicio Contrato:".$fecha_inicio_contrato." Fecha Termino contrato :".$fecha_termino_contrato  ?></small>-->
            </div>
            <div class="clearfix"></div>
            <table class="table table-bordered table-condensed table-hover">
                <thead class="background-thead">
                    <tr>
                        <th class="text-center">Lunes</th>
                        <th class="text-center">Martes</th>
                        <th class="text-center">Miercoles</th>
                        <th class="text-center">Jueves</th>
                        <th class="text-center">Viernes</th>
                        <th class="text-center">Sabado</th>
                        <th class="text-center">Domingo</th>
                    </tr>
                </thead>
                <tbody class="background-tbody">
                    <?php
//                    echo "aquiiiiiiiiiiii=" . $id_tipo_contrato;
                    $array_hora_entrada = split(":", $hora_entrada);
                    $minutos_entrada = ($array_hora_entrada[0] * 60) + $array_hora_entrada[1];

//                    echo ($array_hora_entrada[0] * 60) + $array_hora_entrada[1];
//                    echo $minutos_entrada . ">" . "750";

//                    $id_dias = $reg[0]["id_dias"];
//                    $hora_entrada = $reg[0]["hora_entrada"];
//                    $hora_salida = $reg[0]["hora_salida"];
//
//                    $hora_re_entrada = $reg[0]["hora_re_entrada"];
//                    $hora_re_salida = $reg[0]["hora_re_salida"];
//                    $id_tipo_contrato = $reg[0]["id_tipo_contrato"];

                    if ($id_tipo_contrato == 1) {
                        //si es lunes-sabado && tipo_contrato=tiempo completo
                        if ($id_dias == 1) {
                            echo "<tr>";
                            for ($i = 0; $i < 6; $i++) {
                                echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
                            }
                            echo "<td class='text-center'>---</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td class='text-center' colspan='7'>";
                            echo "REFRIGERIO";
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                            for ($i = 0; $i < 6; $i++) {
                                echo "<td class='text-center'>" . $hora_re_salida . "-" . $hora_salida . "</td>";
                            }
                            echo "<td class='text-center'>---</td>";
                            echo "</tr>";
                        }

                        //si es domingos && tipo_contrato=tiempo completo
                        if ($id_dias == 2) {
                            echo "<tr>";
                            for ($i = 0; $i < 6; $i++) {
                                echo "<td class='text-center'>---</td>";
                            }
                            echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td class='text-center' colspan='7'>";
                            echo "REFRIGERIO";
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                            for ($i = 0; $i < 6; $i++) {
                                echo "<td class='text-center'>---</td>";
                            }
                            echo "<td class='text-center'>" . $hora_re_salida . "-" . $hora_salida . "</td>";
                            echo "</tr>";
                        }
                    } else {//medio tiempo
                       
                        if ($minutos_entrada >= 750) {
                            //tarde
                             //si es lunes-sabado && tipo_contrato=tiempo completo
                            if ($id_dias == 1) {
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
                                }
                                echo "<td class='text-center'>---</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='text-center' colspan='7'>";
                                echo "REFRIGERIO";
                                echo "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>---</td>";
                                }
                                echo "<td class='text-center'>---</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>---</td>";
                                }
                                echo "<td class='text-center'>---</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='text-center' colspan='7'>";
                                echo "REFRIGERIO";
                                echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>---</td>";
                                }
                                echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            //mañana
                            if ($id_dias == 1) {
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
                                }
                                echo "<td class='text-center'>---</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='text-center' colspan='7'>";
                                echo "REFRIGERIO";
                                echo "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>---</td>";
                                }
                                echo "<td class='text-center'>---</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>---</td>";
                                }
                                echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                echo "<td class='text-center' colspan='7'>";
                                echo "REFRIGERIO";
                                echo "</td>";
                                echo "</tr>";

                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>---</td>";
                                }
                                echo "<td class='text-center'>---</td>";
                                echo "</tr>";
                            }
                        }
//                        if ($id_dias == 1) {
//                            echo "<tr>";
//                            for ($i = 0; $i < 6; $i++) {
//                                echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
//                            }
//                            echo "<td class='text-center'>---</td>";
//                            echo "</tr>";
//
//                            echo "<tr>";
//                            echo "<td class='text-center' colspan='7'>";
//                            echo "REFRIGERIO";
//                            echo "</td>";
//                            echo "</tr>";
//
//                            echo "<tr>";
//                            for ($i = 0; $i < 6; $i++) {
//                                echo "<td class='text-center'>" . $hora_re_salida . "-" . $hora_salida . "</td>";
//                            }
//                            echo "<td class='text-center'>---</td>";
//                            echo "</tr>";
//                        } else {
//                            echo "<tr>";
//                            for ($i = 0; $i < 6; $i++) {
//                                echo "<td class='text-center'>---</td>";
//                            }
//                            echo "<td class='text-center'>" . $hora_entrada . "-" . $hora_re_entrada . "</td>";
//                            echo "</tr>";
//
//                            echo "<tr>";
//                            echo "<td class='text-center' colspan='7'>";
//                            echo "REFRIGERIO";
//                            echo "</td>";
//                            echo "</tr>";
//
//                            echo "<tr>";
//                            for ($i = 0; $i < 6; $i++) {
//                                echo "<td class='text-center'>---</td>";
//                            }
//                            echo "<td class='text-center'>" . $hora_re_salida . "-" . $hora_salida . "</td>";
//                            echo "</tr>";
//                        }
                    }
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
                                            <label for="">Dni</label>
                                            <input type="text" class="form-control" id="i_dni" value="<?php echo $dni_usuario; ?>" disabled="true" placeholder="dni" maxlength="8">
                                            <input type="hidden" id="i_id_usuario" value="<?php echo $id_usuario_sesion; ?>"/>
                                        </div>
                                        <div class="form-group form-group-sm col-md-4">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" id="i_nombre" placeholder="Nombre" disabled="true">
                                        </div>
                                        <div class="form-group form-group-sm col-md-4">
                                            <label for="">Apellidos</label>
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
    <!--</form>-->
</body>
</html>