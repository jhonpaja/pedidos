<?php

	include 'seguro.php';
	include 'conectadb.php';

	$id_articulo 	= $_POST["codigo"]; 
	$cantidad 		= $_POST["inputCantidad"];
	$id_origen 		= $ccusuario;  //$_POST["id_origen"];
	$obs			= $_POST["inputObs"];
	//$refe			= $_POST["inputReferencia"];
	$trabas			= 0;

	$query = "select stock_act from articulos where idarticulo = $id_articulo ";
	$rset	= mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
	if ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {	
		$stock_act = $line['stock_act'];
	}	

	if($stock_act < $cantidad){
		echo "Error : No hay stock suficiente";
		$trabas++;
	}


	if($trabas==0){
		$query = "insert into pedido ".
				 " ( idarticulo, idusuario, id_area_origen, id_area_dest, ".
				 "	 cantidad, observacion  ".
				 " ) values ( ".
				 " ".$id_articulo.", ".$idusuario.", '".$id_origen."', '20118', ".$cantidad.", '".$obs."' )";
		//mysql_query($query, $con) or die( mysql_error());

		if (mysql_query( $query, $con )) {
		    echo "1";
		} else {
		    echo "Error: " . $query . "<br>" . mysql_error($con);
		}		
	}	

?>	