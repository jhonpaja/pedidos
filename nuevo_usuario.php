<html>
<head>
<?php 

	header('Content-Type: text/html; charset=UTF-8'); 
	include 'seguro.php';
	include 'conectadb.php';



?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>


<body>
<div class="container">
<br>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Nuevo Usuario</strong></div>
    <div class="panel-body">
<br>

<form class="form-horizontal" id="datos1">
	<div class="form-group">
		<label class="control-label col-md-2" for="nombre">Nombre:</label>
	<div class="col-lg-3 col-md-10">	
		<input type="text" class="form-control letras" id="nombre" name="nombre"  placeholder="nombre" required="required"></input>
        
       
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Apellido:</label>
	<div class="col-lg-3 col-md-10">
		<input type="text" class="form-control letras" id="apellido" name="apellido" placeholder="Apellido" required="required" ></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Correo Electronico:</label>
	<div class="col-lg-3 col-md-10">
		<input type="email" class="form-control correo" id="correo" name="correo" placeholder="email" ></input>
	</div>

	</div>
	<div class="form-group">
	<label class="control-label col-md-2">Usuario:</label>
	<div class="col-lg-3 col-md-10">
		<input type="text" class="form-control letras" id="usuario" name="usuario" placeholder="usuario" required="required"></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Clave:</label>
	<div class="col-lg-3 col-md-10">
        <input type="password" class="form-control" name="prueba" id="prueba" placeholder="Ingrese clave" required="required"></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Telefono:</label>
	<div class="col-lg-3 col-md-10">
		<input type="fono" class="form-control" id="telefono"  name="telefono" placeholder="telefono" required="required"></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Area:</label>
	<div class="col-md-10">
		<select class="form-control" id="centrocosto"  name="centrocosto">
        <option value="0">[ELEGIR CENTRO DE COSTO]</option>
			<?php
				$query="select idcentrocosto,nombre from centrocosto order by nombre ";
				$rset=mysql_query($query,$con) or die("consulta fallida: ".mysql_error());
				while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
					
					echo "<option value='".$line['idcentrocosto']."'>".$line['nombre']."</option>";
					}	
			
			
			?>


		</select>
	</div>

	</div>

		<div class="form-group">
	<label class="control-label col-md-2">Roles:</label>
	<div class="col-md-10">
		<select class="form-control" id="rol"  name="rol">
			<option value="N">[ELEGIR ROL]</option>
            <?php 
			
			$query="select idrol,nom_rol from roles order by nom_rol ";
			$rset=mysql_query($query,$con) or die("conexion fallida: ".mysql_error());
			while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
				
				
				echo "<option value='".$line['idrol']."'>".$line['nom_rol']."</option>";
				}
			
			?>
			


		</select>
	</div>

	</div>

	<div class="form-group">
		<div class="col-lg-9 col-md-2 col-lg-offset-2">
			<input type="button" class="btn btn-primary" id="btnenviar" value="Guardar"/>
</div>
		</div>
        </div>

	</div>


</form>

</div>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){


          $('input[class$="numerico"]').keyup(function () {
             this.value = soloNumerico.valor(this.value);
          });
         
          $('input[class$="letras"]').keyup(function () {
             this.value = soloLetras.valor(this.value);
          });
         
          $('input[class$="email"]').keyup(function () {
             this.value = email.valor(this.value);
          });

         $('input[class$="alfanumerico"]').keyup(function () {
        	 this.value = soloAlfanumerico.valor(this.value);
          });


	$("#btnenviar").click(function(){
		$.post('grabar_usuario.php',$("#datos1").serialize(),function(data){
			alert('Usuario Registrado');
			
			
			})

		
		})
	
	})





</script>

</body>


</html>