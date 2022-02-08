<?php
class usuario {

    private $usuario;

    public function __construct() {
        $this->usuario = array();
    }
    
        public function usuarios_fechas_contratos($fecha,$dni) {//like_usuario_no_admin
            if(trim($dni)==""){
                $dni="";
            }else{
                $dni=" and u.dni like '%$dni%' ";
            }
            
        $sql = "SELECT u.nombre,u.apellidos,u.dni,p.nombre_perfil,c.nombre_cargo,u.fecha_inicio_contrato,u.id_usuario,h.id_dias,h.id_tipo_contrato FROM t_usuario u
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_horario h on h.id_horario=u.id_horario
where not u.id_estado=3 and u.fecha_inicio_contrato<='$fecha' and u.fecha_termino_contrato>='$fecha' and not p.id_perfil=3 $dni
ORDER BY u.fecha_inicio_contrato asc;
";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }
    
       public function contar_usuario_dni($dni) {//like_usuario_no_admin
        $sql = "SELECT COUNT(id_usuario)contar,id_usuario from t_usuario where dni='$dni' and id_estado=1 and not id_perfil=3";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }
    
     public function seguridad_clave($id_usuario) {//like_usuario_no_admin
        $sql = "UPDATE t_usuario set clave=(SELECT ROUND(((100000 - 10000) * RAND() + 1), 0)) where id_usuario=$id_usuario";
        $res = mysql_query($sql, Conectar::con());
        if($res){
            echo "1";
        }else{
            echo "Error";
        }
      
    }

    public function like_usuario_no_admin($dni) {//like_usuario_no_admin
        $sql = "SELECT *,CONCAT(dni,'-',nombre,' ',apellidos,'-',nombre_perfil)todo from(
SELECT u.*,p.nombre_perfil 
from t_usuario u
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil 
WHERE not  u.id_perfil=3 and dni like '%$dni%' and not id_estado=3
) as a";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }
    
        public function get_usuario_no_admin() {//like_usuario_no_admin
        $sql = "SELECT u.*,s.nombre_sexo,d.nombre_departamento,c.nombre_cargo,se.nombre_sede,p.nombre_perfil from t_usuario u
INNER JOIN t_sexo s on s.id_sexo=u.id_sexo
INNER JOIN t_departamento d on d.id_departamento=u.id_departamento
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_sede se on se.id_sede=u.id_sede
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
where not u.id_estado=3 and not p.id_perfil=3;
";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }
    
    public function get_usuario() {//like_usuario_no_admin
        $sql = "SELECT u.*,s.nombre_sexo,d.nombre_departamento,c.nombre_cargo,se.nombre_sede,p.nombre_perfil from t_usuario u
INNER JOIN t_sexo s on s.id_sexo=u.id_sexo
INNER JOIN t_departamento d on d.id_departamento=u.id_departamento
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_sede se on se.id_sede=u.id_sede
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
where not u.id_estado=3;
";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }

    public function seleccion_usuario($id_usuario) {
        $sql = "SELECT u.*,s.nombre_sexo,d.nombre_departamento,c.nombre_cargo,se.nombre_sede,p.nombre_perfil,h.* from t_usuario u
INNER JOIN t_horario h on h.id_horario=u.id_horario
INNER JOIN t_sexo s on s.id_sexo=u.id_sexo
INNER JOIN t_departamento d on d.id_departamento=u.id_departamento
INNER JOIN t_cargo c on c.id_cargo=u.id_cargo
INNER JOIN t_sede se on se.id_sede=u.id_sede
INNER JOIN t_perfil p on p.id_perfil=u.id_perfil
where id_usuario=$id_usuario;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }
    
    public function verificar_dni_modificar($dni,$id_usuario) {
        $sql = "SELECT COUNT(dni)contar from t_usuario where not id_estado=3 and dni='$dni' and not id_usuario=$id_usuario;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }
    
    public function verificar_dni_registrar($dni) {
        $sql = "SELECT COUNT(dni)contar from t_usuario where not id_estado=3 and dni='$dni';";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->usuario[] = $reg;
        }
        return $this->usuario;
    }

    public function delete_usuario($id_usu_mod,$id_usuario) {
        $sql = "UPDATE t_usuario set id_usu_mod=$id_usu_mod,fec_mod=NOW(),id_estado=3 
where id_usuario=$id_usuario;";
        $res = mysql_query($sql, Conectar::con());

        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_usuario($id_perfil,$dni,$nombre,$apellidos,$id_sexo,$fecha_nacimiento,$id_departamento,$telefono,$clave,$id_cargo,$id_sede,$fecha_inicio_contrato,$fecha_termino_contrato,$id_usu_crea,$id_estado,$id_tipo_contrato,$id_horario) {
        $sql = "INSERT into t_usuario VALUES(null,$id_perfil,'$dni','$nombre','$apellidos',$id_sexo,'$fecha_nacimiento',$id_departamento,'$telefono','$clave',$id_cargo,$id_sede,'$fecha_inicio_contrato','$fecha_termino_contrato',$id_usu_crea,NOW(),$id_usu_crea,NOW(),$id_estado,$id_tipo_contrato,$id_horario);";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function update_usuario($id_perfil,$dni,$nombre,$apellidos,$id_sexo,$fecha_nacimiento,$id_departamento,$telefono,$clave,$id_cargo,$id_sede,$fecha_inicio_contrato,$fecha_termino_contrato,$id_usu_mod,$id_estado,$id_usuario,$id_tipo_contrato,$id_horario) {
        $sql = "UPDATE t_usuario set id_perfil=$id_perfil,dni='$dni',nombre='$nombre',apellidos='$apellidos',id_sexo=$id_sexo,fecha_nacimiento='$fecha_nacimiento',id_departamento=$id_departamento,telefono='$telefono',clave='$clave',id_cargo=$id_cargo,id_sede=$id_sede,fecha_inicio_contrato='$fecha_inicio_contrato',fecha_termino_contrato='$fecha_termino_contrato',id_usu_mod=$id_usu_mod,fec_mod=NOW(),id_estado=$id_estado,id_tipo_contrato_2=$id_tipo_contrato,id_horario=$id_horario where id_usuario=$id_usuario;";
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