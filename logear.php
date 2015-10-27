<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
    if (empty($_POST['usuario']) || empty($_POST['password'])) {
        $error = "Usuario o Contraseña invalidos";
    }
    else
    {
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where password='$password' AND usuario='$usuario'");
        $consulta->execute();
        $filas = $consulta->rowCount();
        if ($filas == 1) {
            $_SESSION['usuario']=$usuario;
            header("location: listadoProductos.php");
        } else {
            $error = "Usuario o Contraseña invalidos";
        }
        $error = $consulta->rowCount();
    }
}
?>
