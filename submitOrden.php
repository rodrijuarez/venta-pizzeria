<?php
include_once("clases/AccesoDatos.php");
include_once("clases/orden.php");
var_dump($_POST);
if($_POST["nroOrden"] == ""){
    orden::InsertarLaOrdenParametros($_POST["domicilioCliente"],$_POST["telefonoCliente"],json_decode($_POST["productosOrden"]));
}else{
    orden::ModificarOrdenParametros($_POST["nroOrden"],$_POST["domicilioCliente"],$_POST["telefonoCliente"],json_decode($_POST["productosOrden"]));
}
header('Location: '."listadoOrdenes.php");
?>
