<?php
include 'seguro.php';
include 'conectadb.php';



	if(isset($_GET['f_codigo_usu'])){

        $iduser=$_GET['f_codigo_usu'];
    }else{
		$iduser="X";
	}

    if(isset($_GET['f_texto'])){

        $texto=$_GET['f_texto'];
    }else{
        $texto="X";
    }

//echo $iduser
//echo $texto;

 $cont=0;

?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<HR>
<table class="table table-hover">
<thead>
	<tr>
    	<th>#</th>
    	<th>Nombre</th>
        <th>&Aacute;rea</th>
        <th>Rol</th>
        <th>Usuario</th>
        <th>Email</th>
        <th></th>
    </tr>
   </thead>
    
    <?php
			
			$query= " SELECT idusuario, ".
				    "	   CONCAT (nombre, ' ', apellido) nombre,  ".
					"   nombre_area (IdCentroCosto) area, ".
					"   nombrerol (idrol) rol, ".
					"   usuario, ".
                    "   correo, ".
					"   date_format(f_registro,'%d-%m-%Y') fecha, ".
					"   login (usu_reg) usu_reg ".
				"  FROM usuarios ";
				if($iduser != "X"){
					$query .="where idusuario ='".$iduser."' ";
				}
                if($texto != "X"){
                    $query .="where CONCAT (nombre, ' ', apellido) like '%".$texto."%' ";
                }
				
			//	echo $query;
				$rset=mysql_query($query,$con) or die ("conexion fallida: ".mysql_error());
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
        <td><?php echo $line['correo'] ?></td>
        <td><input type='button' dir="<?php echo $line['idusuario'] ?>" class='editar btn btn-xs btn-primary btn-sm"' value='Editar'></td>
        <td><input type='button' dir="<?php echo $line['idusuario'] ?>" class='eliminar btn btn-xs btn-danger btn-sm"' value='Eliminar'></td>
    </tr>
    <?php 
				}
	?>
	</tbody>
</table>

<script>
    $(function(){
        $('.eliminar').click(function(event) {
            id_usux = $(this).attr('dir');
            //alert(id_acceso);
            $.post('del_usuario.php', { f_id_usu: id_usux }, 
                function(data, textStatus, xhr) {
                data = $.trim(data);
                if(data=='1'){
                     cargar('lista_usuario.php');
                }
            });
           
        });

        
        $('.editar').click(function(event) {  
				idx = $(this).attr('dir');        
            cargar('editar_usuario.php?f_id='+idx);
        });
    })


    </script>

