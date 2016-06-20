<?php
include 'seguro.php';
include 'conectadb.php';



	if(isset($_GET['f_rol'])){

        $xid_rol=$_GET['f_rol'];
    }else{
		$xid_rol="X";
	}

    if($xid_rol == null ){
        $xid_rol="X";
    }
   

    if(isset($_GET['f_texto'])){

        $texto=$_GET['f_texto'];
    }else{
        $texto="X";
    }

//echo "id_rol :".$xid_rol;
//echo $texto;

 $cont=0;

?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<HR>
<table class="table table-hover">
<thead>
	<tr>
    	<th>#</th>    	
        <th>Rol</th>       
        <th class="text-center">Usuarios</th> 
        <th class="text-center" colspan="3">Opciones</th>
    </tr>
   </thead>
    
    <?php
			
			$query= " Select ".
                "  a.idrol, a.nom_rol, b.idrol, ".
                "  SUM(case when b.idrol IS NULL then 0 else 1 END) cant ".
				"  FROM roles a ".
                " left outer join usuarios b on (a.idrol = b.idrol) ";
				if($xid_rol != "X"){
				    $query .="where a.idrol ='".$xid_rol."' ";
				}
                if($texto != "X"){
                  //  $query .="where CONCAT (nombre, ' ', apellido) like '%".$texto."%' ";
                }
				$query .= " group by a.idrol, a.nom_rol, b.idrol order by a.nom_rol ";
			//	echo $query;
				$rset=mysql_query($query,$con) or die ("conexion fallida: ".mysql_error());
				while($line=mysql_fetch_array($rset,MYSQL_ASSOC)){
					$cont++;
					?>
    <tbody>                
    <tr>
    	<td><?php echo $cont ?></td>    	
        <td><?php echo $line['nom_rol'] ?></td>
        <td class="text-center"><?php echo $line['cant'] ?></td>
        <td class="text-center">
            <input type='button' dir="<?php echo $line['idrol'] ?>" role="<?php echo $line['nom_rol']?>" class='usuarios_perfil btn btn-xs btn-warning btn-sm"' value='Usuarios'>
        </td>
        <td class="text-center">
            <input type='button' dir="<?php echo $line['idrol'] ?>" role="<?php echo $line['nom_rol']?>" class='accesos_perfil btn btn-xs btn-success btn-sm"' value='Accesos'>
        </td>
      <!--  <td class="text-center">
            <input type='button' dir="<?php echo $line['idrol'] ?>" class='editar_perfil btn btn-xs btn-primary btn-sm"' value='Editar'>
        </td>
        <td class="text-center">
            <input type='button' dir="<?php echo $line['idrol'] ?>" class='eliminar_perfil btn btn-xs btn-danger btn-sm"' value='Eliminar'>
        </td>-->
    </tr>
    <?php 
				}
	?>
	</tbody>
</table>

<script>
    $(function(){
        $('.eliminar_perfil').click(function(event) {
            id_perfil = $(this).attr('dir');
            //alert(id_acceso);
            $.post('del_pefil.php', { id_perfil: id_perfil }, 
                function(data, textStatus, xhr) {
                data = $.trim(data);
                if(data=='1'){
                     cargar('perfiles.php');
                }
            });
           
        });

        $('.usuarios_perfil').click(function(event) {  
            idx = $(this).attr('dir');   
            name = $(this).attr('role');     
            cargar('usuarios_perfil.php?f_id='+idx+'&nombre='+name);
        });
        
        $('.accesos_perfil').click(function(event) {  
			idx = $(this).attr('dir');        
            name = $(this).attr('role');  
            cargar('accesos_perfil.php?f_id='+idx+'&nombre='+name);
        });
    })


    </script>

