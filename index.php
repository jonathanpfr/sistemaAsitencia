<?php
@session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>ASISTENCIA</title>
        <link rel="stylesheet" href="paquetes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="paquetes/css/login.css">


        <script type="text/javascript" src="paquetes/js/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="paquetes/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="paquetes/login/js/functions.ajax.js"></script>
        <script type="text/javascript" src="paquetes/login/js/funciones.js"></script>
        <script src="paquetes/jquery/jquery.numeric.js"></script>
        <!--include alertify.css--> 
        <link rel="stylesheet" href="paquetes/alertifyjs/css/alertify.css">
        <!--include boostrap theme-->  
        <link rel="stylesheet" href="paquetes/alertifyjs/css/themes/bootstrap.css">
        <!--include alertify script--> 
        <script src="paquetes/alertifyjs/alertify.js"></script>

        <script type="text/javascript" src="modulos/login/js/funciones.js"></script>

    </head>
    <body class="valign-wrapper" onselectstart="return false;" ondragstart="return false;">

        <div class="valign container">

            <div class="row center">
                <img src="paquetes/img/logos/logo_login_8.png" class="center-block"  style="width:440px;">
                <br><br><br>

                <div class="col-sm-4 col-sm-offset-4" style="background-color: rgba(0, 0, 0, 0.5);padding:20px 25px; border-radius:25px;">

                    <div class="text-center"><br><br><br>
                        <img src="paquetes/img/perfil/user_usuarios.png" id="cambiar_imagen" class="center-block" alt="logo" style="width:90px; height: 80px;margin-top:-102px;">
                        <br>
                        <div class="form-group form-group-sm">
                            <label for="" style="float:left;" >DNI</label>
                            <input type="text" class="form-control validate" id="login_dni" placeholder="Dni" maxlength="8">
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="" style="float:left;" >Clave</label>
                            <input type="password" class="form-control validate"   onkeypress="return soloLetras(event)" id="login_pass" placeholder="Contraseña">
                            
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="" style="float:left;">Perfil</label>
                            <select class="form-control" id="i_perfil">
                            </select>
                        </div>
                        <div class="checkbox">
                            <!--                            <label style="font-size:15px;">
                                                            <a href="clases/logout.php"> No Puedo Acceder? Clic Aquí</a>
                                                        </label>-->
                            <!--                            <label style="font-size:15px;">
                                                            <a href="clases/logout.php"> Recuperar contraseña</a>
                                                        </label>-->
                        </div>
                        <button type="button" id='login_userbttn' class="btn btn-danger btn-lg" style="background-color: #009b3a" value="Entrar" >Ingresar</button>   
                        <div  id='alertBoxes' align='center' style='text-align:center ; color:#FFF;background-color:#b94a48 ;  border-color: #46b8da; border-radius:9px; font-size:18px ;margin-top:20px; ' >            

                        </div>
                    </div> 
                </div>
            </div>
        </div>



    </body>
</html>
