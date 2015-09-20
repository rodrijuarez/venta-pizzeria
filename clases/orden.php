<?php
include_once("producto.php");
include_once("ordenProducto.php");
class Orden
{
    public $nro_orden;
    public $domicilio_cliente;
    public $telefono_cliente;
    public $productos;
    public $ordenProducto;

    public static function BorrarOrden($nro_orden)
    {
        OrdenProducto::EliminarRelacionConOrdenes($nro_orden);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete
            from ordenes
            WHERE nro_orden=:nro_orden");
        $consulta->bindValue(':nro_orden',$nro_orden, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->rowCount();
    }


    public static function ModificarOrdenParametros($nro_orden,$domicilio_cliente,$telefono_cliente,$productosOrden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update ordenes
            set domicilio_cliente=:domicilio_cliente,
            telefono_cliente=:telefono_cliente
            WHERE nro_orden=:nro_orden");
        $consulta->bindValue(':nro_orden',$nro_orden, PDO::PARAM_INT);
        $consulta->bindValue(':domicilio_cliente',$domicilio_cliente, PDO::PARAM_STR);
        $consulta->bindValue(':telefono_cliente', $telefono_cliente, PDO::PARAM_INT);
        OrdenProducto::EliminarRelacionConOrdenes($nro_orden);
        Orden::CrearRelacionProductosOrden($nro_orden,$productosOrden);
        return $consulta->execute();
    }

    public function mostrarDatos()
    {
        return "Metodo mostrar:".$this->domicilio_cliente."  ".$this->telefono_cliente;
    }

    public static function InsertarLaOrdenParametros($domicilio_cliente,$telefono_cliente,$productosOrden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ordenes (domicilio_cliente,telefono_cliente)values(:domicilio_cliente,:telefono_cliente)");
        $consulta->bindValue(':domicilio_cliente',$domicilio_cliente, PDO::PARAM_STR);
        $consulta->bindValue(':telefono_cliente', $telefono_cliente, PDO::PARAM_INT);
        $consulta->execute();
        $nro_orden = $objetoAccesoDato->RetornarUltimoIdInsertado();
        var_dump($productosOrden);
        Orden::CrearRelacionProductosOrden($nro_orden,$productosOrden);
        return $nro_orden;
    }

    public static function CrearRelacionProductosOrden($nro_orden,$productos){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        foreach ($productos as $producto) {
            $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ordenes_productos (nro_orden,id_producto,cantidad)values(:nro_orden,:id_producto,:cantidad)");
            $consulta->bindValue(':nro_orden',$nro_orden, PDO::PARAM_INT);
            $consulta->bindValue(':id_producto', $producto->id_producto, PDO::PARAM_INT);
            $consulta->bindValue(':cantidad', $producto->cantidad, PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    public static function TraerTodasLasOrdenes()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select ordenes.nro_orden, domicilio_cliente, telefono_cliente, productos.id_producto, productos.descripcion, productos.precio,ordenes_productos.cantidad from ordenes INNER JOIN ordenes_productos ON ordenes_productos.nro_orden = ordenes.nro_orden INNER JOIN productos ON productos.id_producto = ordenes_productos.id_producto");
        $consulta->execute();

        while (($row = $consulta->fetch(PDO::FETCH_ASSOC)) !== false) {
            $orden = new Orden();
            $orden->nro_orden = $row["nro_orden"];
            $orden->domicilio_cliente = $row["domicilio_cliente"];
            $orden->telefono_cliente = $row["telefono_cliente"];
            $producto = new Producto();
            $producto->id_producto = $row["id_producto"];
            $producto->descripcion = $row["descripcion"];
            $producto->precio = $row["precio"];
            if(!isset($result[$orden->nro_orden])){
                $result[$orden->nro_orden]= $orden;
            }
            $result[$orden->nro_orden]->productos[]=$producto;
        }
        return $result;
    }

    public static function TraerUnaOrden($nro_orden)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("select ordenes.nro_orden, domicilio_cliente, telefono_cliente, productos.id_producto, productos.descripcion, productos.precio,ordenes_productos.cantidad from ordenes INNER JOIN ordenes_productos ON ordenes_productos.nro_orden = ordenes.nro_orden INNER JOIN productos ON productos.id_producto = ordenes_productos.id_producto where ordenes.nro_orden = $nro_orden");
        $consulta->execute();
        $result = new Orden();
        while (($row = $consulta->fetch(PDO::FETCH_ASSOC)) !== false) {
            $result->nro_orden = $row["nro_orden"];
            $result->domicilio_cliente = $row["domicilio_cliente"];
            $result->telefono_cliente = $row["telefono_cliente"];
            $producto = new Producto();
            $producto->precio = $row["precio"];
            $producto->descripcion = $row["descripcion"];
            $ordenProducto = new OrdenProducto();
            $ordenProducto->id_producto = $row["id_producto"];
            $ordenProducto->nro_orden = $row["nro_orden"];
            $ordenProducto->cantidad = $row["cantidad"];
            $result->ordenProducto[] = $ordenProducto;
            $result->productos[] = $producto;
        }
        return $result;
    }
}
