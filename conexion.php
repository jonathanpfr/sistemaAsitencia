<?php
/* para la conexion del login */
$servidor="localhost";
$user_conexion='root';
$clave='emergepassw0rd$';
$bd_server_libreria='bd_asistencia';
/* termina la conexion login*/
class Conectar 
{
	public static function con()
	{
		$conexion=mysql_connect("localhost","root","emergepassw0rd$");
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db("bd_asistencia");
		return $conexion;
	}
}
?>