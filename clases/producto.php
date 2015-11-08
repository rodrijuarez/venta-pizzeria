<?php
class producto
{
	public $idProducto;
	public $descripcion;
	public $precio;
	public $imagen;

	public static function BorrarProducto($idProducto)
	{
		OrdenProducto::EliminarRelacionConProductos($idProducto);
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
			delete
			from productos
			WHERE idProducto=:idProducto");
		$consulta->bindValue(':idProducto',$idProducto, PDO::PARAM_INT);
		$consulta->execute();
		return $consulta->rowCount();
	}


	public static function ModificarProductoParametros($idProducto,$descripcion,$precio,$imagen)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
			update productos
			set descripcion=:descripcion,
			precio=:precio,
			imagen=:imagen
			WHERE idProducto=:idProducto");
		$consulta->bindValue(':idProducto',$idProducto, PDO::PARAM_INT);
		$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
		$consulta->bindValue(':imagen', $imagen, PDO::PARAM_STR);
		return $consulta->execute();
	}

	public function mostrarDatos()
	{
		return "Metodo mostrar:".$this->descripcion."  ".$this->precio;
	}

	public static function InsertarElProductoParametros($descripcion,$precio,$imagen)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into productos (descripcion,precio,imagen) values(:descripcion,:precio,:imagen)");
		$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
		$consulta->bindValue(':imagen', $imagen, PDO::PARAM_STR);
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}



	public static function TraerTodosLosProductos()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select idProducto,descripcion, precio,imagen from productos");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");
	}

	public static function TraerUnProducto($idProducto)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select idProducto, descripcion, precio from productos where idProducto = $idProducto");
		$consulta->execute();
		$result= $consulta->fetchObject('producto');
		return $result;


	}



	public static function TraerUnProductoStockParamNombre($idProducto,$stock)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select descripcion, precio from productos  WHERE idProducto=:idProducto");
		$consulta->bindValue(':idProducto', $idProducto, PDO::PARAM_INT);
		$consulta->execute();
		$result= $consulta->fetchObject('producto');
		return $result;


	}

	public static function TraerUnProductoStockParamNombreArray($idProducto,$stock)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select descripcion, precio from productos  WHERE idProducto=:idProducto");
		$consulta->execute(array(':idProducto'=> $idProducto));
		$consulta->execute();
		$result= $consulta->fetchObject('producto');
		return $result;


	}
}
