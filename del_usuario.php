<?php
include 'seguro.php';
include 'conectadb.php';




if(isset($_POST['f_id_usu'])){
	$id=$_POST['f_id_usu'];

$query="delete from usuarios where idusuario='".$id."' ";
//echo $query;
if (mysql_query( $query, $con )) {
	    echo "1";
	} else {
	    echo "Error: " . $query . "<br>" . mysql_error($con);
	}		
}

?>