<?php
include_once("../clases/AccesoDatos.php");
include_once("../clases/sucursal.php");
echo json_encode(sucursal::TraerUnaSucursal($_GET["sucursal"]));
?>
