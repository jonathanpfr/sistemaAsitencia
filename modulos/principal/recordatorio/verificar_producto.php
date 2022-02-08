<?php
require_once '../../../clases/producto_creado/class_producto_creado.php';
require_once '../../../clases/conexion.php';
require_once '../../../clases/producto/class_producto.php';
require_once("../../../clases/ventas/titulos/class_titulos.php");

$clas = new producto();
$reg = $clas->get_producto();
for ($i = 0; $i < count($reg); $i++) {
    $comnre_producto = $reg[$i]["nombre"];
    $codigo_barras = $reg[$i]["cod_barras"];
    $nombre_unidad_medida = $reg[$i]["nombre_unidad_medida"];
    $id_titulo = $reg[$i]["id_producto"];
    $entrada = 0;
    $salida = 0;
    $tra = new titulo();
    $reg1 = $tra->get_calcular_stock_modificado_lazaro($id_titulo);
    @$stock_actual = $reg1[0]["stock"];
    if ($stock_actual == "" || $stock_actual == null) {
        $stock_actual = 0;
    }
    $clase_productos = new titulo();
    $rega = $clase_productos->obtener_solo_salidas($id_titulo);
    @$productos_salidas = $rega[0]["cantidad_salida"];
    if ($productos_salidas == "" || $productos_salidas == null) {
        $productos_salidas = 0;
    }
    @$salidas_anuladas = $rega[0]["cantidad_entrada"];
    if ($salidas_anuladas == "" || $salidas_anuladas == null) {
        $salidas_anuladas = 0;
    }

    $producto_solicitados = $productos_salidas - $salidas_anuladas;

    $entrada = $stock_actual + $producto_solicitados;

    if($stock_actual<=0){
        echo ("<font color='#ff0000'> Producto : $comnre_producto con codigo :$codigo_barras no tiene stock </font><br>");//id_cliente en un hidden   
    }else if($stock_actual>0&&$stock_actual<=10){
         echo ("<font color='orange'> Producto : $comnre_producto con codigo :$codigo_barras tiene solo $stock_actual cantidades </font><br>");//id_cliente en un hidden   
    }

    }

?>
