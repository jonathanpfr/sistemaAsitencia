<?php
class permiso {

    private $permiso;

    public function __construct() {
        $this->permiso = array();
    }
    
        public function get_permiso_usuario($fecha,$id_usuario) {
        $sql = "SELECT * from t_permiso where fecha_permiso='$fecha' and id_estado=1 and id_usuario=$id_usuario;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->permiso[] = $reg;
        }
        return $this->permiso;
    }

    public function get_permiso() {
        $sql = "SELECT p.*,u.nombre,u.apellidos,pe.nombre_perfil,c.nombre_cargo,m.nombre_motivo from t_permiso p 
INNER JOIN t_usuario u on u.id_usuario=p.id_usuario
INNER JOIN t_perfil pe on pe.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_motivo m on m.id_motivo=p.id_motivo
where not p.id_estado=3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->permiso[] = $reg;
        }
        return $this->permiso;
    }

    public function seleccion_permiso($id_permiso) {
        $sql = "SELECT p.*,u.nombre,u.apellidos,pe.nombre_perfil,c.nombre_cargo,m.nombre_motivo from t_permiso p 
INNER JOIN t_usuario u on u.id_usuario=p.id_usuario
INNER JOIN t_perfil pe on pe.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_motivo m on m.id_motivo=p.id_motivo
where p.id_permiso=$id_permiso;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->permiso[] = $reg;
        }
        return $this->permiso;
    }
    
   

    public function delete_permiso($id_usu_mod,$id_permiso) {
        $sql = "UPDATE t_permiso set id_estado=3,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_permiso=$id_permiso;";
        $res = mysql_query($sql, Conectar::con());

        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_permiso($id_usuario,$id_motivo,$fecha_permiso,$hora_inicio,$hora_fin,$descripcion,$id_estado,$id_usu_cre) {
        $sql = "INSERT into t_permiso VALUES(null,$id_usuario,$id_motivo,'$fecha_permiso','$hora_inicio','$hora_fin','$descripcion',$id_estado,$id_usu_cre,NOW(),$id_usu_cre,NOW());";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function update_permiso($id_motivo,$fecha_permiso,$hora_inicio,$hora_fin,$descripcion,$id_estado,$id_usu_mod,$id_permiso) {
        $sql = "UPDATE t_permiso set id_motivo=$id_motivo,fecha_permiso='$fecha_permiso',hora_inicio='$hora_inicio',hora_fin='$hora_fin',decripcion='$descripcion',id_estado=$id_estado,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_permiso=$id_permiso;";
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