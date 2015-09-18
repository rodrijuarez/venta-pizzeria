<?php
class producto
{
	public $id_producto;
 	public $descripcion;
  	public $precio;

  	public static function BorrarProducto($id_producto)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from productos 				
				WHERE id_producto=:id_producto");	
				$consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }
	 	
	
	 public static function ModificarProductoParametros($id_producto,$descripcion,$precio)
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update productos 
				set descripcion=:descripcion,
				precio=:precio
				WHERE id_producto=:id_producto");
			$consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
			$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
			$consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
			return $consulta->execute();
	 }

  	public function mostrarDatos()
	{
	  	return "Metodo mostrar:".$this->descripcion."  ".$this->precio;
	}
	
	 public static function InsertarElProductoParametros($descripcion,$precio)
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into productos (descripcion,precio)values(:descripcion,:precio)");
				$consulta->bindValue(':descripcion',$descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 


  	public static function TraerTodosLosProductos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id_producto,descripcion, precio from productos");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

	public static function TraerUnProducto($id_producto) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id_producto, descripcion, precio from productos where id_producto = $id_producto");
			$consulta->execute();
			$result= $consulta->fetchObject('producto');
			return $result;				

			
	}

	

	public static function TraerUnProductoStockParamNombre($id_producto,$stock) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select descripcion, precio from productos  WHERE id_producto=:id_producto");
			$consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
			$consulta->execute();
			$result= $consulta->fetchObject('producto');
      		return $result;				

			
	}
	
	public static function TraerUnProductoStockParamNombreArray($id_producto,$stock) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select descripcion, precio from productos  WHERE id_producto=:id_producto");
			$consulta->execute(array(':id_producto'=> $id_producto));
			$consulta->execute();
			$result= $consulta->fetchObject('producto');
      		return $result;				

			
	}
}