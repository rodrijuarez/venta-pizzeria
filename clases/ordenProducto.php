<?php
class OrdenProducto
{
    public $nro_orden;
    public $id_producto;
    public $cantidad;

    public static function EliminarRelacionConOrdenes($nro_orden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ordenes_productos
            WHERE nro_orden=:nro_orden");
        $consulta->bindValue(':nro_orden',$nro_orden, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
    public static function EliminarRelacionConProductos($id_producto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ordenes_productos
            WHERE id_producto=:id_producto");
        $consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }
}
