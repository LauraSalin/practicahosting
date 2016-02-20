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
			$dbhost = getenv("OPENSHIFT_MYSQL_DB_HOST");
			$dbuser = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
			$dbpassword = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
			$dbname = getenv("OPENSHIFT_APP_NAME");
			
			$this->conexion = mysqli_connect($dbhost, $dbuser, $dbpassword) or die(mysqli_error());
			
			if(!$this->conexion)
			{
				$this->regError();
				
				return 0;
			}
			
			mysqli_set_charset($this->conexion, "UTF8");

			$db = mysqli_select_db($this->conexion, $dbname);
			
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

