<?php
	//include 'seguro.php';
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
  	
  	<strong>Accesos Perfil</strong></div>
  <div class="panel-body" align="center">
  	<centet><h4><?php echo $nom_rol ?></h4></centet>  	
  	<table class="table table-hover">
      <thead>
      <!--  <th>#</th>
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
                             "     UPPER(a.nom_acceso) nom_acceso, lower(a.url) url, ".
                             "     ifnull(c.IdRolAccesos, 'X') idrol_acceso ".
                             "   from accesos a ".
                             "  inner join grupo b on ( a.idgrupo = b.idgrupo ) ". 
                            "  left outer join roles_accesos c on ( c.idacceso = a.idacceso and c.idrol= '".$idrol."' ) ".
                            // "  left outer join roles_accesos c on ( c.idrol= '".$idrol."' ) ".
                       "   order by a.idgrupo, a.nom_acceso ";                  
                $rset  = mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
             //   echo $query;
                while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {   
                  //echo $line['grupo'];
                  //echo "\n";
                  $x++;
                  $acceso = $line['idacceso'];
                  $acceso_rol = $line['idrol_acceso'];

                  if($acceso_rol=='X'){
                    $off = "danger";
                    $on  = "default";
                  }else{
                    $off = "default";
                    $on  = "success";
                  }
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
                  //  echo "<td><b>".$line['grupo']."</b></td>";
                    echo "<td>".$line['nom_acceso']."</td>";                    
                    echo "<td>".$line['url']."</td>";
                    echo "<td>";
                    echo "<input type='button' role='".$idrol."' id='off_".$acceso."' dir='".$acceso."' class='quitar_rolacceso btn btn-".$off."' value='OFF'>";
                    echo "<input type='button' role='".$idrol."' id='on_".$acceso."' dir='".$acceso."' class='dar_rolacceso btn btn-".$on."' value='ON'>";
                    echo "</td>";
                  echo "</tr>"; 
                  $id_grupo = $line['idgrupo'];
                } 
    ?>
      </tbody>
    </table>
  </div>
</div>
</center>
</div>  
<script>
  $(function(){
    

      $('.quitar_rolacceso').click(function(event) {
          id_acceso = $(this).attr('dir');  
          id_rol  = $(this).attr('role');  
          btn_off = $('#off_'+id_acceso);  
          btn_on  = $('#on_'+id_acceso);  

          $.ajax({
            url: 'activar_acceso_rol.php',
            type: 'POST',           
            data: { id_rol : id_rol, id_acceso : id_acceso, tipo : 'D' },
          })
          .done(function(data) {
            console.log("success");
            if($.trim(data)=='1'){
                btn_off.removeClass('btn-default');
                btn_off.addClass('btn-danger');
                btn_on.removeClass('btn-success');
                btn_on.addClass('btn-default');
            }
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
          
      });

      $('.dar_rolacceso').click(function(event) {
          id_acceso = $(this).attr('dir');  
          id_rol  = $(this).attr('role');  
          btn_off = $('#off_'+id_acceso);  
          btn_on  = $('#on_'+id_acceso);    

          $.ajax({
            url: 'activar_acceso_rol.php',
            type: 'POST',           
            data: { id_rol : id_rol, id_acceso : id_acceso, tipo : 'I' },
          })
          .done(function(data) {
            console.log("success");
            if($.trim(data)=='1'){
                btn_on.removeClass('btn-default');
                btn_on.addClass('btn-success');
                btn_off.removeClass('btn-danger');
                btn_off.addClass('btn-default');
            }
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
          
      });
  })
</script>
