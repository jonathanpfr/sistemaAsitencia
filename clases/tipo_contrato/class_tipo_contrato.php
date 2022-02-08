<?php
class tipo_contrato {

    private $tipo_contrato;

    public function __construct() {
        $this->tipo_contrato = array();
    }

    public function get_tipo_contrato() {
        $sql = "SELECT * from t_tipo_contrato where not id_tipo_contrato=3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->tipo_contrato[] = $reg;
        }
        return $this->tipo_contrato;
    }
}