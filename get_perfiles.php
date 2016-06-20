<?php

include 'conectadb.php';

	if(!isset($_REQUEST['q']))
	exit();
	


$query= " select idrol, ".
	   "	   nom_rol ". 
	   "	  FROM roles ".
	 "	where nom_rol like '".$_REQUEST['q']."%' or idrol like '".$_REQUEST['q']."%' ";
	 $rset=mysql_query($query,$con) or die ("conexion fallida :".mysql_error());
	 while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
		 
		   echo  $line['nom_rol']."|".$line['idrol']."\n ";
		 
		 }

//echo $query;

?>