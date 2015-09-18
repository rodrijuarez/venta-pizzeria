<?php
include_once("clases/AccesoDatos.php");
include_once("clases/producto.php");
if($_POST["id"] == ""){
	producto::InsertarElProductoParametros($_POST["descripcion"],$_POST["precio"]);
}else{
	producto::ModificarProductoParametros($_POST["id"],$_POST["descripcion"],$_POST["precio"]);
}
header('Location: '."listadoProductos.php");
?>