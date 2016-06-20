<?php
	header('Content-Type: text/html; charset=UTF-8'); 

	include 'seguro.php';
	include 'conectadb.php';

	$i = 0;
?>	
<div class="panel panel-default">    
  	 <table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Fecha</th>
			<th class="text-center">Pedido Nro</th>
			<th class="text-right">Cant</th>
			<th>Articulo</th>
			<th class="text-center">Usuario</th>			
			<th class="text-center"></th>	
		</tr>			
	</thead>	   
	<tbody>	
	
    <?php
    	$query = "select ".
    				"date_format(a.fecha_creacion, '%d-%m-%Y') fecha_creacion, ".
    				"a.idpedido, ".
    				"a.idarticulo, ".
    				"a.idusuario, ".
    				"a.cantidad, ".
    				"b.detalle, ".
    				"c.usuario ".
    			  "from pedido a ".
    			  	" inner join articulos b on ( a.idarticulo = b.idarticulo) ".
    			  	" inner join usuarios c on ( a.idusuario = c.idusuario ) ".
    			  "where a.estado = 'T' and a.idusuario = '".$idusuario."' ";
    	$rset = mysql_query($query, $con);
    	while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)){
    		$i++;
    		echo "<tr>";
    			echo "<td>".$i."</td>";
    			echo "<td>".$line['fecha_creacion']."</td>";
    			echo "<td class='text-center'>".$line['idpedido']."</td>";
    			echo "<td class='text-right'>".$line['cantidad']."</td>";
    			echo "<td class='text-left'>".$line['detalle']."</td>";    			
    			echo "<td class='text-center'>".$line['usuario']."</td>";    			
    			echo "<td><input type='button' value='Cancelar' class='cancelar btn btn-warning'></td>";
    		echo "</td>";
    	}
    ?>    
    </tbody>
  </table>

  <script type="text/javascript">

  $(function(){

    
  })

  </script>
  
</div>  
