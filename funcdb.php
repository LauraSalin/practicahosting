<?php

class MySQLDataSource
{
	private $conexion;
	private $querys;
	private $dev;

	function conectar()
	{
		if(!$this->conexion)
		{
			$host = "127.0.0.1";
			$usuario = "virtualguide";
			$password = "ImperiuM";
			
			$this->conexion = mysqli_connect($host, $usuario, $password) or die(mysqli_error());
			
			if(!$this->conexion)
			{
				$this->regError();
				
				return 0;
			}
			
			mysqli_set_charset($this->conexion, "UTF8");

			$db = mysqli_select_db($this->conexion, "automoviles");
			
			if(!$db)
			{
				$this->regError();
								
				return 0;
			}
		}
		
		return 1;
	}
	
	
	function desconectar()
	{
		mysqli_close($this->conexion);
	}


	function ejecutarConsulta($consulta)
	{	
		$this->querys = mysqli_query($this->conexion, $consulta);
		
		$fail = mysql_error();

		if($fail)
		{
			$this->regError();
			
			return 0;
		}

		return $this->querys;
	}


	function siguiente()
	{
		$this->dev = mysqli_fetch_object($this->querys);

		return $this->dev;
	}


	function mensajeError()
	{		
	/*	if($this->codigo_error == 1)
		{
			return "El id ya existe en la Base de Datos";
		}

		return "Se ha producido un error en la Base de Datos y ha sido registrado. (Consultar detalles en el fichero generado: 'Errors.txt')";
	*/}

	
	private function regError()
	{
		/*$fallo = mysql_error();
		$fp = fopen("Log_Errores.txt","a");
		fwrite($fp,"[" . date("d/m/Y H:i:s") . "] " . $fallo . "\n");
		fclose($fp);
	*/}
}

?>

