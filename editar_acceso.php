<script>
	function grabar_acceso(){
		//alert('hoa');;
		$.ajax({
			url: 'grabar_acceso.php',
			type: 'POST',
			//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: $('#datos_acceso').serialize()
		})
		.done(function(data) {
			console.log("success");
			data = $.trim(data);
			if (data=="1") {
				cargar('acceso.php');
			};	
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

	$id_acceso  = "";
	$nombre 	= "";
	$id_grupo 	= "";
	$url  		= "";
	$tipo		= "U";

	if (isset($_GET['id_acceso'])){
		$id_acceso = $_GET['id_acceso'];
		$query = "select idgrupo, nom_acceso, url from accesos where idacceso = '".$id_acceso."' ";
		$rset = mysql_query($query, $con);

		if( $line = mysql_fetch_array($rset, MYSQL_ASSOC)){
			$nombre 	= $line['nom_acceso'];
			$id_grupo 	= $line['idgrupo'];
			$url 		= $line['url'];
		}	
	}

	if(isset($_GET['tipo'])){
		$tipo = $_GET['tipo'];
	}
	



	
	//echo $id_grupo;
?>	
<div class="panel panel-default">
  <div class="panel-heading">Editar Acceso</div>	  
  <div class="panel-body">  			
		<form class="form-horizontal" name="datos_acceso" id="datos_acceso">
		  <div class="form-group">
		    <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>
		    <div class="col-sm-10">
			<?php
				echo "<input type='hidden' id='id_acceso' name='id_acceso' value='".$id_acceso."'> 
				";
				echo "<input type='hidden' id='tipo' name='tipo' value='".$tipo."'> 
				";
				echo "<input type='text' class='form-control' id='nombreAcceso' name='nombreAcceso' placeholder='Nombre' value ='".$nombre."' >";
			?>
		    	
		    </div>
		  </div>	
		  <div class="form-group">
		    <label for="selectGrupo" class="col-sm-2 control-label">Grupo</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="selectGrupo" name="selectGrupo">
				<?php
					$query = "select idgrupo, upper(nom_grupo) nom_grupo from grupo";
					$rset = mysql_query($query, $con);
					while($line = mysql_fetch_array($rset, MYSQL_ASSOC)){						
						echo "<option value='".$line['idgrupo']."' ";
						if($line['idgrupo']==$id_grupo){
							echo "selected";
						}
						echo ">".$line['nom_grupo']."</option>";
					}
				?>
				</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputUrl" class="col-sm-2 control-label">Url</label>
		    <div class="col-sm-10">
				<input type="text" class="form-control" id="inputUrl" name="inputUrl" placeholder="Url" value="<?php echo $url;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="button"  class="btn btn-primary" id="enviar" onclick="grabar_acceso()"  value="Grabar">
		    </div>
		  </div>
		</form>      		
  </div>
</div>  		