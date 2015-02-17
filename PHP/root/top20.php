<!DOCTYPE html PUBLIC "-//W3C//DTD XTHML 1.0 Strict//ES" "http://www.w3org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3org.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=[b]UTF-8[/b]" />
<title>SYLKA...Acceso Asesores</title>
<link href='http://fonts.googleapis.com/css?family=Comfortaa:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/estilos2.css">
</head>
<body>
<BODY BGCOLOR="#F7F8E0">
	<!-- Contenido del documento -->
	<h1>
	<P ALIGN=center>Pl&aacute;sticos Sylka SA de CV
	</P>
	</h1>
	<h2>
	<P ALIGN=center>Panel Asesores
	</P>
	</h2>
	<hr />
	<form action="top20.php" method="post"> 
	<p>Escriba el Rap del cliente: <input type="text" name="RAP" value="<?php echo $_POST['RAP'];?>" size="1"></p>
	<p>Escriba la cantidad TOP que desea: <input type="text" name="contador" value="<?php echo $_POST['contador'];?>" size="1"></p>
	<p><input type="date" name="idaytime" value="<?php echo $_POST['idaytime'];?>">Seleccione el inicio del Periodo</p>
	<p><input type="date" name="fdaytime" value="<?php echo $_POST['fdaytime'];?>">Seleccione el final del Periodo</p>
	<p><input type="submit" name="top" value="Mostrar consulta" /></p>
	<?php

	//Incluimos la sesión
	session_start();
	//Guardamos el usuario de la sesion dentro de una variable		
	$testU = $_SESSION["usuario"];
	if ($testU == "") {
		# code...
			header("Location: inicio.php"); 
	}
	
	include_once "conexion.php"; //Conectamos a la base de datos

	if(isset($_REQUEST['top']))
	{
		//Capturamos los datos de la consulta y los mostramos
		$cliente = $_REQUEST['RAP'];
		$limite = $_REQUEST['contador'];
		$InicioPeriodo = $_POST['idaytime'];
		$FinalPeriodo = $_POST['fdaytime'];

		//Query para datos del cliente
		$queryCliente = mysql_query("SELECT Rap,Cliente FROM ventas2 WHERE Rap=$cliente;");

		//Si no se realizó la consulta mostramos el error
		if(!$queryCliente)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		while ($datCliente=mysql_fetch_array($queryCliente)) {
			# code...
			$ClienteDato = $datCliente['Cliente'];
			$RapCliente = $datCliente['Rap'];
		}	

		echo "<h2><p> Cliente: ".$ClienteDato."</p></h2>";
		echo "<h2><p> Rap: ".$RapCliente."</p></h2>";

		//Generamos la tabla
		echo "<table border='2'><tr><td><h3> Descripcion </h3></td><td><h3> Cantidad </h3></td></tr>";

		//Generamos la consulta
		//$queryTop = mysql_query("SELECT Fecha, descripcion, Canridad FROM ventas2 WHERE Rap=$cliente AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) ORDER BY Canridad DESC;");
		$queryTop = mysql_query("SELECT descripcion, SUM(Canridad) AS TOTAL from ventas2 WHERE Rap=$cliente AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) GROUP BY descripcion ORDER BY TOTAL DESC;");

		//Si no se realizó la consulta mostramos el error
		if(!$queryTop)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		//Creamos una variable para recibir las respuestas
		$fecha;
		$desc;
		$cant;
		$cont = 0;

		//Dentro de un while guardamos las respuetas
		while ($top=mysql_fetch_array($queryTop)) {
			# code...
			$desc[$cont] = $top['descripcion'];
			$cant[$cont] = $top['TOTAL'];
			//Incrementamos $cont
			$cont = $cont+1;
 		}

 		//Dentro de otro ciclo recorremos las 20 posiciones del arreglo
 		for ($i=0; $i < $limite; $i++) { 
 			# code...
 			echo "<tr>";
 			echo "<td>".$desc[$i]."</td>";
 			echo "<td>".$cant[$i]."</td>";
 			echo "</tr>";
 		}

		echo "</table>";
	}
	?>
	<hr />
	</form>
</body>
</html>
<?php
echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
?>