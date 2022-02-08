<?php
@session_start();

//$_SESSION['usuario'] = $_POST['login_username'];
include("../conexion.php");

//if (!isset($_SESSION['username']) && !isset($_SESSION['id_user'])) {
    if (@$idcnx = @mysql_connect("$servidor", "$user_conexion", "$clave")) {
        if (@mysql_select_db("$bd_server_libreria", $idcnx)) {
            $dni = $_POST["login_dni"];
            $clave = $_POST["login_pass"];
            $perfil = $_POST["i_perfil"]; //1 usuario,2supervisor,3 admin
            $sql = "SELECT * from t_usuario where dni='$dni' && clave='$clave' && id_perfil=$perfil LIMIT 1";
            if (@$res = @mysql_query($sql)) {
                if (@mysql_num_rows($res) == 1) {
                    $user = @mysql_fetch_array($res);
                    $_SESSION['username'] = $user['nombre'];
                    $_SESSION['id_user'] = $user['id_usuario'];
                    $_SESSION['id_perfil'] = $user['id_perfil'];

                    if ($user['id_perfil'] == 1) {
                        echo 1;
                    } else if ($user['id_perfil'] == 2) {
                        echo 2;
                    } else {
                        echo 3;
                    }
                } else
                    echo 0;
            } else
                echo 0;
        }

        mysql_close($idcnx);
    } else
        echo 0;
//}
//else {
//    echo "d";
//}
?>