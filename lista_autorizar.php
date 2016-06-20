
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	header('Content-Type: text/html; charset=UTF-8'); 

	include 'seguro.php';
	include 'conectadb.php';

	$i = 0;
	//$idarea_orig=$area;
?>	

<script>
	$(function(){
		$('.autorizar').click(function(event) {
			id_pedido = $(this).attr('dir');			
			autorizar(id_pedido);			
		});
	})

	function autorizar(id_pedido){
		//alert(id_pedido);
		$.ajax({
			url: 'autorizar.php',
			type: 'POST',
			//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: { 
				id_pedido: id_pedido,
				tipo_aut : '0' 
			},
		})
		.done(function() { 
			console.log("success");
			data=$.trim(data);
			if(data=="1"){
			cargar('listar_autorizar.php');
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

<div class="panel panel-default">
  <div class="panel-heading" align="center"><h4>Pedidos Solicitados para Autorizar por Jefe de Area</h4></div>	  
<!--  <div class="panel-body">

  </div>-->
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
    			  "where a.estado = '0' and id_area_origen='".$ccusuario."' ";
				 // echo $query ;
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
    			echo "<td><input type='button' value='Autorizar' dir='".$line['idpedido']."' class='btn btn-success autorizar'> &nbsp;";
    			echo "<input type='button' value='Anular' class='btn btn-danger'></td>";
    		echo "</td>";
    	}
    ?>    
    </tbody>
  </table>
</div>  
