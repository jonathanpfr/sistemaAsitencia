<?php
class sexo {

    private $sexo;

    public function __construct() {
        $this->sexo = array();
    }

    public function get_sexo() {
        $sql = "SELECT * from t_sexo where not id_estado =3;";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->sexo[] = $reg;
        }
        return $this->sexo;
    }
}