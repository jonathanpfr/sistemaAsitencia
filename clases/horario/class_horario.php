<?php
class horario {

    private $horario;

    public function __construct() {
        $this->horario = array();
    }

    public function get_horario() {//no admin
        $sql = "SELECT h.*,t.nombre_tipo_contrato,d.nombre_dias,tip.nombre_tipo_contrato from t_horario h 
INNER JOIN t_tipo_contrato t on t.id_tipo_contrato=h.id_tipo_contrato
INNER JOIN t_dias d on d.id_dias=h.id_dias
INNER JOIN t_tipo_contrato tip on tip.id_tipo_contrato=h.id_tipo_contrato
where not h.id_estado=3";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->horario[] = $reg;
        }
        return $this->horario;
    }
    
        public function get_horario_tipo_contrato($id_tipo_contrato) {//no admin
        $sql = "SELECT h.*,t.nombre_tipo_contrato,d.nombre_dias from t_horario h 
INNER JOIN t_tipo_contrato t on t.id_tipo_contrato=h.id_tipo_contrato
INNER JOIN t_dias d on d.id_dias=h.id_dias
where not h.id_estado=3 and h.id_tipo_contrato=$id_tipo_contrato;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->horario[] = $reg;
        }
        return $this->horario;
    }

    public function seleccion_horario($id_horario) {//modificado
        $sql = "SELECT h.*,t.nombre_tipo_contrato,d.nombre_dias from t_horario h 
INNER JOIN t_tipo_contrato t on t.id_tipo_contrato=h.id_tipo_contrato
INNER JOIN t_dias d on d.id_dias=h.id_dias
where h.id_horario=$id_horario;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->horario[] = $reg;
        }
        return $this->horario;
    }
    
    
    public function verificar_horario_registrar($id_usuario) {
        $sql = "SELECT COUNT(id_horario)contar from t_horario where not id_estado=3 and id_usuario=$id_usuario;";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->horario[] = $reg;
        }
        return $this->horario;
    }
    
     public function verificar_horario_modificar($id_usuario,$id_horario) {
        $sql = "SELECT COUNT(id_horario)contar from t_horario where not id_estado=3 and id_usuario=$id_usuario and not id_horario=$id_horario;";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->horario[] = $reg;
        }
        return $this->horario;
    }

    public function delete_horario($id_usu_mod,$id_horario) {
        $sql = "UPDATE t_horario set id_estado=3,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_horario=$id_horario;";
        $res = mysql_query($sql, Conectar::con());

        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_horario($id_tipo_contrato,$id_dias,$hora_entrada,$hora_salida,$hora_entrada_re,$hora_salida_re,$id_estado,$id_usu_crea) {
        $sql = "INSERT into t_horario VALUES(null,$id_tipo_contrato,$id_dias,'$hora_entrada','$hora_salida','$hora_entrada_re','$hora_salida_re',$id_estado,$id_usu_crea,NOW(),$id_usu_crea,NOW());";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function update_horario($id_tipo_contrato,$id_dias,$hora_entrada,$hora_salida,$hora_entrada_re,$hora_salida_re,$id_estado,$id_usu_mod,$id_horario) {
        $sql = "UPDATE t_horario set id_tipo_contrato=$id_tipo_contrato,id_dias=$id_dias,hora_entrada='$hora_entrada',hora_salida='$hora_salida',hora_re_entrada='$hora_entrada_re',hora_re_salida='$hora_salida_re',id_estado=$id_estado,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_horario=$id_horario;";
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