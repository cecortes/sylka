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
</body>
</html>
<?php
//Variables para la table articulos de mysql
$clasificacion = "";
$ruta = "";
$rap = 0;
$estatus="";
$nombre="";
$rfc="";
$calle="";
$numerointerior="";
$numeroexterior="";
$colonia="";
$cp= 0;
$telefono="";
$poblacion="";
$Listaprecios=0;
$claveasesor="";
$direnvio="";
$interiorenvio="";
$exteriorenvio="";
$coloniaenvio="";
$poblacionenvio="";
//Incluimos la conexión mysql
include_once "conexion.php"; //Conectamos a la base de datos
/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

//Iniciamos el objeto
$objPHPExcel = PHPExcel_IOFactory::load('/var/www/archivos/listaclientes.xls');

//Obtenemos la hoja activa
$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

echo "<table border='2'";
//Recorremos las filas obtenidas
foreach($objHoja as $Indice => $objCelda)
{
	echo "<tr>";
	echo "<td>".$objCelda['A']."</td>";
	echo "<td>".$objCelda['B']."</td>";
	echo "<td>".$objCelda['C']."</td>";
	echo "<td>".$objCelda['D']."</td>";
	echo "<td>".$objCelda['E']."</td>";
	echo "<td>".$objCelda['F']."</td>";
	echo "<td>".$objCelda['G']."</td>";
	echo "<td>".$objCelda['H']."</td>";
	echo "<td>".$objCelda['I']."</td>";
	echo "<td>".$objCelda['J']."</td>";
	echo "<td>".$objCelda['K']."</td>";
	echo "<td>".$objCelda['L']."</td>";
	echo "<td>".$objCelda['M']."</td>";
	echo "<td>".$objCelda['N']."</td>";
	echo "<td>".$objCelda['O']."</td>";
	echo "<td>".$objCelda['P']."</td>";
	echo "<td>".$objCelda['Q']."</td>";
	echo "<td>".$objCelda['R']."</td>";
	echo "<td>".$objCelda['S']."</td>";
	echo "<td>".$objCelda['T']."</td>";
	echo "</tr>";
	if($Indice != 1)
	{
		//Guardamos los valores de la celdas excepto el de la primera porque son los títulos de la tabla
		$clasificacion = $objCelda['A'];
		$ruta = $objCelda['B'];
		$rap = $objCelda['C'];
		$estatus = $objCelda['D'];
		$nombre = $objCelda['E'];
		$rfc = $objCelda['F'];
		$calle = $objCelda['G'];
		$numerointerior = $objCelda['H'];
		$numeroexterior = $objCelda['I'];
		$colonia = $objCelda['J'];
		$cp = $objCelda['K'];
		$telefono = $objCelda['L'];
		$poblacion = $objCelda['M'];
		$Listaprecios = $objCelda['N'];
		$claveasesor = $objCelda['O'];
		$direnvio = $objCelda['P'];
		$interiorenvio = $objCelda['Q'];
		$exteriorenvio = $objCelda['R'];
		$coloniaenvio = $objCelda['S'];
		$poblacionenvio = $objCelda['T'];
		//Insertamos los valores en MYSQL
		$lista = mysql_query("INSERT INTO clientes(Clasificacion,Ruta,Rap,Estatus,Nombre,Rfc,Calle,numerointerior,numeroexterior,Colonia,cp,telefono,Poblacion,Listaprecios,ClaveAsesor,DirEnvio,interior_envio,exterior_envio,Colonia_envio,Poblacion_envi0) VALUES ('$clasificacion','$ruta','$rap','$estatus','$nombre','$rfc','$calle','$numerointerior','$numeroexterior','$colonia','$cp','$telefono','$poblacion','$Listaprecios','$claveasesor','$direnvio','$interiorenvio','$exteriorenvio','$coloniaenvio','$poblacionenvio');");
		
		if(!$lista)
		{
			die('Error al actualizar los datos '.mysql_error());
		}
	}
}
echo "</table>";
//Cerramos la conexión
mysql_close();
echo "<hr />";
echo '<a href="asesor.php"><div style="text-align:left"><div style="font-size:45px;">Regresar al panel de asesores</div></div></a>';
echo '<a href="logout.php"><div style="text-align:left"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
?>
