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
	<div class="caja">
		<form method="post" action="" enctype="multipart/form-data">
			<h2>Actualizar todas las ventas</h2>
			<input type="file" name="archivo" /><br /><br />
			<input type="submit" value="Guardar en Servidor" name="guardar"/>
			<input type="submit" value="Borrar ventas del Servidor" name="borrar"/>
		</form>
	</div>
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
	
	//Incluimos la conexion mysql
	include_once "conexion.php";
	//Variable para especifiacr el formato a admitir
	$formatos = array('.xls', '.xlsx');

	//Si es pulsado el boton de guardar
	if(isset($_POST['guardar']))
	{
		//Guardamos el nombre del archivo en la variable
		$nombreArchivo =$_FILES['archivo']['name'];
		$nombreTmpArchivo =$_FILES['archivo']['tmp_name'];

		//Obtenemos la extensión del archivo
		$ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
		
		//Comparamos si la extension está dentro del formato perimitido
		if(in_array($ext, $formatos))
		{
			//Si el formato es correcto guardamos el archivo
			if(move_uploaded_file($nombreTmpArchivo, "/var/www/archivos/$nombreArchivo"))
			{
				echo "<hr />";
				echo "<h2>"."Archivo $nombreArchivo subido correctamente"."</h2><br/>";
				//Hacemos un botón para enviar a otra pagina y para mostrar el contenido del archivo
				echo "<form method='post' action='altaventas2.php'>";
				echo "<input name='contenido' type='submit' value='Mostrar contenido y Actualizar Servidor' />";
				echo "</form>";
				echo "<hr />";
				echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
				echo '<a href="logout.php"><div style="text-align:left"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			}
			else
			{
				echo "<hr />";
				echo "<h2>"."Error al subir el archivo $nombreArchivo"."</h2><br/>";
				echo "<hr />";
				echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
				echo '<a href="logout.php"><div style="text-align:left"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			}
		}
		else
		{
			echo "<hr />";
			echo "<h2>"."Archivo no permitido"."</h2><br/>";
			echo "<hr />";
			echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
			echo '<a href="logout.php"><div style="text-align:left"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
		}
	}
//Si es pulsado el boton de borrar
if(isset($_POST['borrar']))
{
	echo "<hr />";
	//Query para mysql
	$borrar=mysql_query('DELETE FROM ventas;');
	if(!$borrar)
	{	
		echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
		die('<h2>Error al actualizar los datos</h2>'.mysql_error());
	}
	//Cerramos la conexión
	mysql_close();
	echo "<h2>Ventas borradas exitosamente</h2>";
	echo "<hr />";
	echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
}
?>