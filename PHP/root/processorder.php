<html>
<?php
	// create short variable names
	$tireqty = $_POST['tireqty'];
	$oilqty = $_POST['oilqty'];
	$sparkqty = $_POST['sparkqty'];
	$totalqty = 0;
	$totalamount = 0.00;
?>
<head>
	<title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob’s Auto Parts</h1>
<h2>Order Results</h2>
<?php
	echo "<p>Ordén procesada a las: ";
	echo date('H:i, jS F Y');
	echo "</p>";
	
	echo '<p> La orden es: </p>';
	echo $tireqty.' Llantas<br />';
	echo $oilqty.' Aceite<br />';
	echo $sparkqty.' bujias<br />';

	echo "<p>Cantidad total: ";
	echo $totalqty = $tireqty + $oilqty + $sparkqty;
	phpinfo();
?>
</body>
</html>
