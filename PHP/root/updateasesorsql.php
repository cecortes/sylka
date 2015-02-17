<!DOCTYPE html PUBLIC "-//W3C//DTD XTHML 1.0 Strict//ES" "http://www.w3org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3org.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=[b]UTF-8[/b]" />
<title>SYLKA...Acceso Asesores</title>
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
	<?php
	include_once "conexion.php"; //Conectamos a la base de datos
	
	//Capturamos los valores del formulario en variables
	$usuario = $_POST['Usuario'];
	$pass = $_POST['Password'];
	$nombre = $_POST['Nombre'];
	$clave = $_POST['Clave'];
	$correo = $_POST['Correo'];
	$idusuario = 0;
	$direccion = "no aplica";
	$tel = "no aplica";
	$ruta = "no aplica";
	
	//Insertamos los valores en MYSQL
	$sql = mysql_query("UPDATE usuarios SET password='$pass', clave='$clave',correo='$correo' WHERE usuario='$usuario';");
	
	if(!$sql)
	{	
		echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
		die('Error al actualizar los datos '.mysql_error());
	}
	//Cerramos la conexión
	mysql_close();
	echo '<div style="text-align:left"><div style="font-size:35px;">El Asesor ha sido agregado en la base de datos</div></div>';
	?>
	<hr />
</body>
</html>
<?php
	echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
	echo '<a href="logout.php"><div style="text-align:left"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
?>