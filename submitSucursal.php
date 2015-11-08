<?php
include_once("clases/AccesoDatos.php");
include_once("clases/sucursal.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if($request->alta ==1){
    sucursal::InsertarLaSucursalParametros($request->direccion,$request->localidad);
}else{
    sucursal::ModificarSucursalParametros($request->idSucursal,$request->direccion,$request->localidad);
}
echo("La operacion resultó exitosa");
?>
