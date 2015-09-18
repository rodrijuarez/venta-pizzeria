<?php
	include_once("../clases/AccesoDatos.php");
	include_once("../clases/producto.php");
	$data = json_decode(file_get_contents("php://input"));
	$idProducto =  $data->idProducto;
	producto::BorrarProducto($idProducto);
	echo "success";
?>