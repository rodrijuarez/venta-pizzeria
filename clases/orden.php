<?php
include_once("producto.php");
include_once("ordenProducto.php");
class Orden
{
    public $nroOrden;
    public $domicilioCliente;
    public $telefonoCliente;
    public $productos;
    public $ordenProducto;
    public $pagaConCambio;

    public static function BorrarOrden($nroOrden)
    {
        OrdenProducto::EliminarRelacionConOrdenes($nroOrden);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ordenes
            WHERE nroOrden=:nroOrden");
        $consulta->bindValue(':nroOrden',$nroOrden, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }


    public static function ModificarOrdenParametros($nroOrden,$domicilioCliente,$telefonoCliente,$productosOrden,$pagaConCambio)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update ordenes
            set domicilioCliente=:domicilioCliente,
            telefonoCliente=:telefonoCliente,
            pagaConCambio=:pagaConCambio
            WHERE nroOrden=:nroOrden");
        $consulta->bindValue(':nroOrden',$nroOrden, PDO::PARAM_INT);
        $consulta->bindValue(':domicilioCliente',$domicilioCliente, PDO::PARAM_STR);
        $consulta->bindValue(':telefonoCliente', $telefonoCliente, PDO::PARAM_INT);
        $consulta->bindValue(':pagaConCambio', $pagaConCambio, PDO::PARAM_BOOL);
        OrdenProducto::EliminarRelacionConOrdenes($nroOrden);
        Orden::CrearRelacionProductosOrden($nroOrden,$productosOrden);
        return $consulta->execute();
    }

    public function mostrarDatos()
    {
        return "Metodo mostrar:".$this->domicilioCliente."  ".$this->telefonoCliente;
    }

    public static function InsertarLaOrdenParametros($domicilioCliente,$telefonoCliente,$productosOrden,$pagaConCambio)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ordenes (domicilioCliente,telefonoCliente,pagaConCambio)values(:domicilioCliente,:telefonoCliente,:pagaConCambio)");
        $consulta->bindValue(':domicilioCliente',$domicilioCliente, PDO::PARAM_STR);
        $consulta->bindValue(':telefonoCliente', $telefonoCliente, PDO::PARAM_INT);
        $consulta->bindValue(':pagaConCambio', $pagaConCambio, PDO::PARAM_INT);
        $consulta->execute();
        $nroOrden = $objetoAccesoDato->RetornarUltimoIdInsertado();
        Orden::CrearRelacionProductosOrden($nroOrden,$productosOrden);
        return $nroOrden;
    }

    public static function CrearRelacionProductosOrden($nroOrden,$productos){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        foreach ($productos as $producto) {
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ordenes_productos (nroOrden,idProducto,cantidad)values(:nroOrden,:idProducto,:cantidad)");
            $consulta->bindValue(':nroOrden',$nroOrden, PDO::PARAM_INT);
            $consulta->bindValue(':idProducto', $producto->idProducto, PDO::PARAM_INT);
            $consulta->bindValue(':cantidad', $producto->cantidad, PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    public static function TraerTodasLasOrdenes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select ordenes.nroOrden, domicilioCliente, telefonoCliente,pagaConCambio, productos.idProducto, productos.descripcion, productos.precio,ordenes_productos.cantidad from ordenes INNER JOIN ordenes_productos ON ordenes_productos.nroOrden = ordenes.nroOrden INNER JOIN productos ON productos.idProducto = ordenes_productos.idProducto");
        $consulta->execute();

        while (($row = $consulta->fetch(PDO::FETCH_ASSOC)) !== false) {
            $orden = new Orden();
            $orden->nroOrden = $row["nroOrden"];
            $orden->domicilioCliente = $row["domicilioCliente"];
            $orden->telefonoCliente = $row["telefonoCliente"];
            $orden->pagaConCambio = $row["pagaConCambio"];
            $producto = new Producto();
            $producto->idProducto = $row["idProducto"];
            $producto->descripcion = $row["descripcion"];
            $producto->precio = $row["precio"];
            if(!isset($result[$orden->nroOrden])){
                $result[$orden->nroOrden]= $orden;
            }
            $result[$orden->nroOrden]->productos[]=$producto;
        }
        return $result;
    }

    public static function TraerUnaOrden($nroOrden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select ordenes.nroOrden, domicilioCliente, telefonoCliente,pagaConCambio, productos.idProducto, productos.descripcion, productos.precio,ordenes_productos.cantidad from ordenes INNER JOIN ordenes_productos ON ordenes_productos.nroOrden = ordenes.nroOrden INNER JOIN productos ON productos.idProducto = ordenes_productos.idProducto where ordenes.nroOrden = $nroOrden");
        $consulta->execute();
        $result = new Orden();
        while (($row = $consulta->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result->nroOrden = $row["nroOrden"];
            $result->domicilioCliente = $row["domicilioCliente"];
            $result->telefonoCliente = $row["telefonoCliente"];
            $result->pagaConCambio = $row["pagaConCambio"];
            $producto = new Producto();
            $producto->precio = $row["precio"];
            $producto->descripcion = $row["descripcion"];
            $ordenProducto = new OrdenProducto();
            $ordenProducto->idProducto = $row["idProducto"];
            $ordenProducto->nroOrden = $row["nroOrden"];
            $ordenProducto->cantidad = $row["cantidad"];
            $result->ordenProducto[] = $ordenProducto;
            $result->productos[] = $producto;
        }
        return $result;
    }
}
