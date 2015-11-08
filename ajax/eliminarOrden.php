<?php
include_once("../clases/AccesoDatos.php");
include_once("../clases/orden.php");
include_once("../clases/ordenProducto.php");
$data = json_decode(file_get_contents("php://input"));
$nroOrden =  $data->nroOrden;
orden::BorrarOrden($nroOrden);
echo "success";
?>
