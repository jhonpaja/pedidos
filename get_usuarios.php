<?php

include 'conectadb.php';

	if(!isset($_REQUEST['q']))
	exit();
	


$query="SELECT idusuario, ".
	   "	   CONCAT (nombre, ' ', apellido) nombre ". 
	   "	  FROM usuarios ".
	 "	where nombre like '".$_REQUEST['q']."%' or idusuario like '".$_REQUEST['q']."%' ";
	 $rset=mysql_query($query,$con) or die ("conexion fallida :".mysql_error());
	 while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
		 
		   echo  $line['nombre']."|".$line['idusuario']."\n ";
		 
		 }

//echo $query;

?>