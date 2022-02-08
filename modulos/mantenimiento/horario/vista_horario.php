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
        <link rel="stylesheet" href="../../../paquetes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../../paquetes/css/general-datatables.css">
        <link rel="stylesheet" href="../../../paquetes/css/style.css">    
        <link rel="stylesheet" href="../../../paquetes/css/jquery-ui.css">
        <script type="text/javascript" src="../../../paquetes/js/jquery-1.11.3.js"></script>
        <script src="../../../paquetes/js/bootstrap.min.js"></script>
        <script src="../../../paquetes/js/jquery.dataTables.min.js"></script>
        <script src="../../../paquetes/js/dataTables.bootstrap.min.js"></script>
        <script src="../../../paquetes/js/jquery.numeric.min.js"></script>
        <script src="../../../paquetes/js/jquery-ui.js"></script>

        <script src="js/funciones.js"></script>

        <script>
            $(document).ready(function () {
                $('#myTable').DataTable({
                    "scrollX": true
                });
            });
        </script>
        <style>
            .manito{
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <div class="col-md-12 col-lg-10 col-lg-offset-1">
            <div class="center principal">
                <h2 class="pull-left title" >Listado de Horarios</h2>
                <div class="divider pull-left" style="margin-right:10px"></div>
                <button type="button" class="btn btn-cancelar" data-toggle="modal" data-target="#modalNuevo" style="margin-top:15px;
                        margin-bottom: 5px;">
                    Nueva Entrada
                </button>

            </div>
            <div class="clearfix"></div>

            <div class="panel-tabla">

                <table id="myTable" class="table table-bordered table-condensed table-hover">
                    <thead class="background-thead">
                        <tr>
                            <th class="text-center">Editar</th>
      <!--                        <th class="text-center">Nombres</th>
                             <th class="text-center">Apellidos</th>
                             <th class="text-center">Perfil</th>-->
                            <th class="text-center">Tipo Contrato</th>
                            <th class="text-center">Dias </th>
                            <th class="text-center">Hora Entrada</th>
                            <th class="text-center">Hora Salida</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="background-tbody">
                        <?php
                        require_once('../../../clases/horario/class_horario.php');
                        require_once('../../../clases/conexion.php');

                        include('controlador/vista.php');
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- modalNuevo -->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Registrar Horario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <!--                                            <div class="form-group form-group-sm col-md-6">
                                                                                            <label for="">Personal</label>
                                                                                            <select id="i_usuario" class="form-control">
                                                                                            </select>
                                                                                        </div>-->
                                            <div class="form-group form-group-sm col-md-6">
                                                <label for="">Tipo Contrato</label>
                                                <select id="i_tipo_contrato" class="form-control">
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-6">
                                                <label for="">Dias</label>
                                                <select id="i_dias" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-6">
                                                <label for="">Estado</label>
                                                <select class="form-control" id="i_estado">
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-12 text-center">
                                                <label for="">Horario Trabajo</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-2"></div>
                                            <div class="form-group form-group-sm col-md-5">

                                                <label for="">Hora entrada</label>
                                                <select id="i_hora_entrada">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="i_minuto_entrada">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora Salida</label>
                                                <select id="i_hora_salida">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="i_minuto_salida">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row" id="i_tiempo_completo2">
                                            <div class="form-group form-group-sm col-md-12 text-center">
                                                <label for="">Horario Refrigerio</label>
                                            </div>


                                        </div>
                                        <div class="row" id="i_tiempo_completo">
                                            <div class="form-group form-group-sm col-md-2"></div>

                                            <div class="form-group form-group-sm col-md-5">
                                                <label for="">Hora entrada</label>
                                                <select id="i_hora_entrada_re">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="i_minuto_entrada_re">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora Salida</label>
                                                <select id="i_hora_salida_re">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="i_minuto_salida_re">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
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
                        <h4 class="modal-title text-center" id="myModalLabel">Actualizar Horario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <!--                                            <div class="form-group form-group-sm col-md-6">
                                                                                            <input type="hidden" id="m_id_horario">
                                                                                            <label for="">Personal</label>
                                                                                            <select id="m_usuario" class="form-control">
                                                                                            </select>
                                                                                        </div>-->
                                            <div class="form-group form-group-sm col-md-6">
                                                <input type="hidden" id="m_id_horario">
                                                <label for="">Tipo Contrato</label>
                                                <select id="m_tipo_contrato" class="form-control">
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-6">
                                                <label for="">Dias</label>
                                                <select id="m_dias" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-6">
                                                <label for="">Estado</label>
                                                <select class="form-control" id="m_estado">
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-12 text-center">
                                                <label for="">Horario Trabajo</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-2"></div>
                                            <div class="form-group form-group-sm col-md-5">

                                                <label for="">Hora entrada</label>
                                                <select id="m_hora_entrada">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="m_minuto_entrada">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora Salida</label>
                                                <select id="m_hora_salida">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="m_minuto_salida">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row" id="m_tiempo_completo2">
                                            <div class="form-group form-group-sm col-md-12 text-center">
                                                <label for="">Horario Refrigerio</label>
                                            </div>


                                        </div>
                                        <div class="row" id="m_tiempo_completo">
                                            <div class="form-group form-group-sm col-md-2"></div>

                                            <div class="form-group form-group-sm col-md-5">
                                                <label for="">Hora entrada</label>
                                                <select id="m_hora_entrada_re">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="m_minuto_entrada_re">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Hora Salida</label>
                                                <select id="m_hora_salida_re">
                                                    <?php
                                                    for ($i = 0; $i < 24; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                :
                                                <select id="m_minuto_salida_re">
                                                    <?php
                                                    for ($i = 0; $i < 60; $i++) {
                                                        if ($i < 10) {
                                                            $i = "0" . $i;
                                                        }
                                                        echo "<option value='$i'>" . $i . "</option>";
                                                    }
                                                    ?>
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
                        <h4 class="modal-title text-center" id="myModalLabel">¿Desea eliminar el Horario?</h4>
                    </div>
                    <div class="modal-body text-center" >
                        <input type="hidden" id="e_id_horario" />
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_eliminar">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>





    </body>
</html>