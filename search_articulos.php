<?php
header('Content-Type: text/html; charset=UTF-8'); 

	
	include 'conectadb.php';
	
	if(!isset($_REQUEST['q']))
	exit();
	
	$query = "select concat(idarticulo,'-',detalle,'-','[stock:',stock_act,']') nombre,IdArticulo from articulos  where detalle like '".$_REQUEST['q']."%' or idarticulo like '".$_REQUEST['q']."%' 
			  order by nombre ";
		      		$rset	= mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
		      		while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {		
						
						echo  $line['nombre']."|".$line['IdArticulo']."\n ";						
					}	
	
	
	
	
?>