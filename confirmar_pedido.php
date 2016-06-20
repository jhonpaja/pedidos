<?php
	
	include 'seguro.php';
	include 'conectadb.php';

	$query = "update pedido set estado = '0' where idusuario = '".$idusuario."' ";
	//mysql_query($query, $con) or die( mysql_error());

	if (mysql_query( $query, $con )) {
	    echo "1";
	} else {
	    echo "Error: " . $query . "<br>" . mysql_error($con);
	}		

?>