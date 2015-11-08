<?php
include_once("clases/AccesoDatos.php");
include_once("clases/usuario.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if($request->alta ==1){
    usuario::InsertarElUsuarioParametros($request->usuario,md5($request->password),$request->nombre,
        $request->sexo,$request->celular,$request->rol,$request->sucursal);
}else{
    usuario::ModificarUsuarioParametros($request->usuario,$request->password,$request->nombre,
        $request->sexo,$request->celular,$request->rol,$request->sucursal);
}
echo("La operacion resultó exitosa");
?>
