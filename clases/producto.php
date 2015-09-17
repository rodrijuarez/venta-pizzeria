<?php
class producto
{
	public $id_producto;
 	public $descripcion;
  	public $precio;
  	public $stock;

  	public function BorrarProducto($id_producto)
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
	 	
	
	 public function ModificarProductoParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update productos 
				set precio:precio,
				precio=:precio,
				stock=:stock
				WHERE id_producto=:id_producto");
			$consulta->bindValue(':id_producto',$this->id_producto, PDO::PARAM_INT);
			$consulta->bindValue(':descripcion',$this->descripcion, PDO::PARAM_STR);
			$consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
			$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
			return $consulta->execute();
	 }

  	public function mostrarDatos()
	{
	  	return "Metodo mostrar:".$this->descripcion."  ".$this->precio."  ".$this->stock;
	}
	
	 public function InsertarElProductoParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into productos (descripcion,precio,stock)values(:descripcion,:precio,:stock)");
				$consulta->bindValue(':descripcion',$this->descripcion, PDO::PARAM_STR);
				$consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
				$consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 


  	public static function TraerTodosLosProductos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id_producto,descripcion, precio, stock from productos");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

	public static function TraerUnProducto($id_producto) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id_producto, descripcion, precio, stock from productos where id_producto = $id_producto");
			$consulta->execute();
			$result= $consulta->fetchObject('producto');
			return $result;				

			
	}

	

	public static function TraerUnProductoStockParamNombre($id_producto,$stock) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select descripcion, precio, stock from productos  WHERE id_producto=:id_producto AND stock=:stock");
			$consulta->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
			$consulta->bindValue(':stock', $stock, PDO::PARAM_STR);
			$consulta->execute();
			$result= $consulta->fetchObject('producto');
      		return $result;				

			
	}
	
	public static function TraerUnProductoStockParamNombreArray($id_producto,$stock) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select descripcion, precio, stock from productos  WHERE id_producto=:id_producto AND stock=:stock");
			$consulta->execute(array(':id_producto'=> $id_producto,':stock'=> $stock));
			$consulta->execute();
			$result= $consulta->fetchObject('producto');
      		return $result;				

			
	}
}