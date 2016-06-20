<?php
	$rset = "";
	$hostname 		= "localhost";
	$nombreUsuario  = "root";
	$contraseña 	= "admin";
	$con = @mysql_connect($hostname, $nombreUsuario, $contraseña) or die("no se pudo conectar : " . mysql_error());
	mysql_select_db("pedidosdb", $con) or die( "Error no es posible establecer la conexion" );


	if (!mysql_select_db('pedidosdb', $con)) {
	    echo 'No pudo seleccionar la base de datos';
	    exit;
	}
?>