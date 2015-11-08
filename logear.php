<?php
session_start();
include_once("clases/AccesoDatos.php");
$response = new stdClass();
$response->error='';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if (empty($request->usuario) || empty($request->password)) {
    $response->error = "Usuario o Contraseña invalidos";
}
else
{

    $response->success = false;
    $usuario = $request->usuario;
    $password = md5($request->password);
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    $consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where password='$password' AND usuario='$usuario'");
    $consulta->execute();
    $filas = $consulta->rowCount();
    if ($filas == 1) {
        $_SESSION['usuario']=$usuario;
        $response->success = true;
    } else {
        $response->error = "Usuario o Contraseña invalidos";
    }
    $response->error = $consulta->rowCount();
}
echo json_encode($response);
?>
