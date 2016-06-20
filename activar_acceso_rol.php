<?php
	include 'seguro.php';
	include 'conectadb.php';

	if(isset($_POST['id_rol'])){ $id_rol=$_POST['id_rol']; }else{ $id_rol="X"; }
	if(isset($_POST['id_acceso'])){ $id_acceso=$_POST['id_acceso']; }else{ $id_acceso="X"; }
	if(isset($_POST['tipo'])){ $tipo=$_POST['tipo']; }else{ $tipo="X"; }

	if($tipo == 'D'){
		$query="delete from roles_accesos where idacceso='".$id_acceso."' and idrol = '".$id_rol."'";
		//echo $query;
		if (mysql_query( $query, $con )) {
			    echo "1";
		} else {
		    echo "Error: " . $query . "<br>" . mysql_error($con);
		}		
	}

	if($tipo == 'I'){
		$query="insert into roles_accesos ( idrol, idacceso, idusuario_regist, estado ) values ( '".$id_rol."', '".$id_acceso."', '".$idusuario."', '1') ";
		//echo $query;
		if (mysql_query( $query, $con )) {
			    echo "1";
		} else {
		    echo "Error: " . $query . "<br>" . mysql_error($con);
		}		
	}


?>	