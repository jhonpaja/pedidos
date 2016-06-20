<?php

include 'seguro.php';
include 'conectadb.php';

if(isset($_POST['idxusu'])){
	$idx=$_POST['idxusu'];
	}
	
$nomb =$_POST['nombre'];
$ap =$_POST['apellido'];	
$correo =$_POST['correo'];	
$usu =$_POST['usuario'];	
$pass =$_POST['prueba'];	
$tel =$_POST['telefono'];	
$ccu =$_POST['centrocosto'];	
$urol =$_POST['rol'];
$usu_reg=$idusuario;		


$query="update usuarios  ".
		"		set  ".
				"		IdCentroCosto = '".$ccu."' , ".
				"		IdRol = '".$urol."' ,  ".
				"		nombre = '".$nomb."' , ".
				"		apellido = '".$ap."' , ". 
				"		usuario = '".$usu."' ,  ".
				"		clave = md5('".$pass."') ,  ".
				"		telefono = '".$tel."' , ". 
				"		correo = '".$correo."' , ".
				"		usu_reg = '".$usu_reg."'		".
		"		where ".
		"		IdUsuario = '".$idx."' "; 
		//echo $query;
		if(mysql_query($query,$con)){
			echo "1";
			}else{
				 echo "Error: " . $query . "<br>" . mysql_error($con);
				
				}




?>
