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
	echo '<a href="consultaclientes.php"><div style="text-align:left"><div style="font-size:45px;">Consulta de Clientes</div></div></a>';
	?>
	<hr />
	<?php
	//Incluimos la sesión
	session_start();
	//Guardamos el usuario de la sesion dentro de una variable		
	$asesor = $_SESSION["usuario"];
	echo '<a href="altapedidos.php"><div style="text-align:left"><div style="font-size:45px;">Alta de Pedidos</div></div></a>';
	if($asesor =='admin' || $asesor=='sergioceballos' || $asesor=='ari')
	{
		echo '<a href="altapedidosasesor.php"><div style="text-align:left"><div style="font-size:45px;">Alta de Pedidos por Asesor</div></div></a>';
	}
	else
	{
		//echo '<a href="consultapedidos2.php"><div style="text-align:left"><div style="font-size:45px;">Consulta de Pedidos</div></div></a>';
	}
	?>
	<hr />
	<?php
	echo '<a href="vacumulada2.php"><div style="text-align:left"><div style="font-size:45px;">Pedidos por fecha</div></div></a>';
	echo '<a href="acumuladoventas.php"><div style="text-align:left"><div style="font-size:45px;">Ventas por Cliente</div></div></a>';
	echo '<a href="top20.php"><div style="text-align:left"><div style="font-size:45px;">TOP de articulos por Cliente</div></div></a>';
	?>
	<hr />
	<?php
	//Incluimos la sesión
	session_start();
	//Guardamos el usuario de la sesion dentro de una variable		
	$asesor = $_SESSION["usuario"];
	if($asesor == 'admin' || $asesor=='sergioceballos' || $asesor=='ari')
	{
		// echo '<a href="vacumulada.php"><div style="text-align:left"><div style="font-size:45px;">Consulta Venta Acumulada Server</div></div></a>';
		// echo '<a href="altaarticulos.php"><div style="text-align:left"><div style="font-size:45px;">Subir lista de precios</div></div></a>';
		// echo '<a href="actualizarclientes.php"><div style="text-align:left"><div style="font-size:45px;">Actualizar Clientes</div></div></a>';
		// echo '<a href="altaventas.php"><div style="text-align:left"><div style="font-size:45px;">Subir lista de Ventas</div></div></a>';
		echo '<a href="paneladmin.php"><div style="text-align:left"><div style="font-size:45px;">Panel Admin</div></div></a>';
		echo '<hr />';
	}
	?>
</body>
</html>
<?php
	echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
?>