<?php
@session_start();
$id_usuario = $_SESSION["id_user"];

$_SESSION["s_faltas"] = 0;
$_SESSION["s_solo_dias"] = 0;
$_SESSION["s_tardanzas"] = 0;
$_SESSION["s_asistencias"] = 0;
$_SESSION["s_sin_marcar"] = 0;
$_SESSION["todos_marcar"] = 0;
$_SESSION["todos_asistencia"] = 0;
$_SESSION["s_todos"] = 0;

if (isset($id_usuario)) {
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
        echo "<td>" . "" . "</td>";
        echo "<td>" . "" . "</td>";
        echo "</tr>";
    } else {
        $def = new asistencia();
        $consulta = $def->obtener_total_dia($fec_ini, $hoy);
        $numero = $consulta[0]["numero"];
        for ($i = 0; $i <= $numero; $i++) {
            $in = new asistencia();
            $consu = $in->generar_fecha_dos($fec_ini, $i);
            @$fecha_incremental = $consu[0]["datos"];

            //traer_usuarios where fecha_ contrato sea >=fecha cremental
            $clase_u = new usuario();
            $regau = $clase_u->usuarios_fechas_contratos($fecha_incremental, $dni);
            for ($j = 0; $j < count($regau); $j++) {
                $id_usuario_b = $regau[$j]["id_usuario"];
                $nombre_usuario = $regau[$j]["nombre"];
                $apellido_usuario = $regau[$j]["apellidos"];
                $dni_usuario = $regau[$j]["dni"];
                $nombre_perfil_usuario = $regau[$j]["nombre_perfil"];
                $nombre_cargo_usuario = $regau[$j]["nombre_cargo"];
                $fecha_inicio_contrato_b = $regau[$j]["fecha_inicio_contrato"];
                $id_dias_b = $regau[$j]["id_dias"]; //id_tipo_contrato
                $id_tipo_contrato = $regau[$j]["id_tipo_contrato"]; //id_tipo_contrato

                $clase_asis = new asistencia();
                $regasis = $clase_asis->verificar_si_es_domingo($fecha_incremental);
                $fecha_domingo = $regasis[0]["dia"];
                if ($id_dias_b == 1) {//lunes a sabado
                    //la fecha incremental que no sea domingo ?
                    if ($fecha_domingo !== "Sunday") {
                        $tras_a = new asistencia();
                        $regaa = $tras_a->get_asistencia_seleccion_sin_dni($fecha_incremental, $id_usuario_b);
                        $i_fecha = $fecha_incremental;
                        if (((int) count($regaa)) == 0) {
                            if ($id_tipo_contrato == 1) {//tiempo compelto
                                $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 4;
                                $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 2;
                            } else {//medio tiempo 
                                $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 2;
                                $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                            }

                            if ($get_estado == "v" || $get_estado == "m") {
                                $_SESSION["s_faltas"] = $_SESSION["s_faltas"] + 1;
                                $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                $_SESSION["s_solo_dias"] = $_SESSION["s_solo_dias"] + 1;

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
                                $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                echo "</tr>";
                            }
                        }

                        if ((int) count($regaa) !== 0) {
                            $contador = 0;
                            $tras_a = new asistencia();
                            $regaa = $tras_a->get_asistencia_seleccion_sin_dni($fecha_incremental, $id_usuario_b);
                            for ($d = 0; $d < count($regaa); $d++) {
                                if ($d == 0) {
                                    $_SESSION["s_solo_dias"] = $_SESSION["s_solo_dias"] + 1;
                                }
                                $id = $regaa[$d]["id_asistencia"];
//                                if ($id !== null) {
                                $contador++;
                                $estado = $regaa[$d]["id_estado"];
                                $tipo = $regaa[$d]["id_tipo"];
                                if ($get_estado == $estado || $get_estado == "v") {
                                    echo "<tr>";
                                    echo "<td>" . $regaa[$d]["nombre"] . " " . $regaa[$d]["apellidos"] . "</td>";
                                    echo "<td>" . $regaa[$d]["dni"] . "</td>";
                                    echo "<td>" . $regaa[$d]["nombre_cargo"] . "</td>";
                                    echo "<td>" . $regaa[$d]["nombre_perfil"] . "</td>";
                                    echo "<td>" . $regaa[$d]["fecha_ingreso"] . "</td>";
                                    echo "<td>" . $regaa[$d]["hora"] . "</td>";
                                    echo "<td>" . $regaa[$d]["ip_pc"] . "</td>";
                                    echo "<td>" . $regaa[$d]["nombre_tipo"] . "</td>";
                                    $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;

                                    if ((int) $tipo == 1 || (int) $tipo == 4) {
                                        if ($estado == 4) {
                                            $_SESSION["s_asistencias"] = $_SESSION["s_asistencias"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td ><font color =blue >Asistio Temprano</font></td>";
                                            $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                                        } else if ($estado == 5) {
                                            $_SESSION["s_tardanzas"] = $_SESSION["s_tardanzas"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td><font color =orange >Tarde</font></td>";
                                            $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
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
                                    $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                    echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";

                                    echo "</tr>";
                                }
//                                }
                            }
                            if ($id_tipo_contrato == 1) {
                                if ($contador != 4) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 3;
                                        $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                                        if ($get_estado == "s" || $get_estado == "v") {
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<tr>";
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Refrigerio Entrada" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Refrigerio Salida</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    if ($contador == 2) {
                                        //solo marco su entrada y entrada de refrigerio
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 2;
//                                         $_SESSION["todos_asistencia"]=$_SESSION["todos_asistencia"]+1;
                                        if ($get_estado == "s" || $get_estado == "v") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Refrigerio Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    if ($contador == 3) {
                                        //solo marco su entrada ,entrada de refrigerio,salida de refrigerio
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;
//                                         $_SESSION["todos_asistencia"]=$_SESSION["todos_asistencia"]+1;
                                        if ($get_estado == "s" || $get_estado == "v") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            } else { //medio tiempo
                                if ($contador != 2) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;
                                        $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                                        if ($get_estado == "s" || $get_estado == "v") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {//solo domingos
                    // la fecha incremental es solo domingo
                    //si es domingo q pinte
                    if ($fecha_domingo == "Sunday") {
                        //asistencia de ese dia
                        $tra = new asistencia();
                        $reg = $tra->get_asistencia_seleccion($fecha_incremental, $dni_usuario);
                        $i_fecha = $fecha_incremental;
//                        @$id = $reg[0]["id_asistencia"];
                        if (((int) count($reg)) == 0) {
                        $_SESSION["s_solo_dias"] = $_SESSION["s_solo_dias"] + 1;
                            if ($id_tipo_contrato == 1) {
                                $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 4;
                                $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 2;
                            } else {
                                $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 2;
                                $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                            }

                            if ($get_estado == "m" || $get_estado == "v") {
                                echo "<tr>";
                                $_SESSION["s_faltas"] = $_SESSION["s_faltas"] + 1;
                                $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
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
                                $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            //si es tiempo completo, si es medio tiempo
//                        $id_tipo_contrato;
                            $contador = 0;
                            for ($j = 0; $j < count($reg); $j++) {
                                if ($j == 0) {
                                    $_SESSION["s_solo_dias"] = $_SESSION["s_solo_dias"] + 1;
                                }
                                $id = $reg[$j]["id_asistencia"];
                                if ($id != null) {
                                    $contador++;

                                    $estado = $reg[$j]["id_estado"];
                                    $tipo = $reg[$j]["id_tipo"];
                                    $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;
                                    $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                                    if ($get_estado == $estado || $get_estado == "v") {
                                        echo "<tr>";
                                        echo "<td>" . $reg[$j]["nombre"] . " " . $reg[$j]["apellidos"] . "</td>";
                                        echo "<td>" . $reg[$j]["dni"] . "</td>";
                                        echo "<td>" . $reg[$j]["nombre_cargo"] . "</td>";
                                        echo "<td>" . $reg[$j]["nombre_perfil"] . "</td>";
                                        echo "<td>" . $reg[$j]["fecha_ingreso"] . "</td>";
                                        echo "<td>" . $reg[$j]["hora"] . "</td>";
                                        echo "<td>" . $reg[$j]["ip_pc"] . "</td>";
                                        echo "<td>" . $reg[$j]["nombre_tipo"] . "</td>";
                                        //                                $_SESSION["s_faltas"] = 0;//m
//                                $_SESSION["s_tardanzas"] = 0;//5
//                                $_SESSION["s_asistencias"] = 0;//4
//                                $_SESSION["s_sin_marcar"] = 0;//s
//                                $_SESSION["s_todos"] = 0;//v

                                        if ($tipo == 1 || $tipo == 4) {
                                            $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;
                                            if ($estado == 4) {
                                                echo "<td ><font color =blue >Asistio Temprano</font></td>";
                                                $_SESSION["s_asistencias"] = $_SESSION["s_asistencias"] + 1;
                                            } else if ($estado == 5) {
                                                echo "<td><font color =orange >Tarde</font></td>";
                                                $_SESSION["s_tardanzas"] = $_SESSION["s_tardanzas"] + 1;
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
                                        $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                        echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";

                                        echo "</tr>";
                                    }
                                }
                            }
                            if ($id_tipo_contrato == 1) {
                                if ($contador != 4) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada y es tiempo completo
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 3;
                                        $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                                        if ($get_estado == "v" || $get_estado == "s") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;



                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Refrigerio Entrada" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
//                                            $_SESSION["todos_marcar"]=$_SESSION["todos_marcar"]+1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Refrigerio Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
//                                            $_SESSION["todos_marcar"]=$_SESSION["todos_marcar"]+1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";

                                            echo "</tr>";
                                        }
                                    }
                                    if ($contador == 2) {
                                        //solo marco su entrada y entrada de refrigerio
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 2;
                                        $_SESSION["todos_asistencia"] = $_SESSION["todos_asistencia"] + 1;
                                        if ($get_estado == "v" || $get_estado == "s") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
//                                            $_SESSION["todos_marcar"]=$_SESSION["todos_marcar"]+1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Refrigerio Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    if ($contador == 3) {
                                        //solo marco su entrada ,entrada de refrigerio,salida de refrigerio
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;
                                        if ($get_estado == "v" || $get_estado == "s") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;

                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            } else {//medio tiempo
                                if ($contador != 2) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        $_SESSION["todos_marcar"] = $_SESSION["todos_marcar"] + 1;

                                        if ($get_estado == "v" || $get_estado == "s") {
                                            echo "<tr>";
                                            $_SESSION["s_sin_marcar"] = $_SESSION["s_sin_marcar"] + 1;
                                            $_SESSION["s_todos"] = $_SESSION["s_todos"] + 1;
//                                            $_SESSION["todos_marcar"]=$_SESSION["todos_marcar"]+1;
                                            echo "<td>" . $nombre_usuario . " " . $apellido_usuario . "</td>";
                                            echo "<td>" . $dni_usuario . "</td>";
                                            echo "<td>" . $nombre_cargo_usuario . "</td>";
                                            echo "<td>" . $nombre_perfil_usuario . "</td>";
                                            echo "<td>" . $fecha_incremental . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "----" . "</td>";
                                            echo "<td>" . "Hora Salida" . "</td>";
                                            echo "<td><font color =red >No marco</font></td>";
                                            $cadena = "";
                                            $clase_per = new permiso();
                                            $per_reg = $clase_per->get_permiso_usuario($i_fecha, $id_usuario_b);
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
                                            echo "<td><a href='#' onclick='abrir_horario($id_usuario_b)'  data-toggle='modal' data-target='#modalHorario' ><img src='../../paquetes/img/horario.png' width='30px' height='30px'></a></td>";
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
    }
}
?>               