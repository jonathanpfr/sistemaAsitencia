<?php

//******************************************************************
class sede {

    //private $usuario=array();
    private $sede;

    public function __construct() {
        $this->sede = array();
    }

    public function get_sede() {
        $sql = "SELECT * from t_sede where not  id_estado =3";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->sede[] = $reg;
        }
        return $this->sede;
    }

    public function get_sede_seleccion($id_sede) {
        $sql = "SELECT * from t_sede where not id_estado =3 and id_sede=$id_sede";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->sede[] = $reg;
        }
        return $this->sede;
    }

    public function update_sede($nombre,$estado,$id_usu_mod,$id_sede) {
        $sql = "UPDATE t_sede set nombre_sede='$nombre', id_estado=$estado,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_sede=$id_sede;";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function delete_sede($id_usu_mod,$id_sede) {
        $sql = "UPDATE t_sede set  id_estado=3,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_sede=$id_sede;";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_sede($nombre,$estado,$usu_crea) {
        $sql = "INSERT into t_sede VALUES(null,'$nombre',$estado,$usu_crea,NOW(),$usu_crea,NOW());";
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