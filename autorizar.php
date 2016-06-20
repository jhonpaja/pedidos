<?php

	include 'seguro.php';
	include 'conectadb.php';

	$id_pedido 	= $_POST["id_pedido"]; 
	$tipo_aut	= $_POST["tipo_aut"]; 

	$query = "insert into autorizacion  ( ".
			 "  idusuario, idpedido, tipo_aut  ".
			 " ) values ( ".
			  $idusuario.", ".$id_pedido.", '".$tipo_aut."' )";
	if (mysql_query( $query, $con )) {
	    echo "1";
	} else {
	    echo "Error: " . $query . "<br>" . mysql_error($con);
	}

?>	