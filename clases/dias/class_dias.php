<?php
class dias {

    private $dias;

    public function __construct() {
        $this->dias = array();
    }

    public function get_dias() {
        $sql = "SELECT * from t_dias where not id_estado=3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->dias[] = $reg;
        }
        return $this->dias;
    }
}