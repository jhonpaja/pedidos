(function($){
	$.fn.calendario	= function(opc_user){
		opc = $.extend($.fn.calendario.opc_default,opc_user);
		var $this;
		return this.each(function(){			
			$this = $(this);
			$this.ready(
				function(){
					$.fn.calendario.cargar(opc.anio,opc.mes);		
			});
			
			$.fn.calendario.cargar = function(anio,mes){
				var dias_mes 	= [31,28,31,30,31,30,31,31,30,31,30,31];
				var dias_sem 	= ['Do','Lu','Ma','Mi','Ju','Vi','Sa'];
				var meses		= ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
				var hoy		= new Date(opc.anio,opc.mes,opc.dia);
				var ini_mes = new Date(anio,mes,1);
				var dia_ini = ini_mes.getDay();
				var fil		= '';
				
				//cargar tablas para calendario
				var $calendario = $('<table class="ui-corner-all" style="border:#09C solid 1px"/>');
				//Solicito dias disponibles por mes;
				var dias_disp = [1,2,7,4,7];
				$('#calendario').empty();
				//Carga Mes y año
				fil =	'<tr>\
							<td colspan="7" height="30px" class="ui-widget-header ui-corner-all" style="text-align:center">\
								<table width="100%">\
									<tr>\
										<td width="18" id="mes_ant"><span class="ui-icon ui-icon-circle-triangle-w"/></td>\
										<td style="font-family: Lucida Grande;font-weight:bold;color:#fff;font-size:11px;text-align:center">' +meses[mes] + ' ' + anio + '</td>\
										<td width="18" id="mes_sig"><span class="ui-icon ui-icon-circle-triangle-e"/></td>\
									</tr>\
								</table>\
							</td>\
						</tr>';
				$calendario.append(fil);
				$this.append($calendario);
				$('#mes_sig').click(function(){
										if(mes==11){
											anio++;
											mes=-1;
										}
										mes++;
										$.fn.calendario.cargar(anio,mes);
									});
				$('#mes_ant').click(function(){					
										if(mes==0){
											anio--;
											mes=12;
										}
										mes--;
										$.fn.calendario.cargar(anio,mes);
									});
				$('#mes_ant,#mes_sig').hover(function(){
											$(this).addClass('ui-state-hover');
										},
										function(){
											$(this).removeClass('ui-state-hover');
										})
				
				//Cargar cabecera de dias
				fil = '<tr>';
				$.each(dias_sem,function(key,val){
					fil+='<th>' + val + '</th>';
				});
				fil+='</tr>';
				$calendario.append(fil);
				//Crea duadricula
				for(var x=0;x<6;x++){
					 fil = '<tr>';
					for(var y=1;y<8;y++){
						fil+='<td id="' + (x*7 + y) + '"></td>';
					}
					fil+='</tr>';
					$calendario.append(fil);
				}	
				
				//Llena cuadricula
				for(var x=1;x<=dias_mes[mes];x++){
					var $celda =$('#' + (x+dia_ini));
					$celda.html($.fn.calendario.pad(x))
							.addClass('ui-state-disabled ui-state-default dia')
							.attr('id','d' + x);
								
					if(x==hoy.getDate() && mes==hoy.getMonth() && anio==hoy.getFullYear()){
						$celda.addClass('ui-state-highlight');
					}
				}
				$.each(dias_disp,function(key,val){
					$('#d' + val).css('cursor','pointer')
								.removeClass('ui-state-disabled')
								.hover(function(){
											$(this).addClass('ui-state-hover');
										},
										function(){
											$(this).removeClass('ui-state-hover');
										})
								.click(function(){
											$('.ui-state-default').removeClass('ui-state-active');
											$(this).addClass('ui-state-active')
										})
				});
			}				
			
		});
	}
	
	var c_hoy	= new Date();
	$.fn.calendario.opc_default={
		dia:c_hoy.getDate(),
		mes:c_hoy.getMonth(),
		anio:c_hoy.getFullYear()
	}
	
	$.fn.calendario.pad = function (cad){
		var t=cad.toString().length;
		for(var x=0;x<2-t;x++){
			cad='0' + cad;
		}
		return cad;
	}
})(jQuery)