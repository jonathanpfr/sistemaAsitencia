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

        <script>



//            function fn_asistencia() {
//                alert("asistencia");
////            var asistencias=<?php //echo $_SESSION["s_asistencias"];    ?>;
//             var total_asistencias=<?php //echo $_SESSION["todos_asistencia"];    ?>;
////       
////         newwindow = window.open("grafico_asistencias/index.php?asistencias=" + asistencias+"&total_asistencias="+total_asistencias, 'name', 'height=350,width=650,left=400,padding=700');
////                if (window.focus) {
////                    newwindow.focus();
////                }
//
//            }
        </script>
        <style>
            .manito{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <?php
        //$fec_ini, $fec_fin, $dni
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
            </div>
            <div align="right">
                
                <?php                      
                echo "<a href='reporte/excel/excel.php?fec_ini=$fec_ini&fec_fin=$fec_fin&titulo=$titulo&dni=$dni&i_estado=$get_estado&nombre_estado=$nombre_estado'><img src='../../paquetes/iconos/excel.png'  height='35px' width='35px'/></a>&nbsp;"
                . "<a href='reporte/word/word.php?fec_ini=$fec_ini&fec_fin=$fec_fin&titulo=$titulo&dni=$dni&i_estado=$get_estado&nombre_estado=$nombre_estado'><img src='../../paquetes/iconos/word.png'  height='35px' width='35px'/></a>";
                ?>
            </div>

            <div class="clearfix"></div>

            <div class="panel-tabla">
                <div class="row"  align='center'>
                    <div class="form-group form-group-sm col-md-2">
                        <label for="">Fecha Inicio</label>
                        <input type="text" class="form-control" id="b_fec_ini" value="<?php echo $fec_ini; ?>" placeholder="Fecha ini">
                    </div>
                    <div class="form-group form-group-sm col-md-2">
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
                    <div class="form-group form-group-sm col-md-2">
                        <label for="">Dni</label>
                        <input type="text" class="form-control" id="b_dni" value="<?php echo $dni; ?>" placeholder="Dni" maxlength="8"/>
                    </div>
                    <div class="form-group form-group-sm col-md-1">
                        <label for="">.</label>
                        <button type="button" class="btn btn-success" id="btn_consultar">
                            Buscar
                        </button>
                    </div>
                </div>
                <div class="row"  align='center'>
                    <button type="button" class="btn btn-success" id="btn_asistencia" onclick="fn_asistencia()">
                        % Asistencias
                    </button>
                    <button type="button" class="btn btn-danger" id="btn_faltas" onclick="fn_faltas()">
                        % Faltas
                    </button>
                    <button type="button" class="btn btn-danger" id="btn_marcas" onclick="fn_marcar()">
                        % Sin Marcar
                    </button>
                    <button type="button" class="btn btn-warning" id="btn_tardanzas" onclick="fn_tardanzas()">
                        % Tardanzas
                    </button>
                    <button type="button" class="btn btn-primary" id="btn_todo" onclick="fn_todos()">
                        % Todo
                    </button>
                </div>
                <br><br>


                <table class="table table-bordered table-condensed table-hover">
                    <thead class="background-thead">
                        <tr>
                            <!--<th class="text-center">Ebitar</th>-->
                            <th class="text-center">Nombres y Apellidos</th>
                            <th class="text-center">Dni</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Perfil</th>
                            <th class="text-center" width="110px">Fecha</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Marco desde</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Permiso</th>
                            <th class="text-center">Horarios</th>
                            <!--<th class="text-center">Eliminar</th>-->
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

            <?php
//            $s_faltas = $_SESSION["s_faltas"];
//            $s_tardanzas = $_SESSION["s_tardanzas"];
//            $s_asistencias = $_SESSION["s_asistencias"];
//            $s_sin_marcar = $_SESSION["s_sin_marcar"];
//            $s_todos = $_SESSION["s_todos"];
//            $s_solo_dias = $_SESSION["s_solo_dias"];
//            $todos_marcar = $_SESSION["todos_marcar"];
//            $todos_asistencia = $_SESSION["todos_asistencia"];
//
            echo "<input type='hidden' id='s_faltas' value='$s_faltas' />";
            echo "<input type='hidden' id='s_tardanzas' value='$s_tardanzas' />";
            echo "<input type='hidden' id='s_asistencias' value='$s_asistencias' />";
            echo "<input type='hidden' id='s_sin_marcar' value='$s_sin_marcar' />";
            echo "<input type='hidden' id='s_todos' value='$s_todos' />";
            echo "<input type='hidden' id='s_solo_dias' value='$s_solo_dias' />";
            echo "<input type='hidden' id='todos_marcar' value='$todos_marcar' />";
            echo "<input type='hidden' id='todos_asistencia' value='$todos_asistencia' />";
//
//            echo $_SESSION["s_faltas"] . "->faltas" . "<br>";
//            echo $_SESSION["s_tardanzas"] . "->Tardanzas" . "<br>";
//            echo $_SESSION["s_asistencias"] . "->asistencias" . "<br>";
//            echo $_SESSION["s_sin_marcar"] . "->sin_marcar" . "<br>";
//            echo $_SESSION["s_todos"] . "->todos" . "<br>";
//            echo $_SESSION["s_solo_dias"] . "->todos solo dias" . "<br>";
//            echo $_SESSION["todos_marcar"] . "->todos marcar" . "<br>";
//            echo $_SESSION["todos_asistencia"] . "->todos asistencia" . "<br>";
            ?>

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