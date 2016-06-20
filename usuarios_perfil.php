<?php
	include 'seguro.php';
	include 'conectadb.php';

	if(isset($_GET['f_id'])){ $idrol=$_GET['f_id']; }else{ $idrol="X"; }
	if(isset($_GET['nombre'])){ $nom_rol=$_GET['nombre']; }else{ $nom_rol="X"; }

	//echo $idrol;
	$cont=0;
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<div class="container">
<center>	
<div class="panel panel-default">
  <div class="panel-heading" align="center">
  	
  	<strong>Usuarios Perfil</strong></div>
  <div class="panel-body" align="center">
  	<centet><h3><?php echo $nom_rol ?></h4></centet>  	
  	<table class="table table-condensed">
  		<tr>
  			<th>#</th>
  			<th>nombre</th>
  		</tr>
  		<?php
  			$query = "select idusuario, upper(CONCAT (nombre, ' ', apellido)) nombre from usuarios where idrol = '".$idrol."'";
  			$rset=mysql_query($query,$con) or die ("conexion fallida: ".mysql_error());

			while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){ 
				$cont++;
				echo "<tr>";
					echo "<td>".$cont."</td>";
					echo "<td>".$line['nombre']."</td>";
				echo "</tr>";
			}	
  		?>
  	</table>
  </div>
</div>
</center>
</div>  