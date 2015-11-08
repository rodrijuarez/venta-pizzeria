<?php
include_once("clases/AccesoDatos.php");
include_once("clases/producto.php");

$dir_subida = $_SERVER['DOCUMENT_ROOT'].'/venta-pizzeria/userImages/productos/';
$fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);
$nombreArchivoFinal = $_FILES['imagen']['name'];

if(move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)){
    if($_POST["alta"] ==1){
        producto::InsertarElProductoParametros($_POST["descripcion"],$_POST["precio"],$nombreArchivoFinal);
    }else{
        producto::ModificarProductoParametros($_POST["id"],$_POST["descripcion"],$_POST["precio"],$nombreArchivoFinal);
    }
}
?>
