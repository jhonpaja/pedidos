<?php

include 'seguro.php';
include 'conectadb.php';

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="css2/jquery.autocomplete.css" rel="stylesheet">
<script src="js2/jquery.varios.js"></script>
<script src="js2/jquery.autocomplete.js"></script>

</head>


<body onLoad="document.datos4.nombre.focus()">
<div class="container">
<center>	
<div class="panel panel-default">
  <div class="panel-heading" align="center">
  	<strong>Usuarios Registrados</strong></div>
  <div class="panel-body" align="center">
  	<form class="form-inline" role="form" name="datos4">
			<div class="form-group">
				<label for="buscar">Ingrese Nombre:</label>
			</div>
		<div class="form-group">
			<input type="text" name="nombre" id="nombre" class="form-control" value="" size="50"></input>
          <!--  <input type="button" id="buscar" value="Buscar" class="btn btn-primary"/>-->
            <input type="button" id="nuevo" value="Nuevo Usuario" class="btn btn-success"/>
            <input type="hidden" name="f_codigo_usu" id="f_codigo_usu" value="" />
		</div>
       </form> 
  	<div id="cargando" style="display:none; color: red; text-align:center">
  		<img src="images/loading.gif" width="16" height="16" />
  	</div>
  	
	<div id="listado">
	 	
	</div>	
    
  </div>
</div>

</center>




<script type="text/javascript">

$(document).ready(inicializarEvento);

function inicializarEvento(){
	visualizar(0);

	$("#buscar").click(function(){visualizar(2)});
	



	$("#nombre").autocomplete('get_usuarios.php')
					.result(function(event,data,formated){
							$("#f_codigo_usu").val(data[1]);
							visualizar(1)
	});

	$('#nuevo').click(function(event) {
		cargar('nuevo_usuario.php');
	});				

}

function visualizar(tipo){
	//alert(tipo);


   var param='';

   if(tipo=='0' || tipo=='1'){

		$('#cargando').show();
		if(tipo==1) param='f_codigo_usu=' + $('#f_codigo_usu').val();
		$('#listado').empty().load('usuarios.php?'+param,function(){

					$("#cargando").hide();

				});
	}

	if(tipo='2'){
		$('#cargando').show();
		if(tipo==2) param='f_texto=' + $('#nombre').val();
		$('#listado').empty().load('usuarios.php?'+param,function(){

					$("#cargando").hide();

		});
	}

}

function nombre(){
if(event.keyCode==13){

	visualizar(1);
}

}


</script>


</script>

</body>
</html>