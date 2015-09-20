<?php
include_once("clases/AccesoDatos.php");
include_once("clases/orden.php");
if($_POST["nro_orden"] == ""){
    producto::InsertarLaOrdenParametros($_POST["domicilio_cliente"],$_POST["telefono_cliente"],$_POST["productos"]);
}else{
    producto::ModificarOrdenParametros($_POST["nro_orden"],$_POST["domicilio_cliente"],$_POST["telefono_cliente"],$_POST["productos"]);
}
header('Location: '."listadoOrdenes.php");
?>
