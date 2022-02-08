<?php

//******************************************************************
class cargo {

    //private $usuario=array();
    private $cargo;

    public function __construct() {
        $this->cargo = array();
    }

    public function get_cargos() {
        $sql = "SELECT * from t_cargo where not  id_estado =3";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->cargo[] = $reg;
        }
        return $this->cargo;
    }

    public function get_cargo_seleccion($id_cargo) {
        $sql = "SELECT * from t_cargo where  id_cargo=$id_cargo";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->cargo[] = $reg;
        }
        return $this->cargo;
    }

    public function update_cargo($nombre,$estado,$id_usu_mod,$id_cargo) {
        $sql = "UPDATE t_cargo set nombre_cargo='$nombre', id_estado=$estado,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_cargo=$id_cargo;";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function delete_cargo($id_usu_mod,$id_cargo) {
        $sql = "UPDATE t_cargo set  id_estado=3,id_usu_mod=$id_usu_mod,fec_mod=NOW() where id_cargo=$id_cargo;";
        $res = mysql_query($sql, Conectar::con());
        if ($res) {
            echo "1";
        } else {
            echo "error: " . mysql_error(), "</br>";
            echo "codigo_error:" . mysql_errno();
        }
    }

    public function add_cargo($nombre,$estado,$usu_crea) {
        $sql = "INSERT into t_cargo VALUES(null,'$nombre',$estado,$usu_crea,NOW(),$usu_crea,NOW());";
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