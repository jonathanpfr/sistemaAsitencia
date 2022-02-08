<?php
session_start();
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_asistencia.xls");

date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title></title>
        <script type="text/javascript" src="../../../../paquetes/js/jquery-1.11.3.js"></script>
        <script src="../../../../paquetes/bootstrap/js/bootstrap.min.js"></script>
        <script language="javascript" type="text/javascript" src="../../../../paquetes/autocomplete/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../../../../paquetes/autocomplete/jquery.min.js"></script>
        <script type="text/javascript" src="../../../../paquetes/autocomplete/jquery-ui.min.js"></script>
        <script src="../../../../paquetes/autocomplete/jquery-ui.js"></script>
        <script src="../../../../paquetes/autocomplete/jquery.autocomplete.js"></script>
        <script src="../../../../paquetes/jquery/jquery.numeric.js"></script>
        <script src="../../../../paquetes/js/jquery.numeric.min.js"></script>
        <script src="js/funciones.js"></script>
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
                <center><h2 class="pull-left title" >Listado de Asistencias <small><?php echo $titulo; ?></small></h2></center>
            </div>
            <div class="clearfix"></div>
            <div class="panel-tabla">
                <table class="table table-bordered table-condensed table-hover" border="1">
                    <thead class="background-thead">
                        <tr style="background-color: yellow">
                            <th class="text-center">Nombres y Apellidos</th>
                            <th class="text-center">Dni</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Perfil</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Marco desde</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Permiso</th>
                        </tr>
                    </thead>
                    <tbody class="background-tbody">
                        <?php
                        require_once('../../../../clases/asistencia/class_asistencia.php');
                        require_once('../../../../clases/permiso/class_permiso.php');
                        require_once('../../../../clases/horario/class_horario.php');
                        require_once('../../../../clases/usuario/class_usuario.php');
                        require_once('../../../../clases/conexion.php');
                        include('../vista.php');
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
    </body>
</html>