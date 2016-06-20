<?php

	header('Content-Type: text/html; charset=UTF-8'); 
	include 'seguro.php';
	include 'conectadb.php';
	
	$idcencos	= $_POST['centrocosto']; echo "$idcencos";
	$idrol		= $_POST['rol'];
	$nombre		= $_POST['nombre'];
	$apellido	= $_POST['apellido']; echo "$apellido";
	$usuario	= $_POST['usuario'];
	$clave		= $_POST['prueba'];echo "$clave";
	$telf		= $_POST['telefono'];
	$correo		= $_POST['correo'];
	$idusu		= $idusuario;
	

	$query="insert into usuarios 	". 
			"		(IdUsuario, 	". 
			"		IdCentroCosto, 	". 
			"		IdRol, 			".
			"		nombre, 		".
			"		apellido,  		".
			"		usuario, 		".
			"		clave,  		".
			"		telefono, 		".
			"		correo, 		".
			"		usu_reg ".
			"		) 		".
		"	values ".
			"		(	NULL, ". 
			"			'".$idcencos."',	". 
			"			'".$idrol."',		".
			"			'".$nombre."',		".
			"			'".$apellido."', 	". 
			"			'".$usuario."', 	".
			"			md5('".$clave."'),  		".
			"			'".$telf."',  	 	".
			"			'".$correo."', 		".
			"			'".$idusu."' 		".
			"		) ";
	if(mysql_query($query,$con)){
		echo "1";
		
		}else{
			echo "Error: " . $query . "<br>" . mysql_error($con);
			
			}





?>