<?php

class perfil {

    //private $usuario=array();
    private $perfil;

    public function __construct() {
        $this->perfil = array();
    }

    public function obtener_perfil() {
        $sql = "SELECT * from t_perfil;";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->perfil[] = $reg;
        }
        return $this->perfil;
    }

}
