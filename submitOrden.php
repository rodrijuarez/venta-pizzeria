<?php
include_once("clases/AccesoDatos.php");
include_once("clases/orden.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if($request->alta == 1){
    orden::InsertarLaOrdenParametros($request->domicilioCliente,$request->telefonoCliente,$request->productosOrden,$request->pagaConCambio);
}else{
    orden::ModificarOrdenParametros($request->nroOrden,$request->domicilioCliente,$request->telefonoCliente,json_decode($request->productosOrden,$request->pagaConCambio));
}
?>
