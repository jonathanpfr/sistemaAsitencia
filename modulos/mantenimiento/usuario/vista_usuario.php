<?php
date_default_timezone_set('America/Lima');
$hoy=  date("Y-m-d");
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
                <h2 class="pull-left title" >Listado de Personal</h2>
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
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Apellidos</th>
                            <th class="text-center">Sexo</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">Cargo</th>
                            <th class="text-center">Sede</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody class="background-tbody">
                        <?php
                        require_once('../../../clases/usuario/class_usuario.php');
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
                        <h4 class="modal-title text-center" id="myModalLabel">Registrar Personal</h4>
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
                                                <label for="">Apellidos</label>
                                                <input type="text" class="form-control" id="i_apellidos" placeholder="Apellidos">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Sexo</label>
                                                <select id="i_sexo" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fecha Naci.</label>
                                                <input type="text" class="form-control" id="i_fecha_naci" value="<?php echo $hoy;?>" placeholder="Fecha nacimiento">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Departamento</label>
                                                 <select id="i_departamento" class="form-control">
                                                </select>
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Telefono</label>
                                                <input type="text" class="form-control" id="i_telefono" placeholder="Telefono" maxlength="9">
                                            </div>
                                        </div>
                                        
                                         <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Dni.</label>
                                                <input type="text" class="form-control" id="i_dni" placeholder="Dni" maxlength="8">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Clave</label>
                                                <input type="text" class="form-control" id="i_clave" placeholder="Clave">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Perfil</label>
                                                 <select id="i_perfil" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Cargo.</label>
                                                 <select id="i_cargo" class="form-control">
                                                </select>
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Sede</label>
                                                <select id="i_sede" class="form-control">
                                                </select>
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Inicio Contrato</label>
                                                <input type="text" class="form-control" id="i_ini_contrato"  value="<?php echo $hoy;?>"  placeholder="Inicio Contrato">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fin Contrato.</label>
                                                <input type="text" class="form-control" id="i_fin_contrato"  value="<?php echo $hoy;?>"  placeholder="Fin contrato">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Tipo Contrato</label>
                                                <select class="form-control" id="i_tipo_contrato">
                                                </select>
                                            </div>
                                             
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-8">
                                                <label for="">Horario</label>
                                                 <select class="form-control" id="i_horario">
                                                     <option value='0'>--Selecione--</option>
                                                </select>
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
                        <h4 class="modal-title text-center" id="myModalLabel">Actualizar Personal</h4>
                    </div>
                    <div class="modal-body">
                        <div class="tab-content" style="margin-top:10px;">
                            <div role="tabpanel" class="tab-pane active">
                                <div class="row">
                                    <form action="" class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <input type="hidden" id="m_id_usuario"/>
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" id="m_nombre" placeholder="Nombre">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Apellidos</label>
                                                <input type="text" class="form-control" id="m_apellidos" placeholder="Apellidos">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Sexo</label>
                                                <select id="m_sexo" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fecha Naci.</label>
                                                <input type="text" class="form-control" id="m_fecha_naci" placeholder="Fecha Nacimiento">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Departamento</label>
                                                 <select id="m_departamento" class="form-control">
                                                </select>
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Telefono</label>
                                                <input type="text" class="form-control" id="m_telefono" placeholder="Telefono" maxlength="9">
                                            </div>
                                        </div>
                                        
                                         <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Dni.</label>
                                                <input type="text" class="form-control" id="m_dni" placeholder="Dni" maxlength="8">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Clave</label>
                                                <input type="text" class="form-control" id="m_clave" placeholder="Clave">
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Perfil</label>
                                                 <select id="m_perfil" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Cargo.</label>
                                                 <select id="m_cargo" class="form-control">
                                                </select>
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Sede</label>
                                                <select id="m_sede" class="form-control">
                                                </select>
                                            </div>
                                             <div class="form-group form-group-sm col-md-4">
                                                <label for="">Inicio Contrato</label>
                                                <input type="text" class="form-control" id="m_ini_contrato" placeholder="Inicio Contrato">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Fin Contrato.</label>
                                                <input type="text" class="form-control" id="m_fin_contrato" placeholder="Fin contrato">
                                            </div>
                                            <div class="form-group form-group-sm col-md-4">
                                                <label for="">Tipo Contrato</label>
                                                <select class="form-control" id="m_tipo_contrato">
                                                </select>
                                            </div>
                                             
                                            
                                        </div>
                                        <div class="row">
                                            <div class="form-group form-group-sm col-md-8">
                                                <label for="">Horario</label>
                                                 <select class="form-control" id="m_horario">
                                                </select>
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
                        <h4 class="modal-title text-center" id="myModalLabel">¿Desea eliminar el Personal?</h4>
                    </div>
                    <div class="modal-body text-center" >
                        <input type="hidden" id="e_id_usuario" />
                        <button type="button" class="btn btn-cancelar" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btn_eliminar">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>





    </body>
</html>