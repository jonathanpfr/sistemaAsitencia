<?php
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");
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

        <style>
            .manito{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <?php
//        if (isset($_GET["fec_ini"])) {
//            $fec_ini = $_GET["fec_ini"];
//            $fec_fin = $_GET["fec_fin"];
//            $dni = $_GET["dni"];
//            $titulo = " del $fec_ini hasta el $fec_fin";
//        } else {
//            $fec_ini = $hoy;
//            $fec_fin = $hoy;
//            $dni = "";
//            $titulo = " del dia de hoy $fec_ini";
//        }
        if (isset($_GET["fec_ini"])) {
            $fec_ini = $_GET["fec_ini"];
            $fec_fin = $_GET["fec_fin"];
            $dni = $_GET["dni"];
            if ($dni == "") {
                $vare = " Todos";
            } else {
                $vare = $dni;
            }
            $get_estado = $_GET["i_estado"];
            $nombre_estado = $_GET["nombre_estado"];

            $titulo = " del $fec_ini hasta el $fec_fin" . " Estado: " . $nombre_estado . " Dni:" . $vare;
        } else {
            $fec_ini = $hoy;
            $fec_fin = $hoy;
            $dni = "";
            $get_estado = "v";
            $nombre_estado = "Todos";

            $titulo = " del dia de hoy $fec_ini Estado: " . $nombre_estado . " Dni: Todos";
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
                    <div class="form-group form-group-sm col-md-2">
                        <label for="">Estado</label>
                        <select class="form-control" id="i_estado">
                            <option value="v">Todos</option>
                            <option value="m">Faltas</option>
                            <option value="5">Tardanzas</option>
                            <option value="4">Asistencias</option>
                            <option value="s">Sin marcar</option>

                        </select>
                    </div>
                    <div class="form-group form-group-sm col-md-3">
                        <label for="">Dni Personal</label>
                        <input type="text" class="form-control" id="b_dni" value="<?php echo $dni; ?>" maxlength="8" placeholder="Dni">
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
                            <th class="text-center">Editar</th>
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
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="background-tbody">
                        <?php
                        require_once('../../clases/asistencia/class_asistencia.php');
                        require_once('../../clases/permiso/class_permiso.php');
                        require_once('../../clases/horario/class_horario.php');
                        require_once('../../clases/usuario/class_usuario.php');
                        require_once('../../clases/conexion.php');
                        include('controlador/vista.php');
                        ?>
                    </tbody>
                </table>
                <?php
                $s_faltas = $_SESSION["s_faltas"];
                $s_tardanzas = $_SESSION["s_tardanzas"];
                $s_asistencias = $_SESSION["s_asistencias"];
                $s_sin_marcar = $_SESSION["s_sin_marcar"];
                $s_todos = $_SESSION["s_todos"];
                $s_solo_dias = $_SESSION["s_solo_dias"];
                $todos_marcar = $_SESSION["todos_marcar"];
                $todos_asistencia = $_SESSION["todos_asistencia"];
                ?>
                <div align='center'>
                    FALTAS :&nbsp;&nbsp;<span class="badge"><?php echo $s_faltas; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

                    TARDANZAS :&nbsp;&nbsp;<span class="badge"><?php echo $s_tardanzas; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

                    ASISTENCIAS TEMPRANO:&nbsp;&nbsp;<span class="badge"><?php echo $s_asistencias; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

                    SIN MARCAR:&nbsp;&nbsp;<span class="badge"><?php echo $s_sin_marcar; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>

        <!-- modalNuevo -->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Registrar Asistencia (Admin)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">

                                                <label for="">Dni Personal</label>
                                                <input type="text" class="form-control" id="i_dni" placeholder="dni" maxlength="8">
                                                <input type="hidden" id="i_id_usuario"/>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Nombre Personal</label>
                                                <input type="text" class="form-control" id="i_nombre" placeholder="Nombre" disabled="true">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Apellidos Personal</label>
                                                <input type="text" class="form-control" id="i_apellido" placeholder="Apellidos" disabled="true">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fecha</label>
                                                <input type="text" class="form-control" id="i_fecha" value="<?php echo $hoy; ?>" placeholder="Fecha nacimiento">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora</label><br>
                                                <?php
                                                $time = time();
                                                $hora_2 = date("H", $time);
                                                $minuto_2 = date("i", $time);
                                                ?>
                                                <select id="i_hora">
                                                    <?php
                                                    for ($i = 0; $i < 23; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        if ($hora_2 == $i) {
                                                            $var_4 = "selected";
                                                        } else {
                                                            $var_4 = "";
                                                        }
                                                        echo "<option $var_4 value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="i_minuto">
                                                    <?php
                                                    for ($i = 0; $i < 61; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                         if ($minuto_2 == $i) {
                                                            $var_4 = "selected";
                                                        } else {
                                                            $var_4 = "";
                                                        }
                                                        echo "<option $var_4 value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Tipo</label>
                                                <select id="i_tipo" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Estado</label>
                                                <select id="i_estado_i" class="form-control">
                                                    <option value="4">Temprano</option>
                                                    <option value="5">Tarde</option>
                                                    <option value="6">Permiso</option>
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
                        <button type="button" class="btn btn-primary" id="btn_insertar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>  

        <!-- modalEditar-->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Actualizar Asistencia (Admin)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Dni Personal</label>
                                                <input type="hidden" id="m_id_asistencia"/>
                                                <input type="text" class="form-control" id="m_dni" placeholder="Dni" maxlength="8">
                                                <input type="hidden" id="m_id_usuario"/>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Nombre Personal</label>
                                                <input type="text" class="form-control" id="m_nombre" placeholder="Nombre" disabled="true">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Apellidos Personal</label>
                                                <input type="text" class="form-control" id="m_apellido" placeholder="Apellidos" disabled="true">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fecha</label>
                                                <input type="text" class="form-control" id="m_fecha" value="<?php echo $hoy; ?>" placeholder="Fecha nacimiento">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora</label><br>
                                                <select id="m_hora">
                                                    <?php
                                                    for ($i = 0; $i < 23; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="m_minuto">
                                                    <?php
                                                    for ($i = 0; $i < 61; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Tipo</label>
                                                <select id="m_tipo" class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Estado</label>
                                                <select id="m_estado" class="form-control">
                                                    <option value="4">Temprano</option>
                                                    <option value="5">Tarde</option>
                                                    <option value="6">Permiso</option>
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
                        <button type="button" class="btn btn-primary" id="btn_modificar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modalEliminar -->
        <div id="modalEliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">¿Desea eliminar la asistencia?</h4>
                    </div>
                    <div class="modal-body text-center" >
                        <input type="hidden" id="e_id_asistencia" />
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_eliminar">Eliminar</button>
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
    </body>
</html>