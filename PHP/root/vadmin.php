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
	<form action="vadmin.php" method="post">
	<!-- <p><input type="radio" name="clave" value="F">Sergio Ceballos (F)</p>
	<p><input type="radio" name="clave" value="A">Alfredo Degante (A)</p>
	<p><input type="radio" name="clave" value="J">Pedro Perez (J)</p>  -->
	<p><input type="date" name="idaytime">Seleccione el inicio del Periodo</p>
	<p><input type="date" name="fdaytime">Seleccione el final del Periodo</p>
	<p><input type="text" name="rap" value="" class="text" size="60">Escriba Rap del Cliente:</p>
	<p><input type="submit" name="mostrar" value="Mostrar Acumulado Venta" /></p>
<?php
	session_start();
	include_once "conexion.php"; //Conectamos a la base de datos

	//Guardamos el usuario de la sesion dentro de una variable		
	$asesor = $_SESSION["usuario"];

	//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
	$sqlasesor = mysql_query("SELECT * FROM usuarios where usuario = '$asesor';");
		
	//Recibimos la consulta y la pasamos de un array a una variable local
 	while($usuariosasesor = mysql_fetch_array($sqlasesor))
	{
		$clvasesor = $usuariosasesor['clave'];
	}	

	if(isset($_REQUEST['mostrar'])) //Si se pulsa el botón de mostrar
	{
		echo "<p>Pedidos realizados por: ".$asesor."</p>";
		//Capturamos las opciones del boton de radio para obtener el Asesor, Inicio y Final del periodo
		$InicioPeriodo = $_POST['idaytime'];
		$FinalPeriodo = $_POST['fdaytime'];
		$RAP = $_POST['rap'];

		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$resultado = mysql_query("SELECT Rap,Cliente,descripcion,SUM(Canridad) AS Totales FROM ventas WHERE Rap=$RAP AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) GROUP BY Articulo ORDER BY Fecha ASC;");

		//Si no se realizó la consulta mostramos el error
		if(!$resultado)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}
		//Cerramos la conexión
		//mysql_close();

		//Variable String para generar la tabla en php
		$cmd= "<td> Rap </td><td> Cliente </td><td> Descripcion </td><td> Total Cantidad </td>";
		$fechaCount = 0;	//Contador de registros de Fecha
		$entradaFecha[$fechaCount] = ""; 	//Variable para guardar la fecha de la consulta
		$tmp[$fechaCount] = "";

		//Generamos un Query para saber los meses en que se realizo un pedido entre el Rap seleccionado y el rango de fechas
		$queryFecha = mysql_query("SELECT * FROM ventas WHERE Rap=$RAP AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) GROUP BY Fecha ORDER BY Fecha ASC;");

		//Si no se realizó la consulta mostramos el error
		if(!$queryFecha)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		//Dentro de un while creamos un array y llenamos la tabla
		while($datoFecha=mysql_fetch_array($queryFecha))
		{
			//Incrementamos el contador de las fechas
			$fechaCount++;
			//Capturamos la fecha de entrada del registro
			$entradaFecha[$fechaCount] = $datoFecha['Fecha'];
		}

		//Dentro de un while generamos el comando para crear la tabla en php
		while ($fechaCount > 0) {
			$tmp[$fechaCount] = $entradaFecha[$fechaCount];
			//echo "<p>".$tmp[$fechaCount]."</p>";
			$cmd = $cmd."<td>".$tmp[$fechaCount]."</td>";
			$fechaCount--;
		}

		//echo "<p>".$cmd."</p>";

		//Creamos una tabla en html con los campos de la tabla mysql de la manera que nos pide la tabla muestra
		echo "<table border='2'><tr>".$cmd."</tr>";
		//echo "<table border='2'><tr><td> Rap </td><td> Cliente </td><td> Descripcion </td><td> Total Cantidad </td></tr>";
		//Dentro de un while creamos un array y llenamos la tabla
		while($dato=mysql_fetch_array($resultado))
		{
			echo"<tr>";
			echo"<td>".$dato['Rap']."</td>";
			echo"<td>".$dato['Cliente']."</td>";
			echo"<td>".$dato['descripcion']."</td>";
			echo"<td>".$dato['Totales']."</td>";
			echo"</tr>";
		}
		echo "</table>";
		//echo "<p>Pedidos realizados por: ".$InicioPeriodo."</p>";
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