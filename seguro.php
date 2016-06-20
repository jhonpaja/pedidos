<?php
	
	session_start();
	if($_SESSION['login']){
		$login = $_SESSION['login'];
		$idusuario = $_SESSION['idusuario']; 
		$ccusuario = $_SESSION['ccusuario']; 
		$rol = $_SESSION['rol'];
		
	}else{
		header("Location: index.php");	
	}

?>