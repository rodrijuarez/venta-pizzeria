<?php
class OrdenProducto
{
    public $nroOrden;
    public $idProducto;
    public $cantidad;

    public static function EliminarRelacionConOrdenes($nroOrden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ordenes_productos
            WHERE nroOrden=:nroOrden");
        $consulta->bindValue(':nroOrden',$nroOrden, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
    public static function EliminarRelacionConProductos($idProducto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ordenes_productos
            WHERE idProducto=:idProducto");
        $consulta->bindValue(':idProducto',$idProducto, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
}
