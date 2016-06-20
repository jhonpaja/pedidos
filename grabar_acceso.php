<?php

	include 'seguro.php';
	include 'conectadb.php';

	$id_acceso = "";

	if (isset($_POST['id_acceso'])){
		$id_acceso 		= $_POST["id_acceso"];
	}		

	$nom_acceso	   	= $_POST["nombreAcceso"];
	$id_grupo 		= $_POST["selectGrupo"];
	$url 			= $_POST["inputUrl"];
	$tipo			= $_POST["tipo"];


	if($tipo=="U"){
	$query = "update  accesos  set ".
				" idgrupo 		= '".$id_grupo."', ".
				" nom_acceso 	= '".$nom_acceso."', ".
				" url			= '".$url."' ".
			  "where idacceso = '".$id_acceso."' ";	
	}elseif ($tipo=="I") {
		$query = "insert into accesos ( idgrupo, nom_acceso, url ) values ( ".$id_grupo.", '".$nom_acceso."', '".$url."' ) ";
	}		  

	if (mysql_query( $query, $con )) {
	    echo "1";
	} else {
	    echo "Error: " . $query . "<br>" . mysql_error($con);
	}	
	
?>
