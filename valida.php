

<?php

	include 'conectadb.php';

	$login 		= $_POST["inputLogin"];
	$password 	= $_POST["inputPassword"]; /**md5hash**/
	$idusuario  = "";
	$ccusuario	= "";
	$rol		= "";
	$i=0;

	$query 	= "select usuario, clave, idusuario, idcentrocosto, idrol from usuarios where usuario = '$login' and clave = md5('$password') " ;
	$rset	= mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());

	//echo $rset;

	if (!$rset) {
	    echo "Error de BD, no se pudo consultar la base de datos\n";
	    echo "Error MySQL: ";
	    mysql_error();
	    exit;
	}

	

	while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {		
		$i++;
		$idusuario = $line['idusuario'];
		$ccusuario = $line['idcentrocosto'];
		$rol	   = $line['idrol'];
		//echo $line['usuario'];
		//echo "\n";
	}	

	if($i<1){
		echo "Usuario o clave incorrecta";
		header("Location: index.php?err=1");
		exit;
	}else{ 
		//header("Location: main.php");
		session_start();
		$_SESSION['login'] = $login;
		$_SESSION['idusuario'] = $idusuario;
		$_SESSION['ccusuario'] = $ccusuario;
		$_SESSION['rol'] = $rol; 
		

		echo "<meta http-equiv='Refresh' content='0;url=main.php'>";
	}

	mysql_free_result($rset);


	mysql_close($con);
?>	

