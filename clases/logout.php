<?php

session_start();
//$_SESSION['username'] = $user['nombre'];
//$_SESSION['id_user'] = $user['id_usuario'];
//$_SESSION['id_perfil'] = $user['id_perfil'];
//
//$_SESSION["s_faltas"] = 0;
//$_SESSION["s_solo_dias"] = 0;
//$_SESSION["s_tardanzas"] = 0;
//$_SESSION["s_asistencias"] = 0;
//$_SESSION["s_sin_marcar"] = 0;
//$_SESSION["todos_marcar"] = 0;
//$_SESSION["todos_asistencia"] = 0;
//$_SESSION["s_todos"] = 0;

unset($_SESSION['s_faltas']);
unset($_SESSION['s_solo_dias']);
unset($_SESSION['s_tardanzas']);
unset($_SESSION['s_asistencias']);
unset($_SESSION['s_sin_marcar']);
unset($_SESSION['todos_marcar']);
unset($_SESSION['todos_asistencia']);
unset($_SESSION['s_todos']);

unset($_SESSION['username']);
unset($_SESSION['id_user']);
unset($_SESSION['id_perfil']);
//session_destroy();

header("Location: ../index.php");
//echo "<script>alert('".$_SESSION['usuario']."-".$_SESSION['userID']."');</script>";
?>