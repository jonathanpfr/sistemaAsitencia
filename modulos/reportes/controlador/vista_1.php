<?php
@session_start();
$id_usuario = $_SESSION["id_user"];
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
                    //si no es domingo que pinte
                    if ($fecha_domingo !== "Sunday") {
//                        echo "<tr><td>$nombre_b</td><td>$fecha_incremental</td><td>$fecha_inicio_contrato_b,$fecha_domingo</td></tr>";
                        //asistencia de ese dia
                        $tra = new asistencia();
                        $reg = $tra->get_asistencia_seleccion($fecha_incremental, $dni_usuario);
                        $i_fecha = $fecha_incremental;
                        @$id = $reg[0]["id_asistencia"];
                        if ($id == null) {
                            echo "<tr>";
                            echo "<td></td>";
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
                            echo "<td></td>";
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
                                    
                                    echo "<td><a class='manito'  data-toggle='modal' data-target='#modalEditar' onclick='modificar($id);'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
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
                                            echo "<td><font color =orange >Asistio Tarde</font></td>";
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
                                     echo "<td><a  class='manito'  onclick='eliminar($id)'  data-toggle='modal' data-target='#modalEliminar'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td>";

                                    echo "</tr>";
                                }
                            }
                            if ($id_tipo_contrato == 1) {
                                if ($contador != 4) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";

                                        echo "</tr>";
                                    }
                                    if ($contador == 2) {
                                        //solo marco su entrada y entrada de refrigerio
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                    }
                                    if ($contador == 3) {
                                        //solo marco su entrada ,entrada de refrigerio,salida de refrigerio
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                if ($contador != 2) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    }
                } else {//solo domingos
                    // la fecha incremental es solo domingo
                    //si es domingo q pinte
                    if ($fecha_domingo == "Sunday") {
//                        echo "<tr><td>$nombre_b</td><td>$fecha_incremental</td><td>$fecha_inicio_contrato_b,$fecha_domingo</td></tr>";
                        //asistencia de ese dia
                        $tra = new asistencia();
                        $reg = $tra->get_asistencia_seleccion($fecha_incremental, $dni_usuario);
                        $i_fecha = $fecha_incremental;
                        @$id = $reg[0]["id_asistencia"];
                        if ($id == null) {
                            echo "<tr>";
                            echo "<td></td>";
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
                            echo "<td></td>";
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
                                    
                                    echo "<td><a class='manito'  data-toggle='modal' data-target='#modalEditar' onclick='modificar($id);'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
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
                                            echo "<td><font color =orange >Asistio Tarde</font></td>";
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
                                     echo "<td><a  class='manito'  onclick='eliminar($id)'  data-toggle='modal' data-target='#modalEliminar'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td>";

                                    echo "</tr>";
                                }
                            }
                            if ($id_tipo_contrato == 1) {
                                if ($contador != 4) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";

                                        echo "</tr>";
                                    }
                                    if ($contador == 2) {
                                        //solo marco su entrada y entrada de refrigerio
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                    }
                                    if ($contador == 3) {
                                        //solo marco su entrada ,entrada de refrigerio,salida de refrigerio
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                if ($contador != 2) {
                                    if ($contador == 1) {
                                        //solo marco su entrdada
                                        echo "<tr>";
                                         echo "<td></td>";
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
                                         echo "<td></td>";
                                        echo "</tr>";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
//    $tra = new asistencia();
//    $reg = $tra->get_asistencia($fec_ini, $fec_fin, $dni);
//    for ($i = 0; $i < count($reg); $i++) {
//        $id = $reg[$i]["id_asistencia"];
//        $estado = $reg[$i]["id_estado"];
//        echo "<td><a class='manito'  data-toggle='modal' data-target='#modalEditar' onclick='modificar($id);'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
//        echo "<td>" . $reg[$i]["nombre"] . " " . $reg[$i]["apellidos"] . "</td>";
//        echo "<td>" . $reg[$i]["dni"] . "</td>";
//        echo "<td>" . $reg[$i]["nombre_cargo"] . "</td>";
//        echo "<td>" . $reg[$i]["nombre_perfil"] . "</td>";
//        echo "<td>" . $reg[$i]["fecha_ingreso"] . "</td>";
//        echo "<td>" . $reg[$i]["hora"] . "</td>";
//        echo "<td>" . $reg[$i]["ip_pc"] . "</td>";
//        echo "<td>" . $reg[$i]["nombre_tipo"] . "</td>";
//        if ($estado == 4) {
//            echo "<td ><font color =blue >Temprano</font></td>";
//        } else if ($estado == 5) {
//            echo "<td><font color =red >Tarde</font></td>";
//        } else if ($estado == 6) {
//            echo "<td><font color =blue >Permiso</font></td>";
//        } else {
//            echo "<td><font color =red >Eliminado</font></td>";
//        }
//        echo "<td><a  class='manito'  onclick='eliminar($id)'  data-toggle='modal' data-target='#modalEliminar'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td>";
//        echo "</tr>";
//    }
    }
}
?>               