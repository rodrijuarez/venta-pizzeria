<?php
include_once("clases/AccesoDatos.php");
include_once("clases/usuario.php");

if($_POST["alta"] == "true"){
    usuario::InsertarElUsuarioParametros($_POST["usuario"],$_POST["password"],$_POST["nombre"],
        $_POST["sexo"],$_POST["celular"],$_POST["rol"],$_POST["sucursal"]);
}else{
    usuario::ModificarUsuarioParametros($_POST["usuario"],$_POST["password"],$_POST["nombre"],
        $_POST["sexo"],$_POST["celular"],$_POST["rol"],$_POST["sucursal"]);
}
header('Location: '."listadoUsuarios.php");
?>
