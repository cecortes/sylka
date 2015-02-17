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
	<P ALIGN=center>Alta Usuarios
	</P>
	</h2>
	<hr />
	<form action="altausuariossql.php" method="post">
	<p>Nombre: <input type="text" name="Nombre" size="30" /></p>
	<p>Usuario: <input type="text" name="Usuario" size="30" /></p>
	<p>Pass: <input type="text" name="Password" size="30" /></p>
	<p>Clave: <input type="text" name="Clave" size="30" /></p>
	<p>Correo: <input type="text" name="Correo" size="30" /></p>
	<p><input type="submit" name="enviar" value="Alta del Usuario" /></p>
	<hr />
	</form>
</body>
</html>
<?php
	//Incluimos la sesión
	session_start();
	//Guardamos el usuario de la sesion dentro de una variable		
	$testU = $_SESSION["usuario"];
	if ($testU == "") {
		# code...
			header("Location: inicio.php"); 
	}
	
	echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
	echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
?>