
<script>

	function upd_usu(){
		//alert('hoa');;
		$.ajax({
			url: 'upd_usuario.php',
			type: 'POST',
			//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: $('#datos1').serialize()
		})
		.done(function(data) {
			console.log("success");
			data = $.trim(data);
			if (data=="1") {
				cargar('lista_usuario.php');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}


</script>



<?php


header('Content-Type: text/html; charset=UTF-8'); 

include 'seguro.php';
include 'conectadb.php';

$id			="";
$nombre 	="";
$apellido	="";
$email		="";
$usuario	="";
$clave		="";
$tel		="";
$idcc		="";
$idrol		="";
$tipo		="U";

if(isset($_GET['f_id'])){
	$id=$_GET['f_id'];

			$query= " SELECT idusuario, ".
				    "   nombre, ". 
					"   apellido,  ".
					"   IdCentroCosto, ".
					"   idrol, ".
					"   usuario, ".
					"	clave ,".
					"	correo ,".
					"   telefono, ".
					"   date_format(f_registro,'%d-%m-%Y') fecha, ".
					"   login (usu_reg) usu_reg ".
				"  FROM usuarios ".                                       
				" where idusuario ='".$id."' ";
				$rset=mysql_query($query,$con);

				if($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
					
					$nombre 	=$line['nombre'];
					$apellido	=$line['apellido'];
					$email		=$line['correo'];
					$usuario	=$line['usuario'];
					$clave		=$line['clave'];
					$tel		=$line['telefono'];
					$idcc		=$line['IdCentroCosto'];
					$idrol		=$line['idrol'];
					
					}
}

if(isset($_GET['tipo'])){
		$tipo = $_GET['tipo'];
	}
	
					
		?>
		
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
</head>


<body>
<div class="container">
<br>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Editar Usuario</strong></div>
    <div class="panel-body">
<br>

<form class="form-horizontal" id="datos1">
	<div class="form-group">
		<label class="control-label col-md-2" for="nombre">Nombre:</label>
	<div class="col-lg-3 col-md-10">	
		<input type="text" class="form-control" id="nombre" name="nombre"  placeholder="nombre" value="<?php echo $nombre ?>" ></input>
        <input type="hidden" class="form-control" id="idxusu" name="idxusu"   value="<?php echo $id ?>" ></input>
        
       
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Apellido:</label>
	<div class="col-lg-3 col-md-10">
		<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $apellido ?>"  ></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Correo Electronico:</label>
	<div class="col-lg-3 col-md-10">
		<input type="email" class="form-control" id="correo" name="correo" placeholder="email"  value="<?php echo $email ?>" ></input>
	</div>

	</div>
	<div class="form-group">
	<label class="control-label col-md-2">Usuario:</label>
	<div class="col-lg-3 col-md-10">
		<input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" value="<?php echo $usuario ?>"  ></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Clave:</label>
	<div class="col-lg-3 col-md-10">
        <input type="password" class="form-control" name="prueba" id="prueba" placeholder="Ingrese clave" value="<?php echo $clave ?>" ></input>
	</div>

	</div>

	<div class="form-group">
	<label class="control-label col-md-2">Telefono:</label>
	<div class="col-lg-3 col-md-10">
		<input type="fono" class="form-control" id="telefono"  name="telefono" placeholder="telefono" value="<?php echo $tel?>"></input>
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
					echo "<option value='".$line['idcentrocosto']."' ";
							if($line['idcentrocosto']==$idcc){
								echo "selected";
								}
					
				echo	">".$line['nombre']."</option>";
					}	
			
			
			?>
c

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
				echo "<option value='".$line['idrol']."' ";
					if($line['idrol']==$idrol){
						echo "selected";
						}
				
				
				echo ">".$line['nom_rol']."</option>";
				}
			
			?>
			


		</select>
	</div>

	</div>

	<div class="form-group">
		<div class="col-lg-9 col-md-2 col-lg-offset-2">
			<input type="button" class="btn btn-primary"  onclick="upd_usu()" id="btnenviar" value="Guardar" />
</div>
		</div>
        </div>

	</div>


</form>

</div>

</body>


</html>      