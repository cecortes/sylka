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
//Variables para la table ventas de mysql
$idventas = 0;
$Fecha = "";
$Rap = "";
$CLIENTE = "";
$Asesor = "";
$Articulo = "";
$descripcion = "";
$Canridad = 0;
$Importe = 00000.00;
//Incluimos la conexión mysql
include_once "conexion.php"; //Conectamos a la base de datos
/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

//Iniciamos el objeto
$objPHPExcel = PHPExcel_IOFactory::load('/var/www/archivos/listaventas.xls');

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
	echo "</tr>";
	if($Indice != 1)
	{
		//Guardamos los valores de la celdas excepto el de la primera porque son los títulos de la tabla
		$Fecha = $objCelda['A'];
		$Rap = $objCelda['B'];
		$CLIENTE = $objCelda['C'];
		$Asesor = $objCelda['D'];
		$Articulo = $objCelda['E'];
		$descripcion = $objCelda['F'];
		$Canridad = $objCelda['G'];
		$Importe = $objCelda['H'];
		
		//Insertamos los valores en MYSQL
		$lista = mysql_query("INSERT INTO ventas2(idventas,Fecha,Rap,CLIENTE,Asesor,Articulo,descripcion,Canridad,Importe) VALUES ('$idventas','$Fecha','$Rap','$CLIENTE','$Asesor','$Articulo','$descripcion','$Canridad','$Importe');");
		
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