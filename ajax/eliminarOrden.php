<?php
    include_once("../clases/AccesoDatos.php");
    include_once("../clases/orden.php");
    $data = json_decode(file_get_contents("php://input"));
    $nro_orden =  $data->nro_orden;
    orden::BorrarOrden($nro_orden);
    echo "success";
?>
