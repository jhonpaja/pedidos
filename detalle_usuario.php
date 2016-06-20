<?php

include 'conectadb.php';


	
	 //if(isset($_POST['codigo']))
	 $a = $_POST['codigo']; echo $a;
	 $b = $_POST['buscar']; echo $b;


$cont=0;




?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
<div class="container">
<br>
<div class="panel panel-default">
	<div class="panel-heading" align="center">Listado de Usuarios Registrados</div>
    <div class="panel-body">

<table class="table table-hover">
<thead>
	<tr>
    	<th>#</th>
    	<th>Nombre</th>
        <th>&Aacute;rea</th>
        <th>Rol</th>
        <th>Usuario</th>
        <th>Fec.Registro</th>
        <th></th>
    </tr>
   </thead>
    
    <?php
			
			$query="SELECT idusuario, ".
				    "	   CONCAT (nombre, ' ', apellido) nombre,  ".
					"   nombre_area (IdCentroCosto) area, ".
					"   nombrerol (idrol) rol, ".
					"   usuario, ".
					"   date_format(f_registro,'%d-%m-%Y') fecha, ".
					"   login (usu_reg) usu_reg ".
				"  FROM usuarios  ".
                " where idusuario = '".$a."' ";
				$rset=mysql_query($query,$con) or die ("conexion fallida: ".mysql_error());
                echo $query; 
				while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
					$cont++;
					?>
    <tbody>                
    <tr>
    	<td><?php echo $cont ?></td>
    	<td><?php echo $line['nombre'] ?></td>
        <td><?php echo $line['area'] ?></td>
        <td><?php echo $line['rol'] ?></td>
        <td><?php echo $line['usuario'] ?></td>
        <td><?php echo $line['fecha'] ?></td>
        <td><a href="#" id='<?php echo $line['idusuario'] ?>' class="editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
        <td><a href="#" id='<?php echo $line['idusuario'] ?>' class="eliminar"><span class="glyphicon glyphicon-trash"></a></td>
        
        
    
    </tr>
    <?php 
				}
	?>
	</tbody>
</table>
</div>
</div>

<script type="text/javascript">

$(function(){
	$(".eliminar").click(function(){
		$.post('del_usuario.php',$(this).attr('id'),function(){
			$("#listado").load('lista_usuario.php');
			})
		
		});
	
	})

</script>

</body>


</html>