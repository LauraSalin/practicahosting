<html> 
<head> 
<title>Coches</title> 
<meta http-equiv="content-type" content="text/html;
 charset=iso-8859-1"> 
</head> 
<body> 
<h1>Base de datos Automóviles</h1> 
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" />
Introduce el modelo de tu coche:<br> 
<input type="text" name="model"><br> 

<input type="submit" name="buscar" value="Buscar"> 
</form> 
<?php

include_once("Auto.php");
include_once("funcdb.php");

if (!isset($_POST['buscar']))
	echo "A continuación se mostrarán todas las coincidencias encontradas en la Base de Datos <br>";
else
{
  if (($_POST['model']) != "") 
  { 
     $modelo = $_POST['model']; 
	 
	 $Fun = new MySQLDataSource;
	 
	 $conn = $Fun->conectar();
	 
	 if (!$conn)
	 {
		 $Fun->mensajeError();
		 echo "<br>Error de conexión";
	 }
	 
	 $cons = $Fun->ejecutarConsulta("SELECT * FROM automoviles WHERE Modelo like '%".$modelo."%'");
	 
	 if (!$cons)
		echo "<br>Error de consulta";
	 
	 echo "<h3>Coincidencias encontradas: ". mysqli_num_rows($cons)."</h3><br>";
	 $row = $Fun->siguiente();
	 
	 $total = NULL;
		
	 $id = 1;
		
		while($row)
		{
			$total[$id] = new Auto();

			$total[$id]->setId($row->Id);
			$total[$id]->setMarca($row->Marca);
			$total[$id]->setModelo($row->Modelo);
			$total[$id]->setConsumo($row->Consumo);
			$total[$id]->setEmisiones($row->Emisiones);
			
			echo "<br><b>Marca: </b>".$total[$id]->getMarca()." <b>Modelo:</b> ".$total[$id]->getModelo();
			
			$row = $Fun->siguiente();
			
			$id++;
		}
		
		$Fun->desconectar();
	 
  } 
  else
	 echo "Introduzca un modelo a buscar";
}
?> 
</body> 
</html> 