<script>
	$(function(){
		$('.editar').click(function(event) {
			id_acceso = $(this).attr('dir');
			//alert(id_acceso);
			cargar('editar_acceso.php?id_acceso='+id_acceso);
		});
		$('.nuevo_acceso').click(function(event) {			
			cargar('editar_acceso.php?tipo=I');
		});
	})
</script>
<style>
  td.head{
    background-color: #4E4E4E;
    color: white;
  }
</style>
<div class="panel panel-default">
  <div class="panel-heading">
	<h4>  	Accesos</h4>
  </div>	  
  <div class="panel-body">
  	<center><button class="btn btn-success nuevo_acceso">Nuevo Acceso</button></center>
  </div>	
  	<table class="table table-hover">
  		<thead>
  		<!--	<th>#</th>
  			<th>Nombre</th>
  			<th>Url</th>
  			<th>Opcion</th>-->
  		</thead>
  		<tbody>
  	<?php
  		header('Content-Type: text/html; charset=UTF-8'); 

		include 'seguro.php';
		include 'conectadb.php';

      $id_grupo = "X";
  		$x=0;
  		$query  =    "select  ".
                             "     a.idacceso, a.idgrupo, UPPER(b.nom_grupo) grupo,  ".
                             "     UPPER(a.nom_acceso) nom_acceso, lower(a.url) url ".
                             "   from accesos a ".
                             "  inner join grupo b on ( a.idgrupo = b.idgrupo ) ". 
                      //       "  left outer join usuario_acceso c on ( c.IdUsuario= '".$idusuario."' ) ".
                			 "   order by a.idgrupo, a.nom_acceso ";                 	
                $rset  = mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
                while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) { 	
                	//echo $line['grupo'];
                	//echo "\n";
                	$x++;
                 /* if($x==1){
                    $id_grupo = $line['idgrupo'];  
                  }*/

                  if($line['idgrupo']!=$id_grupo){
                     echo "<tr>";
                        echo "<td colspan='5' align='center' class='head'><b>".$line['grupo']."</b></td>";
                     echo "</tr>"; 
                     echo "<th>#</th>";
                     echo "<th>Nombre</th>";
                     echo "<th>Url</th>";
                     echo "<th>Opcion</th>";
                  }

                	echo "<tr>";
                		echo "<td>".$x."</td>";
                	//	echo "<td><b>".$line['grupo']."</b></td>";
                		echo "<td>".$line['nom_acceso']."</td>";                		
                		echo "<td>".$line['url']."</td>";
                		echo "<td><input type='button' dir='".$line['idacceso']."' class='editar btn btn-primary' value='Editar'></td>";
                	echo "</tr>";	
                  $id_grupo = $line['idgrupo'];
                }	
  	?>
  		</tbody>
  	</table>

  
</div>  