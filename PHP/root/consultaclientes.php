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
	<form action="consultaclientes.php" method="post">
	<p><input type="submit" name="mostrar" value="Mostrar Clientes" /></p>
	<?php
	include_once "conexion.php"; //Conectamos a la base de datos
	session_start();

	//Guardamos el usuario de la sesion dentro de una variable		
	$asesor = $_SESSION["usuario"];

	if ($asesor == "") {
		# code...
		header("Location: inicio.php");
	}

	//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
	$sqlasesor = mysql_query("SELECT * FROM usuarios where usuario = '$asesor';");
		
	//Recibimos la consulta y la pasamos de un array a una variable local
 	while($usuariosasesor = mysql_fetch_array($sqlasesor))
	{
		$clvasesor = $usuariosasesor['clave'];
	}

	if(isset($_REQUEST['mostrar'])) //Si se pulsa el botón de mostrar
	{
		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$resultado = mysql_query("SELECT * FROM clientes WHERE ClaveAsesor='$clvasesor' ORDER BY Ruta ASC;");

		//Si no se realizó la consulta mostramos el error
		if(!$resultado)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}
		//Cerramos la conexión
		mysql_close();

		//Creamos una tabla en html con los campos de la tabla mysql
		echo "<table border='2'><tr><td>Clasificacion</td><td>Ruta</td><td>Rap</td><td>Estatus</td><td>Nombre</td><td>RFC</td><td>Calle</td><td>Numero interior</td><td>Numero Exterior</td><td>Colonia</td><td>CP</td><td>Telefono</td><td>Poblacion</td><td>Lista de precios</td><td>Clave Asesor</td><td>Direccion de Envio</td><td>Numero Interior Envio</td><td>Numero Exterior de Envio</td><td>Colonia de Envio</td><td>Poblacion de Envio</td></tr>";

		//Dentro de un while creamos un array y llenamos la tabla
		while($dato=mysql_fetch_array($resultado))
		{
			echo"<tr>";
			echo"<td>".$dato['Clasificacion']."</td>";
			echo"<td>".$dato['Ruta']."</td>";
			echo"<td>".$dato['Estatus']."</td>";
			echo"<td>".$dato['Nombre']."</td>";
			echo"<td>".$dato['Rfc']."</td>";
			echo"<td>".$dato['Calle']."</td>";
			echo"<td>".$dato['numerointerior']."</td>";
			echo"<td>".$dato['numeroexterior']."</td>";
			echo"<td>".$dato['Colonia']."</td>";
			echo"<td>".$dato['cp']."</td>";
			echo"<td>".$dato['telefono']."</td>";
			echo"<td>".$dato['Poblacion']."</td>";
			echo"<td>".$dato['Listaprecios']."</td>";
			echo"<td>".$dato['ClaveAsesor']."</td>";
			echo"<td>".$dato['DirEnvio']."</td>";
			echo"<td>".$dato['interior_envio']."</td>";
			echo"<td>".$dato['exterior_envio']."</td>";
			echo"<td>".$dato['Colonia_envio']."</td>";
			echo"<td>".$dato['Poblacion_envi0']."</td>";
			echo"</tr>";
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
