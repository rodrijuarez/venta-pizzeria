<?php
class usuario
{
	public $usuario;
	public $password;
	public $nombre;
	public $sexo;
	public $celular;
	public $rol;
	public $idSucursal;

	public static function BorrarUsuario($usuario)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
			delete
			from usuarios
			WHERE usuario=:usuario");
		$consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
		$consulta->execute();
		return $consulta->rowCount();
	}


	public static function ModificarUsuarioParametros($usuario,$password,$nombre,$sexo,$celular,$rol,$idSucursal)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
			update usuarios
			set password=:password,
			nombre=:nombre,
			sexo=:sexo,
			celular=:celular,
			rol=:rol,
			idSucursal=:sucursal
			WHERE usuario=:usuario");
		$consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
		$consulta->bindValue(':password',$password, PDO::PARAM_STR);
		$consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
		$consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);
		$consulta->bindValue(':celular', $celular, PDO::PARAM_INT);
		$consulta->bindValue(':rol', $rol, PDO::PARAM_STR);
		$consulta->bindValue(':sucursal', $idSucursal, PDO::PARAM_INT);
		return $consulta->execute();
	}

	public static function InsertarElUsuarioParametros($usuario,$password,$nombre,$sexo,$celular,$rol,$idSucursal)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (usuario,password,nombre,sexo,celular,rol,idSucursal) values(:usuario,:password,:nombre,:sexo,:celular,:rol,:sucursal)");
		$consulta->bindValue(':usuario',$usuario, PDO::PARAM_STR);
		$consulta->bindValue(':password', $password, PDO::PARAM_STR);
		$consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
		$consulta->bindValue(':sexo', $sexo, PDO::PARAM_STR);
		$consulta->bindValue(':celular', $celular, PDO::PARAM_INT);
		$consulta->bindValue(':rol', $rol, PDO::PARAM_STR);
		$consulta->bindValue(':sucursal', $idSucursal, PDO::PARAM_INT);
		$consulta->execute();
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}



	public static function TraerTodosLosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select usuario,password,nombre,sexo,celular,rol,idSucursal from usuarios");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
	}

	public static function TraerUnUsuario($usuario)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("select usuario,password,nombre,sexo,celular,rol,idSucursal from usuarios where usuario = '$usuario'");
		$consulta->execute();
		$result= $consulta->fetchObject('usuario');
		return $result;


	}
}
