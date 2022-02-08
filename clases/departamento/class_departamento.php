<?php
class departamento {

    private $departamento;

    public function __construct() {
        $this->departamento = array();
    }

    public function get_departamento() {
        $sql = "SELECT * from t_departamento where not id_estado =3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->departamento[] = $reg;
        }
        return $this->departamento;
    }
}