<?php
	include_once("../clases/AccesoDatos.php");
	include_once("../clases/producto.php");
	echo json_encode(producto::BorrarProducto($_POST["id"]));
?>