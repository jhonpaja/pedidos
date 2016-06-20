<?php
	include 'seguro.php';
 	include 'conectadb.php';

	//echo $login;
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sistema de pedidos online</title>

    <!-- Bootstrap core CSS -->
  
    <link href="css/bootstrap.css" rel="stylesheet">
   

  <!-- <link href="css/jquery.autocomplete.css"/>-->
   

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
   <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }

      .loading {  
        position:fixed;
        z-index: 100;  
        top:50%;  
        left:50%;  
        margin: -80px 0 0 -90px;
        color: #FFFFFF;
      }  
      #bg {
        position: fixed;
        background-color: black;
        height: 90px;
        width: 200px;
        margin: 0;
        padding:0;
        opacity: 0.8;
        top:0;
        left: 0;
        top:50%;  
        left:50%;  
        margin: -100px 0 0 -100px;
      }
    </style>
    
    
  
  

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php">PEDIDOS ONLINE</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
             <?php

                $idgrupo = "";
                $i=0;
               // echo $rol;


                $query  =    "select  ".
                             "     a.IdGrupo, b.nom_grupo grupo,  ".
                             "     a.nom_acceso, a.url  ".
                             "   from accesos a, grupo b ";
                if( $rol != "1" ){             
                  $query  .=    " , usuario_acceso c  ";
                }  
                $query  .=    "   where a.idgrupo = b.idgrupo  ";                             
                if( $rol != "1" ){           
                   $query .=  "   and a.IdAcceso = c.IdAcceso  ".  
                              "   and c.IdUsuario= '".$idusuario."'  ";                                
                }  
                $query .=    "   order by a.IdGrupo, a.nom_acceso ";   
               // echo $query;                      
                $rset  = mysql_query($query, $con) or die("Consulta fallida: " . mysql_error());
                while ($line = mysql_fetch_array($rset, MYSQL_ASSOC)) {  
                    $i++;
                   // echo $query;

                    if($line['IdGrupo']!=$idgrupo){
                      if($i>1){                         
                        echo "</ul></li>";
                      }
                      echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".$line['grupo']."<span class='caret'></span></a>";
                     // echo "<a>".$line['grupo']."</a>";
                      $idgrupo = $line['IdGrupo'];                            
                      echo "<ul class='dropdown-menu'>";                
                    }
                      echo "<li class='menu' dir='".$line['url']."'><a href='#'>".$line['nom_acceso']."</a></li>";
                }
                 
                echo "<li class='menu'><a href='salir.php'>Salir</a></li>";

                echo "</ul></li>"; 

               // echo $idusuario;
             ?> 


      <!--      <li class="menu active"><a href="main.php">Inicio</a></li> 
            <li class="menu" dir="pedido.php"><a >Pedidos</a></li>           
            <li class="menu" dir="lista_autorizar.php"><a >Autorizar</a></li>            
            <li class="menu" dir="entregar.php"><a >Entregar</a></li>
             <li class="menu" dir="accesos_usuario.php"><a >Accesos</a></li>
            <li class="menu" dir="salir.php"><a>Salir</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
            
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    
    
    <div class="container">

      <div class="container" id="contenedor">

      </div>	
      <hr>

      <footer style="padding-top: 0px;">
        <p>&copy; <?php echo $login; ?></p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!--<script src="js/jquery-1.10.2.js"></script>-->
   <!-- <script src="js/jquery-1.10.2.js"></script>-->
    
 
 	<script src="js2/jquery-1.8.2.js"></script>
    <script src="js2/bootstrap.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/offcanvas.js"></script>

    <script type="text/javascript">

           var soloNumerico = {
                    valor: function (str) {
                    if (str.match(/[^0-9 ]/g)) {
                       str = str.replace(/[^0-9 ]/g, '');
                    }
                    return str;
                    }
          }    
         
          var soloLetras = {
                    valor: function (str) {
                         if (str.match(/[^A-Za-z ]/g)) {
                            str = str.replace(/[^A-Za-z ]/g, '');
                         }
                    return str;
                    }
          }

         
          var soloAlfanumerico = {
                 valor: function (str) {
                 if (str.match(/[^0-9A-Za-z]/g)) {
                    str = str.replace(/[^0-9A-Za-z]/g, '');
                 }
                 return str;
                 }
            }    
         
          var email = {
                       valor: function (str) {
                            if (str.match(/[^0-9A-Za-z@._\-]/g)) {
                               str = str.replace(/[^0-9A-Za-z@._\-]/g, '');
                            }
                           
                            return str;
                       }
          }    

    	$(function(){

        cargar('perfil.php');

    		//alert('jquery');
    		$('.menu').click(function(){
    			//alert('hola');
    			$('.menu').removeClass("active")
    			$(this).addClass("active");
    			var url = $(this).attr("dir");
    			cargar(url);
    			//alert(url);
    		})
    	})

    	function cargar(url){
          $.post(url, function(data, textStatus, xhr) {
              $('#contenedor').html(data);
          });
    	}
    </script>
    <style>
    	#contenedor{
    		min-height: 500px;
    	}
      table td{
        font-size: 13px !important;
      }
    </style>
  </body>
</html>
