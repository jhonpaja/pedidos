$(document).on("ready",inicio);
	
function inicio(){
	$("span.help-block").hide();
	$("#btnenviar").click(validar);
	}
	
	function validar(){
		
		var valor=document.getElementById("nombre").value;
		var valor1=document.getElementById("apellido").value;
		var valor2=document.getElementById("email").value;
		var valor3=document.getElementById("usuario").value;
		var valor4=document.getElementById("prueba").value;
		
		
		if(valor==null || valor.length==0 || /^\s+$/.test(valor)){
					$("#iconotexto").remove();
					$("#nombre").parent().parent().attr("class","form-group has-error has-feedback");
					$("#nombre").parent().children("span").text("Ingrese su nombre").show();
					$("#nombre").parent().append("<span id='iconotexto' class='glyphicon glyphicon-remove form-control-feedback'></span>");
				return false;
			}else {
					$("#nombre").parent().parent().attr("class","form-group has-success has-feedback");
					$("#nombre").parent().children("span").text("").hide();
					$("#nombre").parent().append("<span id='iconotexto' class='glyphicon glyphicon-ok form-control-feedback'></span>");
				return true;
				}

			if(valor1==null || valor.length==0 || /^\s+$/.test(valor1)){
					$("#apellido").parent().parent().attr("class","form-group has-error");
					$("#apellido").parent().children("span").text("Ingrese su apellido").show();
				return false;
				
			}else {
				
					$("#apellido").parent().parent().attr("class","form-group has-success");
					$("#apellido").parent().children("span").text("").hide();
				
				}
				
				
			if(valor3==null || valor3.length==0 || /^\s+$/.test(valor3)){
					$("#usuario").parent().parent().attr("class","form-group has-error");
					$("#usuario").parent().children("span").text("Ingrese su usuario").show();
					return false;
			}else { 
			
				$("#usuario").parent().parent().attr("class","form-group has-success");
				$("#usuario").parent().children("span").text("").hide();
			
			
			}

			 if(valor4==null || valor4.length==0 || /^\s+$/.test(valor4)){
					$("#prueba").parent().parent().attr("class","form-group has-error");
					$("#prueba").parent().children("span").text("Ingrese su clave").show();
				
				}else{
						$("#nombre").parent().parent().attr("class","form-group has-success");
						$("#nombre").parent().children("span").text("").hide();
					
					}
		
		
		
		}