<?php
@session_start();
$id_usuario = $_SESSION["id_user"];
if (isset($id_usuario)) {
    $fec_ini;
    $fec_fin;
    $fecha_inicio_contrato;
    $fecha_termino_contrato;

    if ($fec_ini > $hoy) {
        echo "<tr>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "</tr>";
    } else {
         if($fec_fin>$hoy){
           $fec_fin= $hoy;
        }
//        $id_dias; //1 lun-sab, 2 solo domingo
        $def = new asistencia();
        $consulta = $def->obtener_total_dia($fec_ini, $hoy, $id_dias);
        $numero = $consulta[0]["numero"];
        for ($i = 0; $i <= $numero; $i++) {
            $in = new asistencia();
            $consu = $in->generar_fecha($fec_ini, $i, $id_dias);
            @$fecha_incremental = $consu[0]["datos"];
//            if ($fecha_incremental != $hoy) {
            if ($fecha_incremental != null) {
                if ($fecha_incremental >= $fecha_inicio_contrato) {
                    $tra = new asistencia();
                    $reg = $tra->get_asistencia_seleccion($fecha_incremental, $dni_usuario);
                    $i_fecha=$fecha_incremental;
                    @$id = $reg[0]["id_asistencia"];
                    if ($id == null) {
                        echo "<tr>";
                        echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                        echo "<td>" . $dni_usuario . "</td>";
                        echo "<td>" . $nombre_cargo_usuario . "</td>";
                        echo "<td>" . $nombre_perfil_usuario . "</td>";
                        echo "<td>" . $fecha_incremental . "</td>";
                        echo "<td>" . "----" . "</td>";
                        echo "<td>" . "----" . "</td>";
                        echo "<td>" . "----" . "</td>";
                        echo "<td><font color =red >Falto</font></td>";

                        $cadena = "";
                        $clase_per = new permiso();
                        $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                        for ($r = 0; $r < count($per_reg); $r++) {
                            @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                            @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                            if ($hora_fin_permiso != null) {
                                $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                            }
                        }
                        if ($cadena == "") {
                            $cadena = "---";
                        }
                        echo "<td><font color =blue >$cadena</font></td>";
                        echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                        echo "</tr>";
                    } else {
                        //si es tiempo completo, si es medio tiempo
//                        $id_tipo_contrato;
                        $contador = 0;
                        for ($j = 0; $j <= count($reg); $j++) {

                            @$id = $reg[$j]["id_asistencia"];
                            if ($id != null) {
                                $contador++;
                                echo "<tr>";
                                $estado = $reg[$j]["id_estado"];
                                $tipo = $reg[$j]["id_tipo"];
                                echo "<td>" . $reg[$j]["nombre"] . " " . $reg[$j]["apellidos"] . "</td>";
                                echo "<td>" . $reg[$j]["dni"] . "</td>";
                                echo "<td>" . $reg[$j]["nombre_cargo"] . "</td>";
                                echo "<td>" . $reg[$j]["nombre_perfil"] . "</td>";
                                echo "<td>" . $reg[$j]["fecha_ingreso"] . "</td>";
                                echo "<td>" . $reg[$j]["hora"] . "</td>";
                                echo "<td>" . $reg[$j]["ip_pc"] . "</td>";
                                echo "<td>" . $reg[$j]["nombre_tipo"] . "</td>";
                                if ($tipo == 1 || $tipo == 4) {
                                    if ($estado == 4) {
                                        echo "<td ><font color =blue >Asistio Temprano</font></td>";
                                    } else if ($estado == 5) {
                                        echo "<td><font color =orange >Tarde</font></td>";
                                    } else if ($estado == 6) {
                                        echo "<td><font color =blue >Permiso Temprano</font></td>";
                                    } else if ($estado == 7) {
                                        echo "<td><font color =red >Permiso Tarde</font></td>";
                                    } else {
                                        echo "<td><font color =red >Eliminado</font></td>";
                                    }
                                } else {
                                    echo "<td><font color =blue >Salida</font></td>";
                                }

                                $cadena = "";
                                $clase_per = new permiso();
                                $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                for ($r = 0; $r < count($per_reg); $r++) {
                                    @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                    @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                    if ($hora_fin_permiso != null) {
                                        $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                    }
                                }
                                if ($cadena == "") {
                                    $cadena = "---";
                                }
                                echo "<td><font color =blue >$cadena</font></td>";
                                echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                echo "</tr>";
                            }
                        }
//                        echo "<tr>";
//                                    echo "<td></td>";
//                                    echo "<td></td>";
//                                    echo "<td></td>";
//                                    echo "<td></td>";
//                                    echo "<td></td>";
//                                    echo "<td>" . "----" . "</td>";
//                                    echo "<td>" . $contador ."!=". 2 . "</td>";
//                                    echo "<td>" . "Hora Refrigerio Entrada" . "</td>";
//                                    echo "<td><font color =red >NO MARCO</font></td>";
//                                    echo "</tr>";

                        if ($id_tipo_contrato == 1) {
                            if ($contador != 4) {
                                if ($contador == 1) {
                                    //solo marco su entrdada
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Refrigerio Entrada" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                    echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";

                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Refrigerio Salida" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                     echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Salida" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                     echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                    echo "</tr>";
                                }
                                if ($contador == 2) {
                                    //solo marco su entrada y entrada de refrigerio
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Refrigerio Salida" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                     echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Salida" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                     echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                    echo "</tr>";
                                }
                                if ($contador == 3) {
                                    //solo marco su entrada ,entrada de refrigerio,salida de refrigerio
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Salida" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                     echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            if ($contador != 2) {
                                if ($contador == 1) {
                                    //solo marco su entrdada
                                    echo "<tr>";
                                    echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                    echo "<td>" . $dni_usuario . "</td>";
                                    echo "<td>" . $nombre_cargo_usuario . "</td>";
                                    echo "<td>" . $nombre_perfil_usuario . "</td>";
                                    echo "<td>" . $fecha_incremental . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "----" . "</td>";
                                    echo "<td>" . "Hora Salida" . "</td>";
                                    echo "<td><font color =red >NO MARCO</font></td>";
                                    $cadena = "";
                                    $clase_per = new permiso();
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_sesion);
                                    for ($r = 0; $r < count($per_reg); $r++) {
                                        @$hora_ini_permiso = $per_reg[$r]["hora_inicio"]; //8:00
                                        @$hora_fin_permiso = $per_reg[$r]["hora_fin"]; //10:00
                                        if ($hora_fin_permiso != null) {
                                            $cadena = $cadena . @$hora_ini_permiso . "-" . @$hora_fin_permiso . ",";
                                        }
                                    }
                                    if ($cadena == "") {
                                        $cadena = "---";
                                    }
                                    echo "<td><font color =blue >$cadena</font></td>";
                                     echo "<td><a href='#' onclick='abrir_horario($id_usuario)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                    
                    
                    
                }
            }
        }
    }
}
?>               