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
	<form action="delpedidos.php" method="post"> 
	<p>Escriba la CLAVE DEL ARTICULO a borrar: <input type="text" name="CLAVE" value="" size="2"></p>
	<p><input type="submit" name="borrar" value="Borrar Pedido" /></p>
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

	if(isset($_REQUEST['borrar'])) //Si se pulsa el botón de borrar
	{
		//Capturamos la clave del pedido a borrar
		$clvPedido = $_POST['CLAVE'];
		
		//Generamos el query para borrar la clave
		$queryBorrar = mysql_query("DELETE FROM pedidos WHERE clavepedido = '$clvPedido';");
		
		//Si falló el query
		if(!$queryBorrar)
		{
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al borrar el pedido '.mysql_error());
		}
		//Cerramos la conexión
		mysql_close();

		echo "<h2> Pedido ".$clvPedido." borrado correctamente del Servidor</h2>";
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