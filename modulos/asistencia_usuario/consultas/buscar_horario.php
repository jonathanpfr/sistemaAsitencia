<?php
@session_start();
$id_usuario_sesion = $_SESSION["id_user"];
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");
require_once '../../../clases/usuario/class_usuario.php';
require_once '../../../clases/asistencia/class_asistencia.php';
require_once '../../../clases/permiso/class_permiso.php';
require_once '../../../clases/conexion.php';
$clase_u = new usuario();
$regaw = $clase_u->seleccion_usuario($_POST["id_usuario"]);

$dni_usuario = $regaw[0]["dni"];
$nombre_usuario = $regaw[0]["nombre"];
$apellido_usuario = $regaw[0]["apellidos"]; //nombre_cargo
$nombre_cargo_usuario = $regaw[0]["nombre_cargo"];
$nombre_perfil_usuario = $regaw[0]["nombre_perfil"]; //nombre_perfil

$fecha_inicio_contrato = $regaw[0]["fecha_inicio_contrato"];
$fecha_termino_contrato = $regaw[0]["fecha_termino_contrato"];

//$clase_h = new asistencia();
//$reg = $clase_h->buscar_horario($_POST["id_usuario"]);
//$id_dias = $reg[0]["id_dias"];
//$hora_entrada = $reg[0]["hora_entrada"];
//$hora_salida = $reg[0]["hora_salida"];
//
//$hora_re_entrada = $reg[0]["hora_re_entrada"];
//$hora_re_salida = $reg[0]["hora_re_salida"];
//$id_tipo_contrato = $reg[0]["id_tipo_contrato"]; //1 tiempo completo, 2 medio tiempo
// echo "Horario del Perosnal :".$nombre_usuario . " " . $apellido_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; DNI:" . $dni_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; Perfil:" . $nombre_perfil_usuario . "<br><br> Fecha inicio Contrato:" . $fecha_inicio_contrato . "&nbsp;&nbsp;&nbsp;&nbsp; Fecha Termino contrato :" . $fecha_termino_contrato ;
$id_dias = $regaw[0]["id_dias"];
$hora_entrada = $regaw[0]["hora_entrada"];
$hora_salida = $regaw[0]["hora_salida"];

$hora_re_entrada = $regaw[0]["hora_re_entrada"];
$hora_re_salida = $regaw[0]["hora_re_salida"];
$id_tipo_contrato = $regaw[0]["id_tipo_contrato"]; //1 tiempo completo, 2 medio tiempo
 echo "Horario del Perosnal :".$nombre_usuario . " " . $apellido_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; DNI:" . $dni_usuario . "&nbsp;&nbsp;&nbsp;&nbsp; Perfil:" . $nombre_perfil_usuario . "<br><br> Fecha inicio Contrato:" . $fecha_inicio_contrato . "&nbsp;&nbsp;&nbsp;&nbsp; Fecha Termino contrato :" . $fecha_termino_contrato ;

?>
<br><br>

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
                    $array_hora_entrada = split(":", $hora_entrada);
                    $minutos_entrada = ($array_hora_entrada[0] * 60) + $array_hora_entrada[1];

                    if ($id_tipo_contrato == 1) {
                        //si es lunes-sabado && tipo_contrato=tiempo completo
                        if ($id_dias == 1) {
                            echo "<tr>";
                            for ($i = 0; $i < 6; $i++) {
                                echo "<td class='text-center'>" . $hora_entrada . " - " . $hora_re_entrada . "</td>";
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
                                echo "<td class='text-center'>" . $hora_re_salida . " - " . $hora_salida . "</td>";
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
                            echo "<td class='text-center'>" . $hora_entrada . " - " . $hora_re_entrada . "</td>";
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
                            echo "<td class='text-center'>" . $hora_re_salida . " - " . $hora_salida . "</td>";
                            echo "</tr>";
                        }
                    } else {//medio tiempo
                       
                        if ($minutos_entrada >= 750) {
                            //tarde
                             //si es lunes-sabado && tipo_contrato=tiempo completo
                            if ($id_dias == 1) {
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>" . $hora_entrada . " - " . $hora_re_entrada . "</td>";
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
                                echo "<td class='text-center'>" . $hora_entrada . " - " . $hora_re_entrada . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            //mañana
                            if ($id_dias == 1) {
                                echo "<tr>";
                                for ($i = 0; $i < 6; $i++) {
                                    echo "<td class='text-center'>" . $hora_entrada . " - " . $hora_re_entrada . "</td>";
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
                                echo "<td class='text-center'>" . $hora_entrada . " - " . $hora_re_entrada . "</td>";
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
                    }
                    ?>
                </tbody>
            </table>
      