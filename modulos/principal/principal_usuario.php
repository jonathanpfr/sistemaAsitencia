<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="../../paquetes/img/electroclima.png" type='image/png'>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>ASISTENCIA</title>
        <link href="../../paquetes/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../paquetes/css/principal.css" rel="stylesheet" />
        <script src="../../paquetes/bootstrap/js/jquery-2.1.3.min.js"></script>
        <script src="../../paquetes/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../paquetes/login/js/functions.ajax.js"></script>
        <script src="../../paquetes/login/js/funciones.js"></script>
        <script src="js/validar_sesion.js"></script>
        <!--Css Unico para principal.php-->
        <style>
            body{
                overflow-y:hidden;
            }
            .modal-header{
                background-color: #337ab7;
                color: white;
            }

            .btn-cancelar{
                background-color:#ffc107 !important ;
                color:white;
            }

            .btn-cancelar:hover{
                color:white;
            }
            .dropdown .dropdown-menu>li>a{
                padding:3px 11px;   
            }



            .navbar-nav>li>a:focus,  .navbar-nav>li>a:hover {
                color: white;
                background-color: rgba(0, 0, 0, 0.1); 
            }

            .nav .open>a, .nav .open>a:focus, .nav .open>a:hover{
                color: white;
                background-color: rgba(0, 0, 0, 0.1);
            }


        </style>
    </head>
    <body>
        <div id="validar_session"></div>
    <center><h5>SISTEMA DE CONTROL DE ASISTENCIA</h5></center>
    <div id="post-detailsxxx">
        <!--class="navbar bg-primary"-->
        <nav  role="navigation" style="z-index:1;background-color: red;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" style="background:white; "  data-target="#acolapsar">
                        <span class="sr-only"> PROYECTO</span>
                        <span class="icon-bar" style="background:#337ab7;"></span>
                        <span class="icon-bar" style="background:#337ab7;"></span>
                        <span class="icon-bar" style="background:#337ab7;"></span>
                    </button>
                    <div class="navbar-brand " style="padding:0px;">
                        <img src="../../paquetes/img/logos/logo_menu_3.png" width="200" height=""><!-- CAMBIAR EL LOGO -->
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="acolapsar">
                    <ul class="nav navbar-nav">
<!--                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MANTENIMIENTO <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li rel="../mantenimiento/cargos/vista_cargos.php"><a href="#">CARGOS</a></li>
                                <li rel="../mantenimiento/sedes/vista_sedes.php"><a href="#">SEDES</a></li>
                                <li rel="../mantenimiento/usuario/vista_usuario.php"><a href="#">USUARIOS</a></li>
                                <li rel="../mantenimiento/horario/vista_horario.php"><a href="#">HORARIOS</a></li>
                                 <li rel="../mantenimiento/permiso/vista_permiso.php"><a href="#">PERMISOS</a></li>
                            </ul>
                        </li>  -->
<!--                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ASISTENCIA<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                
                                <li rel="../asistencia_admin/vista_asistencia.php"><a href="#">ASISTENCIAS</a></li>
                                <li rel="../compras/guia_remision_proveedor/vista_guia_remision.php"><a href="#">GUIA REMISION</a></li>
                                <li rel="../compras/comprobante/vista_comprobante.php"><a href="#">COMPROBANTE</a></li>
                            </ul>
                        </li> -->

                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ASISTENCIA USUARIO<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li rel="../asistencia_usuario/vista_asistencia.php"><a href="#">ASISTENCIA USUARIO</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">HORARIO<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li rel="../horario/vista_horario.php"><a href="#">MI HORARIO</a></li>
                            </ul>
                        </li>
                        <li><a href="../../clases/logout.php">SALIR</a></li>
<!--                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">REPORTES<span class="caret"></span></a>
                           <ul class="dropdown-menu" role="menu">
                               
                               <li rel="../asistencia_usuario/vista_asistencia.php"><a href="#">ASISTENCIA USUARIO</a></li>
                               <li rel="../compras/guia_remision_proveedor/vista_guia_remision.php"><a href="#">GUIA REMISION</a></li>
                               <li rel="../compras/comprobante/vista_comprobante.php"><a href="#">COMPROBANTE</a></li>
                           </ul>
                       </li> -->

