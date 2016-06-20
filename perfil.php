<?php
	include 'seguro.php';
 	include 'conectadb.php';
?>
 <?php
			
			$query="SELECT idusuario, ".
				    "	   CONCAT (nombre, ' ', apellido) nombre,  ".
					"   nombre_area (IdCentroCosto) area, ".
					"   nombrerol (idrol) rol, ".
					"   usuario, ".
					"   date_format(f_registro,'%d-%m-%Y') fecha, ".
					"   login (usu_reg) usu_reg ".
				"  FROM usuarios  ".
                " where idusuario = '".$idusuario."' ";
				$rset=mysql_query($query,$con) or die ("conexion fallida: ".mysql_error());
            //    echo $query; 
				if($line=mysql_fetch_array($rset,MYSQL_ASSOC)){					
					?>
  		<h2>Bienvenido</h2>
  		<h3><?php echo $line['nombre'] ?></h3>
  		<h4><?php echo $line['rol'] ?></h4>
    <!--	<td><?php echo $cont ?></td>
    	<td><?php echo $line['nombre'] ?></td>
        <td><?php echo $line['area'] ?></td>
        <td><?php echo $line['rol'] ?></td>
        <td><?php echo $line['usuario'] ?></td>
        <td><?php echo $line['fecha'] ?></td>
        <td><a href="#" id='<?php echo $line['idusuario'] ?>' class="editar"><span class="glyphicon glyphicon-pencil"></span></a></td>
        <td><a href="#" id='<?php echo $line['idusuario'] ?>' class="eliminar"><span class="glyphicon glyphicon-trash"></a></td>-->
        
        
    

    <?php 
				}
