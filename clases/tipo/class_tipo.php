<?php
class tipo {

    private $tipo;

    public function __construct() {
        $this->tipo = array();
    }

    public function get_tipo() {
        $sql = "SELECT * from t_tipo where not id_estado=3";
        $res = mysql_query($sql, Conectar::con());

        while ($reg = mysql_fetch_assoc($res)) {
            $this->tipo[] = $reg;
        }
        return $this->tipo;
    }
     public function obtener_tipo($fecha,$id_usuario) {
        $sql = "SELECT max(id_tipo)maximo from t_asistencia where not id_estado=3 and fecha_ingreso='$fecha' and id_usuario=$id_usuario;";
        $res = mysql_query($sql, Conectar::con());
        while ($reg = mysql_fetch_assoc($res)) {
            $this->tipo[] = $reg;
        }
        return $this->tipo;
    }
}