<!--                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">VENTAS<span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li rel="../../modulos/ventas/guia_remision/vista_guia_remision.php"><a href="#">GUIA REMISION</a></li>
        <li rel="../../modulos/ventas/comprobante/vista_comprobante.php"><a href="#">COMPROBANTE</a></li>
    </ul>
</li> 
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">NUMERACION<span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li rel="../../modulos/mantenimiento/numeracion/numeracion_guia_remision_venta/vista_numeracion_guia_venta.php"><a href="#">GUIA REMISION</a></li>
        <li rel="../../modulos/mantenimiento/numeracion/numeracion_comprobante_venta/vista_numeracion_comprobante_venta.php"><a href="#">COMPROBANTE</a></li>
    </ul>
</li>
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ALMACEN<span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li rel="../almacen/almacen_principal/vista_almacen_principal.php"><a href="#">ALMACEN PRINCIPAL</a></li>
    </ul>
</li>
<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">PEDIDOS<span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
        <li rel="../pedidos/vista_pedidos_almacen.php"><a href="#">PEDIDOS</a></li>
    </ul>
</li>-->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-tasks"></span> </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="../../clases/logout.php">CERRAR SESION</a></li>
                            </ul>
                        </li>      
                    </ul>
                </div>

            </div>
        </nav>
    </div>

















    <a id="efecto" class="toggle-visibility" data-target="#post-detailsxxx" data-toggle="tab" href="">
        <!--<div class="btn-group pull-right" role="group">-->
        <div class="divider"></div>
        <button id="efec" type="button" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-sort"></span></button>
        <!--</div>-->
        <!--<a id="efec" class="btn btn-warning pull-right" role="button"><span class="glyphicon glyphicon-sort"></span></a>-->
    </a>

    <div  class="tab-content1">

        <ul id="pageTab" class="nav nav-tabs">

            <li onClick="#Bar" class="active"><a class="" href="#page1" ><span class="glyphicon glyphicon-home" style="margin-right:5px"></span>INICIO</a></li>

        </ul>



        <div id="pageTabContent" class="tab-content" >
            <div class="tab-pane active" id="page1" >

                <iframe class="embed-responsive-item" width="100%" height="100%" frameborder="0" scrolling="yes" id="iframe" src="inicio.php"></iframe>
            </div>

        </div>


    </div>





    <script src="js/funciones.js" type="text/javascript"></script>
    <script>
                $(document).ready(function () {

                });
                function toggler(divId) {
                    $("#efec" + divId).toggle();
                }

                $(document).ready(function () {
                    $("#efec ").after("");

                    /* Button which shows and hides div with a id of "post-details" */
                    $(".toggle-visibility").click(function () {

                        var target_selector = $(this).attr('data-target');
                        var $target = $(target_selector);

                        if ($target.is(':hidden'))
                        {
                            $target.show("slow");
                            $(".tab-pane").css({"top": "115px"});


                            $("#efec ").val()("<img class='img-responsive' src='img/arriba.png' height='10' width='40'>");


                        } else
                        {
                            $target.hide("slow");

                            $(".tab-pane").css({"top": "45px"});
                            var d = "MAXIMIZAR"

                            $("#efec ").val()("<img class='img-responsive' src='img/abajo.png' height='10' width='40'>");
                        }

                        console.log($target.is(':visible'));


                    });

                    /* button which creates a new paragraph <p>New row added</p> */
                    $(".btn-add-new-line").click(function () {

                        var target_selector = $(this).attr('data-target');
                        var $target = $(target_selector);

                        if ($target.is(':visible'))
                        {
                            var newRow = "New row added";

                            $target.append("<p>" + newRow + "</p>");

                            console.log("row added");

                            var i = $target.text().length;
                            console.log("There is " + i + " characters in div");

                            var p = $target.html().length;
                            console.log("String length of #post-details is: " + p + " ");
                        }
                    });

                });
    </script>

</body>


</html>