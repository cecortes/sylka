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
	<form name = "pedidos" action="altapedidosasesor.php" method="post">
	<p>Seleccionar el Rap del Cliente:<input type="text" name="rapcliente" value="<?php echo $_POST['rapcliente'];?>"size="8" onchange="submit()" class="rap"/></p>
	<p>Asesor Aldo Piana (F)</p>
	<p>Asesor Alfredo Degante (A)</p>
	<p>Asesor Pedro Perez (J)</p>
	<p>Seleccionar clave del Asesor:<input type="text" name="clave" value="<?php echo $_POST['clave'];?>"size="8" onchange="submit()" class="rap"/></p>
	<?php
	session_start();
	include_once "conexion.php"; //Conectamos a la base de datos

	//Guardamos el usuario de la sesion dentro de una variable		
	$asesor = $_SESSION["usuario"];

	if ($asesor == "") {
		# code...
		header("Location: inicio.php");
	}

	//Guardamos el usuario de la sesion dentro de una variable		
	$asesorclave = $_POST['clave'];

	if(isset($_REQUEST['rapcliente']))
	{
		//Capturamos el Rap del cliente
		$rap = $_REQUEST['rapcliente'];

		//Una vez capturado el rap hacemos un query a la base de datos para obtener los datos del cliente
		$sqlcliente = mysql_query("SELECT * FROM clientes where Rap = '$rap';");
		while($clienterap = mysql_fetch_array($sqlcliente))
		{
			//Datos para mostrar antes de levantar el pedido
			$lista = $clienterap['Listaprecios'];
			$nombrecliente = $clienterap['Nombre'];
			$telcliente = $clienterap['telefono'];
			$poblacioncliente = $clienterap['Poblacion'];
			$rapsql = $clienterap['Rap'];
			$callesql = $clienterap['Calle'];
			$intsql = $clienterap['numerointerior'];
			$extsql = $clienterap['numeroexterior'];
			$colsql = $clienterap['Colonia'];
		}

		//Guardamos el nombre del cliente en una variable
		$clienteNombre = $nombrecliente;

		//Mostramos los datos de la consulta
		echo "<h3><p>Cliente: ".$nombrecliente."</p></h3>";
		echo "<h3><p>Tel.: ".$telcliente."</p></h3>";
		echo "<h3><p>Poblacion: ".$poblacioncliente."</p></h3>";

		//Creamos una tabla en html con los campos de la tabla mysql
		echo "<table border='2'><tr><td>Cantidad</td><td>Empaque</td><td>Descripcion</td><td>Clave Articulo</td><td>P.U.</td><td>Total</td></tr>";
		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$sqlarticulos = mysql_query("SELECT * FROM articulos;");
	
		$cont = 0;
		//Dentro de un while creamos un array y llenamos la tabla
		while($articulos=mysql_fetch_array($sqlarticulos))
		{
			//$nombre = "cantidad".$cont;  //Se crea el nombre del input text concatenando cantidad con el número de campos
			//$cantidad[] =2;	//Guardamos la cantidad en un array
			$nombre[] = "cantidad".$cont;
			//Variable para guardar el valor del empaque
			$empaque[$cont] = $articulos['paq'];
			//Variable para guardar el valor de descripcion
			$descripcion[$cont] = $articulos['descripcion'];
			//Variable para guardar el valor de clavearticulo
			$clavearticulo[$cont] = $articulos['clavearticulo'];
			
			//Obtenemos el nombre del array y lo guardamos en $name
			$name = $nombre[$cont];
			//obtenemos la cantidad del campo si el registro cambio
			if(isset($_POST[$name]))
			{
				$valor = $_POST[$name];
				$cantidad[$cont] = $_POST[$name];
			}
			//$cantidad[] = 0;
			echo"<tr>";
			//echo"<td><input type='text' name='".$nombre[$cont]."' value='".$cantidad[$cont]."' size='2' onchange='submit()' /></td>";
			echo"<td><input type='text' name='".$nombre[$cont]."' value='".$cantidad[$cont]."' size='2' /></td>";
			echo"<td>".$articulos['paq']."</td>";
			echo"<td>".$articulos['descripcion']."</td>";
			echo"<td>".$articulos['clavearticulo']."</td>";
			if($lista == 1)
			{
				//Seleccionamos la lista de precios de acuerdo al cliente
				echo"<td>".$articulos['l1']."</td>";
				$pu[$cont] = $articulos['l1'];
				$subtotal[$cont] = ($cantidad[$cont] * $empaque[$cont]) * $pu[$cont];
				$grantotal = $grantotal + $subtotal[$cont];
				echo"<td>".$subtotal[$cont]."</td>";
			}
			elseif($lista == 2)
			{
				//Seleccionamos la lista de precios de acuerdo al cliente
				echo"<td>".$articulos['l2']."</td>";
				$pu[$cont] = $articulos['l2'];
				$subtotal[$cont] = ($cantidad[$cont] * $empaque[$cont]) * $pu[$cont];
				$grantotal = $grantotal + $subtotal[$cont];
				echo"<td>".$subtotal[$cont]."</td>";
			}
			elseif($lista == 3)
			{
				//Seleccionamos la lista de precios de acuerdo al cliente
				echo"<td>".$articulos['l3']."</td>";
				$pu[$cont] = $articulos['l3'];
				$subtotal[$cont] = ($cantidad[$cont] * $empaque[$cont]) * $pu[$cont];
				$grantotal = $grantotal + $subtotal[$cont];
				echo"<td>".$subtotal[$cont]."</td>";
			}
			elseif($lista == 4)
			{
				//Seleccionamos la lista de precios de acuerdo al cliente
				echo"<td>".$articulos['l4']."</td>";
				$pu[$cont] = $articulos['l4'];
				$subtotal[$cont] = ($cantidad[$cont] * $empaque[$cont]) * $pu[$cont];
				$grantotal = $grantotal + $subtotal[$cont];
				echo"<td>".$subtotal[$cont]."</td>";
			}
			elseif($lista == 5)
			{
				//Seleccionamos la lista de precios de acuerdo al cliente
				echo"<td>".$articulos['l5']."</td>";
				$pu[$cont] = $articulos['l5'];
				$subtotal[$cont] = ($cantidad[$cont] * $empaque[$cont]) * $pu[$cont];
				$grantotal = $grantotal + $subtotal[$cont];
				echo"<td>".$subtotal[$cont]."</td>";
			}
			echo"</tr>";
			$cont++;	//Variable para llevar la cuenta del número de campos
		}
		//Calculamos el iva
		$iva = $grantotal * .16;
		$totalfinal = $grantotal + $iva;
		echo "</table>";
		echo "<hr />";
		//Creamos otra tabla para el gran total
		echo "<table style= 'background-color:lightblue;' border='1' width='50%' cellpadding='4' cellspacing='3'>";
		echo "<tr>";
		echo "<th colspan='2'><br><H3>Gran Total</H3>";
		echo "</th>";
		echo "</tr>";
		echo "<tr>";
		//Fila para que aparezca el texto
		echo "<td>Sub Total: </td>";
		//Sacamos la suma de todos los totales
		echo"<td>$".$grantotal."</td>";
		echo "</tr>";
		echo "<tr><td>I.V.A. :</td>";
		echo "<td>$".$iva."</td></tr>";
		echo "<tr><td>TOTAL :</td>";
		echo "<td>$".$totalfinal."</td></tr>";
		echo "</table>";
	}
	//Botón para realizar los calculos de las cantidades
	echo"<br>";
	echo"<br>";
	echo"<h3>Clave del Usuario: ".$asesorclave."</h3>";
	echo"<h3>Calcular Pedido  </h3>"; 
	echo"<input name='Recargar' type='submit' value='Calcular pedido' onchange='submit()' />";

	//Si el Rap del cliente esta asignado mostramos el boton de enviar pedido o borrar pedido
	if($rap != "" && $grantotal != 0)
	{
		//Generamos el radio button
		echo "<br>";
		echo'<h3><p>Seleccionar las condiciones de pago: <input type="radio" name="condiciones" value="Contado">Contado<input type="radio" name="condiciones" value="Credito">Credito</p></h3>';
		echo"<br>";
		echo'<h3><p>Entrega: <textarea rows="5" name="entrega" cols="50"></textarea></h3>';
		echo"<br>";
		echo '<h3><p>Observaciones: <textarea rows="5" name="observaciones" cols="50"></textarea></h3>';
		echo"<br>";
		echo '<h3><p>Escriba el correo del cliente: <input type="text" name="Correo" value="" size="30"></p></h3>';
		echo"<br>";
		echo"<br>";
		echo"<input name='enviarpedido' type='submit' value='Enviar pedido' />";
		echo"<input name='borrarpedido' type='submit' value='Borrar pedido' />";
	}

	//Capturamos el estado del radio
	if(isset($_POST['condiciones']))
	{
		$condiciones = $_POST['condiciones'];
	}

	//Capturamos el estado de entrega textarea
	if(isset($_POST['entrega']))
	{
		$entrega = $_POST['entrega'];
		$entrega = utf8_encode($entrega);
	}

	//Capturamos el estado de observaciones textarea
	if(isset($_POST['observaciones']))
	{
		$observaciones = $_POST['observaciones'];
		$observaciones = utf8_encode($observaciones);
	}

	//Capturamos el correo del cliente
	if(isset($_POST['Correo']))
	{
		$correocliente = $_POST['Correo'];
	}

	//Enviamos el la alta del pedido si el botón fue presionado
	if(isset($_POST['enviarpedido']))
	{
		//Capturamos la fecha
		//$fecha = date("d/m/Y"); **********************************************************
		$fecha = date("Y/m/d");
		//$nfecha = date("dmy");  **********************************************************
		$nfecha = date("ymd");
		//Generamos el id del pedido
		$idpedido = 0;
		
		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$sqlasesor = mysql_query("SELECT * FROM usuarios where clave = '$asesorclave';");
		
		//Recibimos la consulta y la pasamos de un array a una variable local
 		while($usuariosasesor = mysql_fetch_array($sqlasesor))
		{
			$clvasesor = $usuariosasesor['clave'];
			$nombreasesor = $usuariosasesor['nombre'];
			$correoasesor = $usuariosasesor['correo'];
		}	
		//Generamos la clave del pedido
		$clavepedido = $clvasesor.$rap.$nfecha;

		//$clavepedido = $rap
		
		//Incluimos la clase de PHPExcel
		require_once dirname(__FILE__) . '/../www/Classes/PHPExcel.php';

		// Creamos el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		//Guardamos el nombre del usuario en una variable
		$usr = $nombreasesor;
		$titulo = $clavepedido;

		//Asignación de propiedades
		$objPHPExcel->getProperties()
					->setCreator($usr)
					->setLastModifiedBy($usr)
					->setTitle($titulo)
					->setSubject("Nuevo Pedido")
					->setKeywords("Pedidos")
					->setCategory("Pedidos Servidor");

		$tituloHoja = "No. Pedido: ".$titulo;
		//$tituloColumnas = array('Cantidad', 'Empaque', 'Descripción', 'Clave Articulo', 'P.U.', 'Sub Total');
		$tituloColumnas = array('Clave Articulo', 'Cantidad total de piezas', 'No. de paquetes', 'Piezas por Paquete','Descripción', 'P.U.', 'Sub Total');

		//Agregamos los titulos a la hoja de Excel
		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A1:G1');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A2:G2');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A3:G3');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A4:G4');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A5:G5');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A6:G6');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A7:G7');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A8:G8');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A9:G9');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A10:G10');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A11:G11');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A12:G12');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A13:G13');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A14:G14');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A15:G15');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A16:G16');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A17:G17');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A18:G18');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A19:G19');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A20:G20');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A21:G21');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A22:G22');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A23:G23');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A24:G24');

		$objPHPExcel->setActiveSheetIndex(0)
					->mergeCells('A25:G25');

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$nombrecliente)
					->setCellValue('A2','Rap:')
					->setCellValue('A3',$rapsql)
					->setCellValue('A4',$poblacioncliente)
					->setCellValue('A5',$tituloHoja)
					->setCellValue('A6','Asesor: ')
					->setCellValue('A7',$nombreasesor)
					->setCellValue('A8','Total pedido sin iva:')
					->setCellValue('A9',$grantotal)
					->setCellValue('A10','I.V.A.')
					->setCellValue('A11',$iva)
					->setCellValue('A12','Importe Total con IVA:')
					->setCellValue('A13',$totalfinal)
					->setCellValue('A14','Condiciones de pago:')
					->setCellValue('A15',$condiciones)
					->setCellValue('A16','Condiciones de entrega:')
					->setCellValue('A17',$entrega)
					->setCellValue('A18','Observaciones Generales:')
					->setCellValue('A19',$observaciones)
					->setCellValue('A20','Dirección Fiscal:')
					->setCellValue('A21',$callesql)
					->setCellValue('A22',$intsql)
					->setCellValue('A23',$extsql)
					->setCellValue('A24','Colonia:')
					->setCellValue('A25',$colsql)
					->setCellValue('A26',$tituloColumnas[0])	//Clave Articulo
					->setCellValue('B26',$tituloColumnas[1])	//Cantidad total de piezas
					->setCellValue('C26',$tituloColumnas[2])	//No de Paquetes
					->setCellValue('D26',$tituloColumnas[3])	//Piezas por paquete
					->setCellValue('E26',$tituloColumnas[4])	//Descripcion
					->setCellValue('F26',$tituloColumnas[5])	//P.U.
					->setCellValue('G26',$tituloColumnas[6]);	//Sub Total

		//Dentro de un while recorremos el pedido para hacer el query
		$filas = $cont;

		$exc_cont = 27;	//Contador para las filas de Excel

		$rowsCont = 0;

		while($rowsCont <= $filas)
		{
			//Capturamos desde la ultima fila del pedido hasta la primera
			$sqlclavearticulo = $clavearticulo[$rowsCont];
			$totalpzas = $empaque[$rowsCont] * $cantidad[$rowsCont]; //**************
			$sqlcantidad = $cantidad[$rowsCont];
			$sqlpeciounitario = $pu[$rowsCont];
			$sqlimporte = $subtotal[$rowsCont];
			$sqlempaque = $empaque[$rowsCont];
			$sqldescripcion = $descripcion[$rowsCont];
			
			//Imprimimos el query
			if($sqlcantidad != '')
			{
				//Agregamos los datos a la hoja de Excel
				// $objPHPExcel->setActiveSheetIndex(0)
				// 			->setCellValue('A'.$exc_cont, $sqlcantidad)
				// 			->setCellValue('B'.$exc_cont, $sqlempaque)
				// 			->setCellValue('C'.$exc_cont, $sqldescripcion)
				// 			->setCellValue('D'.$exc_cont, $sqlclavearticulo)
				// 			->setCellValue('E'.$exc_cont, $sqlpeciounitario)
				// 			->setCellValue('F'.$exc_cont, $sqlimporte);

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$exc_cont, $sqlclavearticulo)
							->setCellValue('B'.$exc_cont, $totalpzas)
							->setCellValue('C'.$exc_cont, $sqlcantidad)
							->setCellValue('D'.$exc_cont, $sqlempaque)
							->setCellValue('E'.$exc_cont, $sqldescripcion)
							->setCellValue('F'.$exc_cont, $sqlpeciounitario)
							->setCellValue('G'.$exc_cont, $sqlimporte);
				$exc_cont++;

				//Hacemos el query a la tabla
				//echo "<p>Pedido para: ".$clienteNombre."</p>";
				$querypedidos = mysql_query("INSERT INTO pedidos (idpedido,fecha,clavepedido,rap,nombrecliente,clavevendedor,clavearticulo,cantidad,preciounitario,importe) VALUES ('$idpedido','$fecha','$clavepedido','$rap','$clienteNombre','$clvasesor','$sqlclavearticulo','$sqlcantidad','$sqlpeciounitario','$sqlimporte');");
				if(!$querypedidos)
				{
					//Error
					echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
					die('Error al enviar el pedido '.mysql_error());
				}
			}
			$rowsCont++;
		}
		echo "<p>Pedido correcto y enviado el: ".$fecha." al cliente: ".$rap."</p>";
		echo "<br />";

		//Ponemos Auto Size para el ancho de las columnas
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		//Fuera del loop, renombramos la hoja y escribimos el fichero
		$objPHPExcel->getActiveSheet()->setTitle($titulo);

		$objPHPExcel->setActiveSheetIndex(0);

		//Variable para guardar el archivo contiene la direccion, el nombre y la extensión
		$directorio = 'archivos/pedidos/';
		$extension = '.xlsx';
		$filename = $directorio.$titulo.$extension;

		//Objeto para crear el archivo
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($filename);

		//Enviamos el mail con el siguiente código...
		require '/var/www/PHPMailer/PHPMailerAutoload.php'; //Módulo PHPMailer

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

		$mail->addAddress('cesarlopezcortes@me.com');         // Name is optional
		$mail->addAddress('ventas@sylka.com.mx');
		$mail->addAddress('sceballos@sylka.com.mx');
		$mail->addAddress($correoasesor);
		$mail->addAddress($correocliente);
		$prext = '/var/www/';                                 //Dirección de la hoja de excel
		$filedir = $prext.$directorio.$titulo.$extension;

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->addAttachment($filedir);                       // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $nombreasesor.' Pedido No:'.$titulo;
		$mail->Body    = 'Orden de pedido desde<b> http://sylka.ddns.net/inicip.php</b>';
		$mail->AltBody = 'Server running OK!';

		if(!$mail->send()) {
    		echo 'Message could not be sent.';
    		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo"<br>";
    		echo '<h3><p>Correo de pedido enviado correctamente!</p></h3>';
    		echo"</br>";
		}
		
		//Creamos un query para mostrar el pedido enviado
		$sqlpedido = mysql_query("SELECT * FROM pedidos where clavepedido = '$clavepedido';");

		//Si no se realizó la consulta mostramos el error
		if(!$sqlpedido)
		{
			die('Error al ejecutar la counsulta '.mysql_error());
		}

		//Creamos una tabla en html con los campos de la tabla mysql
		echo "<table border='2'><tr><td>Fecha</td><td>Clave del pedido</td><td>Rap</td><td>Clave del Asesor</td><td>Clave del Articulo</td><td>Cantidad</td><td>P.U.</td><td>Importe</td></tr>";

		//Dentro de un while creamos un array y llenamos la tabla
		while ($dato=mysql_fetch_array($sqlpedido)) 
		{
			echo"<tr>";
			echo"<td>".$dato['fecha']."</td>";
			echo"<td>".$dato['clavepedido']."</td>";
			echo"<td>".$dato['rap']."</td>";
			echo"<td>".$dato['clavevendedor']."</td>";
			echo"<td>".$dato['clavearticulo']."</td>";
			echo"<td>".$dato['cantidad']."</td>";
			echo"<td>".$dato['preciounitario']."</td>";
			echo"<td>".$dato['importe']."</td>";
			echo"</tr>";
		}
		echo "</table>";
	}
	//Cerramos la conexion
	//mysql_close();
	//borramos los datos del pedido si el botón fue presionado
	if(isset($_POST['borrarpedido']))
	{
		while($cont != 0)
		{
			$cantidad[$cont]="";
			$cont--;
		}
		//Capturamos la fecha
		$fecha = date("d/m/Y");
		$nfecha = date("dmy");
		//Generamos el id del pedido
		$idpedido = 0;
		
		//Guardamos el usuario de la sesion dentro de una variable		
		$asesor = $_SESSION["usuario"];
		//Guardamos la consulta en $resultado y al mismo tiempo creamos el query mysql
		$sqlasesor = mysql_query("SELECT * FROM usuarios where usuario = '$asesor';");
		
		//Recibimos la consulta y la pasamos de un array a una variable local
 		while($usuariosasesor = mysql_fetch_array($sqlasesor))
		{
			$clvasesor = $usuariosasesor['clave'];
		}	
		//Generamos la clave del pedido
		$clavepedido = $clvasesor.$rap.$nfecha;
		
		echo "<p> Clave".$clavepedido."</p>";
		$borrar = mysql_query("DELETE FROM pedidos WHERE clavepedido = '$clavepedido';");
		if(!$borrar)
		{
			//Error
			echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir y cerrar sesi&oacute;n</div></div></a>';
			die('Error al borrar el pedido '.mysql_error());
		}
		//Cerramos la conexión
		mysql_close();
		//Recargamos la página
		header("location:altapedidosasesor.php");
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