<?php
class sucursal
{
	public $idSucursal;
	public $direccion;
	public $localidad;

	public static function BorrarSucursal($sucursal)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
			delete
			from sucursales
			WHERE sucursal=:sucursal");
		$consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_STR);
		$consulta->execute();
		return $consulta->rowCount();
	}


	public static function ModificarSucursalParametros($sucursal,$direccion,$localidad)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
			update sucursales
			set direccion=:direccion,
			localidad=:localidad
			WHERE idSucursal=:sucursal");
		$consulta->bindValue(':sucursal',$sucursal, PDO::PARAM_INT);
		$consulta->bindValue(':direccion',$direccion, PDO::PARAM_STR);
		$consulta->bindValue(':localidad', $localidad, PDO::PARAM_INT);
		return $consulta->execute();
	}

	public static function InsertarLaSucursalParametros($direccion,$localidad)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO sucursales (direccion,localidad) values(:direccion,:localidad)");
		$consulta->bindValue(':direccion',$direccion, PDO::PARAM_STR);
		$consulta->bindValue(':localidad', $localidad, PDO::PARAM_INT);
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}



	public static function TraerTodasLasSucursales()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select idSucursal,direccion,localidad from sucursales");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_CLASS, "sucursal");
	}

	public static function TraerUnaSucursal($sucursal)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select idSucursal,direccion,localidad from sucursales where idSucursal = '$sucursal'");
		$consulta->execute();
		$result= $consulta->fetchObject('sucursal');
		return $result;


	}
}
