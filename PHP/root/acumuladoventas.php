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
	<form action="acumuladoventas.php" method="post">
	<!-- <p><input type="radio" name="clave" value="F">Sergio Ceballos (F)</p>
	<p><input type="radio" name="clave" value="A">Alfredo Degante (A)</p>
	<p><input type="radio" name="clave" value="J">Pedro Perez (J)</p>  -->
	<p><input type="date" name="idaytime" value="<?php echo $_POST['idaytime'];?>">Seleccione el inicio del Periodo</p>
	<p><input type="date" name="fdaytime" value="<?php echo $_POST['fdaytime'];?>">Seleccione el final del Periodo</p>
	<p><input type="text" name="rap" value="<?php echo $_POST['rap'];?>" class="text" size="60">Escriba Rap del Cliente:</p>
	<p><input type="submit" name="mostrar" value="Mostrar Acumulado Venta" onchange="submit()" /></p>
	<p></p>
	<p><input type="submit" name="enviarExcel" value="Enviar por correo" onchange="submit()"/><p>
	<p>Correo adicional: <input type="text" name="correo2" size="30"></p>
<?php
	
	//Incluimos la sesión
	session_start();
	//Guardamos el usuario de la sesion dentro de una variable		
	$testU = $_SESSION["usuario"];
	if ($testU == "") {
		# code...
			header("Location: inicio.php"); 
	}

	if(isset($_REQUEST['mostrar'])) //Si se pulsa el botón de mostrar
	{
		session_start();
		include_once "conexion.php"; //Conectamos a la base de datos

		//Guardamos el usuario de la sesion dentro de una variable		
		$asesor = $_SESSION["usuario"];

		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$sqlasesor = mysql_query("SELECT * FROM usuarios where usuario = '$asesor';");
		
		//Recibimos la consulta y la pasamos de un array a una variable local
 		while($usuariosasesor = mysql_fetch_array($sqlasesor))
		{
			$clvasesor = $usuariosasesor['clave'];
		}	

		//Capturamos las opciones del boton de radio para obtener el Asesor, Inicio y Final del periodo
		$InicioPeriodo = $_POST['idaytime'];
		$FinalPeriodo = $_POST['fdaytime'];
		$RAP = $_POST['rap'];

		//Generamos un Query para saber los datos del cliente
		$queryCliente = mysql_query("SELECT Rap,Cliente FROM ventas2 WHERE Rap=$RAP;");

		//Si no se realizó la consulta mostramos el error
		if(!$queryCliente)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		while ($datCliente=mysql_fetch_array($queryCliente)) {
			# code...
			$ClienteDato = $datCliente['Cliente'];
			$RapCliente = $datCliente['Rap'];
		}

		//Mostramos los datos de la consulta
		echo "<h3><p>Pedidos realizados por: ".$asesor."</p></h3>";
		echo "<h3><p>Cliente: ".$ClienteDato."</p></h3>";
		echo "<h3><p>RAP: ".$RapCliente."</p></h3>";

		//Variable String para generar la tabla en php
		//$cmd= "<td> Rap </td><td> Cliente </td><td> Descripcion </td><td> Total Cantidad </td>";
		$cmd= "<td> Descripcion </td><td><h3> Total </h3></td>";
		$fechaCount = 0;	//Contador de registros de Fecha
		$entradaFecha[$fechaCount] = ""; 	//Variable para guardar la fecha de la consulta
		$tmp[$fechaCount] = "";
		$prevFecha ="";
		$prevArt = "";
		$artCount = 0;
		$cont = 0;
		$contFecha = 0;
		$tmpCount = 0;

		//Generamos un Query para saber los meses en que se realizo un pedido entre el Rap seleccionado y el rango de fechas
		//$queryFecha = mysql_query("SELECT Rap,Cliente,Articulo,descripcion,Canridad,Fecha FROM ventas2 WHERE Rap=$RAP AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) ORDER BY Fecha ASC;");
		$queryFecha = mysql_query("SELECT Articulo,descripcion,Canridad,Fecha FROM ventas2 WHERE Rap=$RAP AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) ORDER BY Fecha ASC;");


		//Si no se realizó la consulta mostramos el error
		if(!$queryFecha)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		//Dentro de un while creamos un array y llenamos la tabla
		while($datoFecha=mysql_fetch_array($queryFecha))
		{
			if ($prevFecha != $datoFecha['Fecha']) {
			//Incrementamos el contador de las fechas
			$fechaCount++;
			//Capturamos la fecha de entrada del registro
			$entradaFecha[$fechaCount] = $datoFecha['Fecha'];	
			}
			//Igualamos el comparador prevFecha
			$prevFecha = $datoFecha['Fecha'];
		}

		//Contador general para la fecha (NO SE MUEVE)
		$contFecha = $fechaCount;

		//Dentro de un while generamos el comando para crear la tabla en php
		while ($fechaCount > 0) {
			$tmp[$fechaCount] = $entradaFecha[$fechaCount];
			$colFecha[$fechaCount] = $tmp[$fechaCount];
			//echo "<p>".$tmp[$fechaCount]."</p>";
			$cmd = $cmd."<td>".$tmp[$fechaCount]."</td>";
			$fechaCount--;
		}

		//Generamos un Query para saber los Articulos y Cantidades en que se realizo un pedido entre el Rap seleccionado y el rango de fechas
		//$queryArt = mysql_query("SELECT Rap,Cliente,Articulo,descripcion,Canridad,Fecha FROM ventas2 WHERE Rap=$RAP AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) ORDER BY descripcion ASC;");
		$queryArt = mysql_query("SELECT Rap,Articulo,descripcion,Canridad,Fecha FROM ventas2 WHERE Rap=$RAP AND Fecha>=cast('$InicioPeriodo' AS DATE) AND Fecha<=cast('$FinalPeriodo' AS DATE) ORDER BY descripcion ASC;");

		//Si no se realizó la consulta mostramos el error
		if(!$queryArt)
		{	
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		//Dentro de un while arreglamos la consulta
		while ($datoArt=mysql_fetch_array($queryArt)) {
			if ($prevArt != $datoArt['Articulo']) {
				//Incrementamos el contador de los Articulos
				$artCount++;
				//Capturamos los datos
				$sqlRap[$artCount] = $datoArt['Rap'];
				//$sqlCliente[$artCount] = $datoArt['Cliente'];
				$sqldescripcion[$artCount] = $datoArt['descripcion'];
				$clavArticulo[$artCount] = $datoArt['Articulo'];
				//$sqlCanridad[$artCount] = $datoArt['Canridad'];
			}
			//Guardamos la suma de las cantidades dentro de un array $total
			$total[$artCount] = $total[$artCount] + $datoArt['Canridad'];
			//Igualamos el comparador prevArt
			$prevArt = $datoArt['Articulo'];
			//Si son iguales las claves del articulo
			if ($prevArt == $datoArt['Articulo']) {
				//Igualamos Contadores
				$tmpCount++;
				//Guardamos las fechas de entrada dentro de un array $fechaEntrada
				$sqlFecha[$tmpCount] = $datoArt['Fecha'];
				//Guardamos las cantidades por entrada
				$sqlCant[$tmpCount] = $datoArt['Canridad'];
				//Guardamos la clave del articulo como indice
				$sqlClave[$tmpCount] = $datoArt['Articulo'];
			}
		}

		// echo "<p>".$clavArticulo[2]."</p>";
		// echo "<p>".$sqlClave[5]."</p>";
		// echo "<p>".$artCount."</p>";
		// echo "<p>".$tmpCount."</p>";
		// echo "<p>".$contFecha."</p>";
		//Creamos una tabla en html con los campos de la tabla mysql de la manera que nos pide la tabla muestra
		echo "<table border='2'><tr>".$cmd."</tr>";

		while ($cont<$artCount) {
			//Incrementamos el contador $cont
			$cont++;
			//Mostramos los datos en la tabla
			echo "<tr>";
			//echo "<td>".$sqlRap[$cont]."</td>";
			//echo "<td>".$sqlCliente[$cont]."</td>";
			echo "<td>".$sqldescripcion[$cont]."</td>";
			echo "<td>".$total[$cont]."</td>";

			//Dentro de un for recorremos el arreglo de las fechas
			for ($i=$contFecha; $i > 0 ; $i--) { 
				//Realizamos un query a la tabla ventas para la clave del articulo y la fecha que estamos buscando
				$queryVentas=mysql_query("SELECT * FROM ventas2 WHERE Rap='$sqlRap[$cont]' AND Articulo='$clavArticulo[$cont]' AND Fecha=cast('$tmp[$i]' AS DATE);");
				while ($datoCantidad=mysql_fetch_array($queryVentas)) {
					//Si existe la cantidad la insertamos en la tabla
					echo "<td>".$datoCantidad['Canridad']."</td>";
					$canFecha[$i]=$datoCantidad['Canridad'];
					$artFecha[$cont][$i] = $canFecha[$i];
					$empty[$i] = $datoCantidad['Canridad'];
					}	

				if (is_null($empty[$i])) {
						# code...
						echo "<td></td>";	
						}
			}
			echo "</tr>";
			//RE iniciamos el arreglo donde se guarda la consulta para borrar los valores anteriores del for
			for ($z=$contFecha; $z > 0 ; $z--) { 
				# code...
				$empty[$z] = NULL;
			}
		}
		echo "</table>";
		echo "<br>";
		echo "<br>";

		//Capturamos la fecha
		//$fecha = date("d/m/Y"); **********************************************************
		$fecha = date("Y/m/d");
		//$nfecha = date("dmy");  **********************************************************
		$nfecha = date("ymd");

		//Incluimos la clase de PHPExcel
		require_once dirname(__FILE__) . '/../www/Classes/PHPExcel.php';

		// Creamos el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		//Guardamos el nombre del usuario en una variable
		$titulo = $nfecha;

		//Asignación de propiedades
		$objPHPExcel->getProperties()
					->setCreator("web")
					->setLastModifiedBy("web")
					->setTitle("consulta")
					->setSubject("consulta")
					->setKeywords("consulta")
					->setCategory("acumuladoventas");

		$tituloHoja = "venta".$titulo;

		//Guardamos las fechas en variables para el titulos de las columnas
		$m1 = $colFecha[1];
		$m2 = $colFecha[2];
		$m3 = $colFecha[3];
		$m4 = $colFecha[4];
		$m5 = $colFecha[5];
		$m6 = $colFecha[6];
		$m7 = $colFecha[7];
		$m8 = $colFecha[8];
		$m9 = $colFecha[9];
		$m10 = $colFecha[10];
		$m11 = $colFecha[11];
		$m12 = $colFecha[12];

		//Guardamos en un array los titulos de las columnas
		$tituloColumnas = array('Descripción', 'Total', $m12, $m11, $m10, $m9, $m8, $m7, $m6, $m5, $m4, $m3, $m2, $m1);

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1','NOMBRE:')
					->setCellValue('A2',$ClienteDato)
					->setCellValue('A3','RAP:')
					->setCellValue('A4',$RapCliente)
					->setCellValue('A5',$tituloColumnas[0])	//Descripción
					->setCellValue('B5',$tituloColumnas[1])	//Total
					->setCellValue('C5',$tituloColumnas[2])	//M1
					->setCellValue('D5',$tituloColumnas[3])	//M2
					->setCellValue('E5',$tituloColumnas[4])	//M3
					->setCellValue('F5',$tituloColumnas[5])	//M4
					->setCellValue('G5',$tituloColumnas[6])	//M5
					->setCellValue('H5',$tituloColumnas[7])	//M6
					->setCellValue('I5',$tituloColumnas[8])	//M7
					->setCellValue('J5',$tituloColumnas[9])	//M8
					->setCellValue('K5',$tituloColumnas[10])//M9
					->setCellValue('L5',$tituloColumnas[11])//M10
					->setCellValue('M5',$tituloColumnas[12])//M11
					->setCellValue('N5',$tituloColumnas[13]);//M12

		//Creamos un contador de filas para el excel
		$exlCont = 6;
		//Dentro de un ciclo guardamos llenamos la hoja
		for ($i=1; $i <= $artCount; $i++) { 
			# code...
			//Capturamos la descripcion del articulo
			$descArt = $sqldescripcion[$i];
			//Capturamos su total
			$totalArt = $total[$i];
			//Capturamos total por periodo para las 12 variables
			$subArt[1] = $artFecha[$i][1];
			$subArt[2] = $artFecha[$i][2];
			$subArt[3] = $artFecha[$i][3];
			$subArt[4] = $artFecha[$i][4];
			$subArt[5] = $artFecha[$i][5];
			$subArt[6] = $artFecha[$i][6];
			$subArt[7] = $artFecha[$i][7];
			$subArt[8] = $artFecha[$i][8];
			$subArt[9] = $artFecha[$i][9];
			$subArt[10] = $artFecha[$i][10];
			$subArt[11] = $artFecha[$i][11];
			$subArt[12] = $artFecha[$i][12];

			//Pasamos los valores a excel
			$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$exlCont, $descArt)
							->setCellValue('B'.$exlCont, $totalArt)
							->setCellValue('C'.$exlCont, $subArt[12])
							->setCellValue('D'.$exlCont, $subArt[11])
							->setCellValue('E'.$exlCont, $subArt[10])
							->setCellValue('F'.$exlCont, $subArt[9])
							->setCellValue('G'.$exlCont, $subArt[8])
							->setCellValue('H'.$exlCont, $subArt[7])
							->setCellValue('I'.$exlCont, $subArt[6])
							->setCellValue('J'.$exlCont, $subArt[5])
							->setCellValue('K'.$exlCont, $subArt[4])
							->setCellValue('L'.$exlCont, $subArt[3])
							->setCellValue('M'.$exlCont, $subArt[2])
							->setCellValue('N'.$exlCont, $subArt[1]);
			$exlCont++;

			}
		//Fuera del loop, renombramos la hoja y escribimos el fichero
		$objPHPExcel->getActiveSheet()->setTitle('consulta');

		$objPHPExcel->setActiveSheetIndex(0);

		//Variable para guardar el archivo contiene la direccion, el nombre y la extensión
		$directorio = 'archivos/pedidos/consultas/';
		$extension = '.xlsx';
		$filename = $directorio."consultaVentas".$extension;

		//Objeto para crear el archivo
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('/var/www/archivos/consultas/consulta.xlsx');		
	}

	//Capturamos el correo del cliente
	if(isset($_POST['correo2']))
	{
		$correo2 = $_POST['correo2'];
	}

	if (isset($_POST['enviarExcel'])) {

			session_start();
			include_once "conexion.php"; //Conectamos a la base de datos
			//Capturamos correo del asesor mediante una consulta mysql

			$asesorQuery = $_SESSION["usuario"];
			//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
			$sqlasesorCorreo = mysql_query("SELECT * FROM usuarios where usuario = '$asesorQuery';");
			//Recibimos la consulta y la pasamos de un array a una variable local
 			while($usuariosCorreo = mysql_fetch_array($sqlasesorCorreo))
			{
				$correoasesor = $usuariosCorreo['correo'];
			}	
			
			# Enviar por correo
			//Enviamos el mail con el siguiente código...
			require '/var/www/PHPMailer/PHPMailerAutoload.php'; //Módulo PHPMailer

			//Creamos el objeto de la clase
			$mail = new PHPMailer;

			//Creamos el objeto de la clase
			$mail = new PHPMailer;

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com;smtp.gmail.com'; 		  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'sylkaserver@gmail.com';            // SMTP username <-----------------------
			$mail->Password = 'sylka1234';                        // SMTP password <-----------------------
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'sy1@sylka.example.com';
			$mail->FromName = 'Servidor Pedidos';

			$mail->addAddress('lepxis@gmail.com');         // Name is optional
			$mail->addAddress($correoasesor);
			$mail->addAddress($correo2);
			$prext = '/var/www/';                                 //Dirección de la hoja de excel
			$filedir = '/var/www/archivos/consultas/consulta.xlsx';

			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->addAttachment($filedir);                       // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Consulta Ventas por Cliente';
			$mail->Body    = 'Consulta desde<b> Servidor</b>';
			$mail->AltBody = 'Server running OK!';

			if(!$mail->send()) {
    			echo 'Message could not be sent.';
    			echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo"<br>";
    			echo '<h3><p>Consulta enviada correctamente!</p></h3>';
    			echo "<h3><p>".$correoasesor."</p></h3>";
    			echo"</br>";
			}
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
