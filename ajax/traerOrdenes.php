<?php
    include_once("../clases/AccesoDatos.php");
    include_once("../clases/orden.php");
    echo json_encode(orden::TraerTodasLasOrdenes());
?>
