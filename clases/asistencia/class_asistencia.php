<?php

class asistencia {

    private $asistencia;

    public function __construct() {
        $this->asistencia = array();
    }

    public function generar_fecha($fec_ini, $contador,$id_dias) {
        if($id_dias==1){////1 lun-sab, 2 solo domingo
            $var="not";
        }else{
            $var="";
        }
     //   $sql = "SELECT ADDDATE('$fec_ini',INTERVAL $contador DAY) as datos;";
        $sql="SELECT * from (
SELECT datos ,DATE_FORMAT(datos,'%W')dia from(
SELECT ADDDATE('$fec_ini',INTERVAL $contador DAY) as datos) as da 
) as  img
where  $var dia='Sunday'";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }
    
        public function generar_fecha_dos($fec_ini, $contador) {
           $sql="SELECT ADDDATE('$fec_ini',INTERVAL $contador DAY) as datos";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }
    
      public function verificar_si_es_domingo($fecha) {
           $sql="SELECT DATE_FORMAT('$fecha','%W')dia";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function obtener_total_dia($fecha_inicio, $fecha_fin) {//obtener_total_dia
        $sql = "SELECT DATEDIFF('$fecha_fin','$fecha_inicio')as numero";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }
    
        public function get_asistencia_seleccion($fecha,$dni) {
        $sql = "SELECT a.*,u.nombre,u.apellidos,u.dni,p.nombre_perfil,c.nombre_cargo,t.nombre_tipo FROM t_asistencia a
INNER JOIN t_usuario u on u.id_usuario=a.id_usuario
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_tipo t on t.id_tipo=a.id_tipo
where not a.id_estado=3 and a.fecha_ingreso ='$fecha' and u.dni like '%$dni%'";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }
    
    public function get_asistencia_seleccion_sin_dni($fecha,$id_usuario) {
        $sql = "SELECT a.*,u.nombre,u.apellidos,u.dni,p.nombre_perfil,c.nombre_cargo,t.nombre_tipo FROM t_asistencia a
INNER JOIN t_usuario u on u.id_usuario=a.id_usuario
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_tipo t on t.id_tipo=a.id_tipo
where not a.id_estado=3 and a.fecha_ingreso ='$fecha' and u.id_usuario=$id_usuario";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function get_asistencia($fec_ini, $fec_fin, $dni) {
        if (trim($dni) == "") {
            $dni = "";
        } else {
            $dni = "and u.dni like '%$dni%'";
        }

        $sql = "SELECT a.*,u.nombre,u.apellidos,u.dni,p.nombre_perfil,c.nombre_cargo,t.nombre_tipo FROM t_asistencia a
INNER JOIN t_usuario u on u.id_usuario=a.id_usuario
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_tipo t on t.id_tipo=a.id_tipo
where not a.id_estado=3 and a.fecha_ingreso BETWEEN '$fec_ini' and '$fec_fin' $dni ORDER BY a.fecha_ingreso asc;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

//
    public function buscar_horario($id_usuario) {//obtener_total_dia
        $sql = "SELECT h.*,d.id_dias,d.nombre_dias from t_horario h
INNER JOIN t_usuario u on u.id_horario=h.id_horario
INNER JOIN t_dias d on d.id_dias=h.id_dias
where u.id_usuario=$id_usuario and h.id_estado=1;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function buscar_horario_dia($dia) {
        $sql = "SELECT DATE_FORMAT('$dia','%W')semana ";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function verificar_tipo_dia($id_tipo, $fecha_ingreso, $id_usuario) {
        $sql = "SELECT COUNT(id_asistencia)contar from t_asistencia where id_tipo=$id_tipo and fecha_ingreso='$fecha_ingreso' and id_usuario=$id_usuario and not id_asistencia=3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function verificar_tipo_dia_mod($id_tipo, $fecha_ingreso, $id_usuario, $id_asistencia) {
        $sql = "SELECT COUNT(id_asistencia)contar from t_asistencia where id_tipo=$id_tipo and fecha_ingreso='$fecha_ingreso' and id_usuario=$id_usuario and not id_asistencia=3 and not id_asistencia=$id_asistencia;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function seleccion_asistencia($id_asistencia) {
        $sql = "SELECT a.*,u.nombre,u.apellidos,u.dni,p.nombre_perfil,c.nombre_cargo,t.nombre_tipo FROM t_asistencia a
INNER JOIN t_usuario u on u.id_usuario=a.id_usuario
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_tipo t on t.id_tipo=a.id_tipo
where a.id_asistencia=$id_asistencia";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->asistencia[] = $reg;
        }
        return $this->asistencia;
    }

    public function delete_asistencia($id_usu_mod, $id_asistencia) {
        $sql = "UPDATE t_asistencia set  id_usu_mod=$id_usu_mod,fec_mod=NOW(),id_estado=3 where id_asistencia=$id_asistencia;";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_asistencia_usuario($id_usuario, $ip_marco, $id_usua_crea) {
        $sql = "INSERT into t_asistencia VALUES(null,$id_usuario,now(),now(),'$ip_marco',$id_usua_crea,NOW(),$id_usua_crea,NOW(),1);";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_asistencia_admin($id_usuario, $hora, $fecha_ingreso, $i_tipo, $ip_marco, $id_usua_crea, $id_estado) {
        $sql = "INSERT into t_asistencia VALUES(null,$id_usuario,'$hora','$fecha_ingreso',$i_tipo,'$ip_marco',$id_usua_crea,NOW(),$id_usua_crea,NOW(),$id_estado);";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function update_asistencia_admin($id_usuario, $hora, $fecha_ingreso, $id_tipo, $ip_pc, $id_usu_mod, $id_estado, $id_asistencia) {
        $sql = "UPDATE t_asistencia set id_usuario=$id_usuario,hora='$hora',fecha_ingreso='$fecha_ingreso',id_tipo=$id_tipo, ip_pc='$ip_pc',id_usu_mod=$id_usu_mod,fec_mod=NOW(),id_estado=$id_estado where id_asistencia=$id_asistencia;";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

}

?>