<?php
class motivo {

    private $motivo;

    public function __construct() {
        $this->motivo = array();
    }

    public function get_motivo() {
        $sql = "SELECT * from t_motivo where not id_estado=3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->motivo[] = $reg;
        }
        return $this->motivo;
    }
}