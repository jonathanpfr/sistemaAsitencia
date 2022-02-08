<!DOCTYPE html>
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
                <h2 class="pull-left title" >Listado de Cargos</h2>
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
                            <th class="text-center">EDITAR</th>
                            <th class="text-center">CARGO</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody class="background-tbody">
                        <?php
                        require_once('../../../clases/cargo/class_cargo.php');
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
                        <h4 class="modal-title text-center" id="myModalLabel">Registrar Cargo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" id="i_nombre" placeholder="Nombre">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Estado</label>
                                                <select class="form-control" id="i_estado">
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
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
                        <h4 class="modal-title text-center" id="myModalLabel">Actualizar Cargo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Nombre</label>
                                                <input type="hidden" id="m_id_cargo">
                                                <input type="text" class="form-control" id="m_nombre" placeholder="Nombre">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Estado</label>
                                                <select class="form-control" id="m_estado">
                                                    <option value="1">Activo</option>
                                                    <option value="2">Inactivo</option>
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
                        <button type="button" class="btn btn-primary" id="btn_actualizar">Guardar</button>
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
                        <h4 class="modal-title text-center" id="myModalLabel">¿Desea eliminar el cargo?</h4>
                    </div>
                    <div class="modal-body text-center" >
                        <input type="hidden" id="e_id_cargo" />
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_eliminar">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>





    </body>
</html>