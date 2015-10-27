<?php
include_once("../clases/AccesoDatos.php");
include_once("../clases/usuario.php");
$data = json_decode(file_get_contents("php://input"));
$usuario =  $data->usuario;
usuario::BorrarUsuario($usuario);
echo "success";
?>
