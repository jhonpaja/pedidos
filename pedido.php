
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css2/jquery.autocomplete.css" rel="stylesheet">
<script src="js2/jquery.varios.js"></script>
<script src="js2/jquery.autocomplete.js"></script>





<?php
	header('Content-Type: text/html; charset=UTF-8'); 

	include 'seguro.php';
	include 'conectadb.php';
?>	

<script>
	$(function(){
		
		$('#cargar').click(function(event) {
			/* Act on the event */
			cargar_pedido();
		});
		$('#enviar').click(function(event) {
			enviar_pedido();
		});	
		mostrar_detalle();
		
		
		
		$("#nomart").autocomplete('search_articulos.php', {
		minChars: 2,
		width: 535, 		 
		scroll: false,			
		formatResult: function(data, value) {
		return value.split("[")[0];} 
	}).result(function(event, data, formated) { $('#codigo').val(data[1]); });
		
		
		



	});	

	function enviar_pedido(){
		$.ajax({
			url: 'confirmar_pedido.php',
			type: 'POST'
		})
		.done(function(data) {
			console.log("success");
			data = $.trim(data);
			if(data=='1'){
				cargar('pedido.php');
			//	mostrar_detalle();
			}else{
				alert(data);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}

	function mostrar_detalle(){
		$.post('detalle_pedido.php',  function(data, textStatus, xhr) {
			/*optional stuff to do after success */
			$('#detalle_pedido').html(data);
		});
	}

	function cargar_pedido(){

		$.ajax({
			url: 'grabar_pedido.php',
			type: 'POST',			
			data: $('#datos_pedido').serialize()
		})
		.done(function(data) {
			console.log("success");
			data = $.trim(data);
			if(data=='1'){
			//	cargar('pedido.php');
				mostrar_detalle();
				$('#nomart').val('');
			}else{
				alert(data);
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
<style>
	.input-label{
		border: none !important;
		box-shadow: none !important;
	}
</style>
    
<div class="panel panel-default">
  <div class="panel-heading">Nuevo Pedido</div>	  
  <div class="panel-body">
  		<form class="form-horizontal" name="datos_pedido" id="datos_pedido">
  		  <div class="form-group">
		    <label for="inputCantidad" class="col-sm-2 control-label">Origen</label>
		    <div class="col-sm-10">
		    <?php

		    	$query = "select idcentrocosto, nombre from centrocosto where idcentrocosto = '".$ccusuario."' ";
	      		$rset	= mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
	      		if ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {			
	      			echo "<input type='text' class='form-control input-label' value='".$line['nombre']."'> ";	
	      		}
		    ?>	
		    </div>
		  </div>
		  <!---------------------->  	
		  <div class="form-group">
		    <label for="inputCantidad" class="col-sm-2 control-label">Destino</label>
		    <div class="col-sm-10">
		    	<input type='text' class='form-control input-label' value='LOGISTICA'>
		    </div>
		  </div>  
		 
          
          <!---------------------->
          
          <div class="form-group">
          	<label for="inputArticulo" class="col-sm-2 control-label">Articulo</label>
            <div class="col-sm-6">
            	<input type="text" id="nomart" name="nomart" class="form-control"  />
                <input type="hidden" id="codigo" name="codigo"  />
                
            </div>
          
          </div>
		  <!---------------------->  
		  <div class="form-group">
		    <label for="inputCantidad" class="col-sm-2 control-label">Cantidad</label>
		    <div class="col-sm-6">
		      <input type="number" min="0" step="1" pattern="[0-9]{10}" class="form-control" value="1" id="inputCantidad" name="inputCantidad" placeholder="Cantidad">
		    </div>
		  </div>
		  <!---------------------->  
		<!--
          <div class="form-group">
		    <label for="id_origen" class="col-sm-2 control-label">Origen</label>
		    <div class="col-sm-10">
		      
		      <select class="form-control" name="id_origen" id="id_origen">	
		      <?php
		      		$query = "select idcentrocosto, nombre from centrocosto order by nombre";
		      		$rset	= mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
		      		while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {		
						$i++;
						echo "<option value='".$line['idcentrocosto']."'>".$line['nombre']."</option>";						
					}	
		      ?>	
		      </select>whil
		    </div>
		  </div>
          
          -->
		  <!----------------------> 
		  <div class="form-group">
		    <label for="inputObs" class="col-sm-2 control-label">Observacion</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" id="inputObs" name="inputObs" placeholder="Observacion">
		    </div>
		  </div>
		  <!----------------------> 
          <!--
		  <div class="form-group">
		    <label for="inputReferencia" class="col-sm-2 control-label">Referencia</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputReferencia" name="inputReferencia" placeholder="Referencia">
		    </div>
		  </div>-->
		  <!----------------------> 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="button"  class="btn btn-default" id="cargar" value="Agregar">
		    </div>
		  </div>
		  <!----------------------> 		 		
		  <div id="detalle_pedido">
		  </div>		
		  <!----------------------> 
		  <div class="form-group">
		     <div class="col-sm-offset-2 col-sm-10">
		       <input type="button"  class="btn btn-primary" id="enviar" value="Enviar Pedidos">
		     </div>
		   </div>
		</form>
        
      
  </div>
</div>

