<?php
include_once("../clases/AccesoDatos.php");
include_once("../clases/usuario.php");
echo json_encode(usuario::TraerUnUsuario($_GET["usuario"]));
?>
