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
	<form action="conpedidos.php" method="post"> 
	<p>Escriba RAP para consulta: <input type="text" name="RAP" value="" size="1"></p>
	<p><input type="date" name="idaytime">Seleccione el inicio del Periodo</p>
	<p><input type="date" name="fdaytime">Seleccione el final del Periodo</p>
	<p><input type="submit" name="mostrar" value="Mostrar Pedidos" /></p>
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

	if(isset($_REQUEST['mostrar'])) //Si se pulsa el botón de mostrar
	{
		//Capturamos las opciones del boton de radio para obtener el Asesor, Inicio y Final del periodo
		$Rap = $_POST['RAP'];
		$InicioPeriodo = $_POST['idaytime'];
		$FinalPeriodo = $_POST['fdaytime'];

		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$resultado = mysql_query("SELECT * FROM pedidos WHERE fecha>=cast('$InicioPeriodo' AS DATE) AND fecha<=cast('$FinalPeriodo' AS DATE) AND rap='$Rap';");

		//Si no se realizó la consulta mostramos el error
		if(!$resultado)
		{
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}
		//Cerramos la conexión
		mysql_close();

		//Creamos una tabla en html con los campos de la tabla mysql
		echo "<table border='2'><tr><td> Id Pedido </td><td> Fecha </td><td> Clave del Pedido </td><td> Nombre del Cliente </td><td> Asesor </td><td> Articulo </td><td> Cantidad </td></tr>";

		//Dentro de un while creamos un array y llenamos la tabla
		while($dato=mysql_fetch_array($resultado))
		{
			echo"<tr>";
			echo"<td>".$dato['idpedido']."</td>";
			echo "<td>".$dato['fecha']."</td>";
			echo"<td>".$dato['clavepedido']."</td>";
			echo "<td>".$dato['nombrecliente']."</td>";
			echo "<td>".$dato['clavevendedor']."</td>";
			echo "<td>".$dato['clavearticulo']."</td>";
			echo "<td>".$dato['cantidad']."</td>";
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