<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>SYLKA...Acceso Asesores</title>
<link href='http://fonts.googleapis.com/css?family=Comfortaa:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
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
	<?php

	//Incluimos la sesión
	session_start();
	//Guardamos el usuario de la sesion dentro de una variable		
	$testU = $_SESSION["usuario"];
	if ($testU == "") {
		# code...
			header("Location: inicio.php"); 
	}
	
	//echo '<a href="altaclientes.php"><div style="text-align:left"><div style="font-size:45px;">Alta de Clientes</div></div></a>';
	echo '<a href="vacumulada.php"><div style="text-align:left"><div style="font-size:45px;">Consulta Pedidos por Fecha y Asesor</div></div></a>';
	echo '<a href="conpedidos.php"><div style="text-align:left"><div style="font-size:45px;">Consulta Pedidos Abiertos</div></div></a>';
	?>
	<hr />
	<?php
	echo '<a href="delpedidos.php"><div style="text-align:left"><div style="font-size:45px;">Borrar Pedidos por Clave del Articulo</div></div></a>';
	echo '<a href="delpedidos2.php"><div style="text-align:left"><div style="font-size:45px;">Borrar Pedidos por Rango de Id</div></div></a>';
	?>
	<hr />
	<?php
	echo '<a href="altaarticulos.php"><div style="text-align:left"><div style="font-size:45px;">Subir lista de Precios</div></div></a>';
	echo '<a href="altaventas.php"><div style="text-align:left"><div style="font-size:45px;">Subir lista de Ventas</div></div></a>';
	echo '<a href="actualizarclientes.php"><div style="text-align:left"><div style="font-size:45px;">Actualizar Lista de Clientes</div></div></a>';
	?>
	<hr />
	<?php
	echo '<a href="altausuarios.php"><div style="text-align:left"><div style="font-size:45px;">Alta de Asesores</div></div></a>';
	echo '<a href="updateasesor.php"><div style="text-align:left"><div style="font-size:45px;">Modificar Asesores</div></div></a>';
	echo "<hr />";
	?>
</body>
</html>
<?php
	echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
	echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
?>