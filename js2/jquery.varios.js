(function($){
    $.fn.extend({
        validar_fecha:function(){
           this.each(function(){
               var $this=$(this);
                function anyoBisiesto(anyo)
                {		
			if	(anyo < 100){
				var fin = anyo + 1900;
			}else{
				var fin = anyo ;
			}
		
			if (fin % 4 != 0)
			{
				return false;
			}else{	
					if (fin % 100 == 0)
        	  		{	if (fin % 400 == 0)
						{	
							return true; 
						}else{ 	
							return false;
						}
        		    }else{	
						return true;
					}
			}
		}	
        function contar_char(cadena,caracter,pos_ini)
		{
			var pos=pos_ini;
			var cont=0;
			while(cadena.indexOf(caracter,pos)!='-1')
			{
				pos=cadena.indexOf(caracter,pos)+1;				
				cont++;		
			}		
			return cont;
		}
                function posicion_char(cadena,caracter,ordinal)
		{
			var pos=0;
			var cont=0;
			while(cadena.indexOf(caracter,pos)!='-1')
			{
				pos=cadena.indexOf(caracter,pos)+1;				
				cont++;		
				if(cont==ordinal)
				{
					return pos;
				}
			}		
			return pos;
		}
               $this.bind('focusin',function(){$this.select();})
               $this.bind('focusout',
                function (){
			var fecha 	= $this.val();
			var dia		= fecha.split("/")[0];
			var mes		= fecha.split("/")[1];
			var anyo	= fecha.split("/")[2];
			var febrero;			
			if(fecha!='' && fecha.length<8)
			{				
				alert('El formato de fecha incorrecto');
				$(this).focus();
				return false;
			}			
			if  (anyoBisiesto(anyo))
			{
				febrero=29;
			}else
			{
				febrero=28;
			}						
			if ( (mes==1 || mes==3 || mes==5 || mes==7 || mes==8 || mes==10 || mes==12) && ( dia<1 || dia>31) )
			{
				alert("El dia no es valido para el mes ingresado");
				$(this).focus();
				return false;
			}
			if ( (mes==4 || mes==6 || mes==9 || mes==11) && (dia<1 || dia>30) )
			{
				alert("El dia no es valido para el mes ingresado");
				$(this).focus();
				return false;
			}
			if ( mes<1 || mes>12 )
			{	
				alert("El mes introducido no es valido. Por favor, introduzca un mes correcto");
				$(this).focus();
				return false;
			}
			if ( mes==2 && ( dia<1 || dia>febrero) )
			{
				alert("El ano ingresado no es bisiesto");
				$(this).focus();
				return false;
			}			
			if ((anyo>100 && anyo<1900) || anyo>2101)
			{
				alert("El ano introducido no es valido. Por favor, introduzca un ano correcto");
				$(this).focus();
				return false;
			}		                   
                });
                $this.bind('keyup',
                function (e){	
			var idv     = $(this).val();
                        var ultimo  = idv.substring(idv.length-1);
			if(e.which!=8){
				if((idv.length == 2 || idv.length - posicion_char(idv,'/',1) == 2)&& ultimo!='/'){
					$(this).attr('value', $(this).val() + '/');					
				}							
			}				
		});
                $this.bind('keydown',
                function(e){
                    var idv     = $(this).val();
                    var ultimo  = idv.substring(idv.length-1);                    
                    var anio    = idv.substring(posicion_char(idv,'/',2));
					var key = e.which;
                    if(( ((key < 47 || e.which > 57) && (key < 96 || e.which > 105)) || (ultimo=='/' && key==47) || $this.val().length>9 || (contar_char(idv,'/',0)==2 && key==47))  && key!=13 && key!=8  && key!=37  && key!=39  && key!=46 )
					{ 
						return false; 
					}
                });
           });
        },
        texto_vacio:function(options){
            if(!options){
                options={};
            }
            var _options={
                texto   : options.texto || 'Ingrese el texto'
            }
            this.each(function(){
                var $this=$(this);
                $this.val(_options.texto).css({'color':'darkgray'});
                $this.bind('focusout',
                function(){
                   if($this.val()==''){
                       $this.val(_options.texto).css({'color':'darkgray'});
                   }                   
                });
                $this.bind('focusin',
                function(){
                   $this.css({'color':'black'});
                   if($this.val()==_options.texto){
                       $this.val('');
                   }                    
                });                
            });
        },
		formato_numero:function(options){
			if(!options){
				options={}
			}
			
			var _options={
				tipo	: options.tipo
			}			
			this.each(function(){
				var $this = $(this);
				$(this).css({'text-align':'right'});
				$this.bind('keyup',
				function (e){
					if(_options.tipo=='presion'){
						if($this.val().length=='3' && e.which!=8 && $this.val().indexOf('/')==-1){
							$this.val($this.val() + '/');
						}
					}else if(_options.tipo=='peso'){
						if(e.which==107){
							var posm = $this.val().indexOf('+');
							$this.val($this.val().substring(0,posm+1) + '/-' + $this.val().substring(posm+1));
						}
					}
				});
				
				$this.bind('focusout',
				function (e){
					if(_options.tipo=='presion'){
						if(($this.val().substring($this.val().indexOf('/')+1)>300 || $this.val().substring(0,$this.val().indexOf('/'))>300) && $this.val()!=''){
							alert('El valor ingresado esta fuera de rango');
							$this.focus();
						}
						if(($this.val().indexOf('/')==-1 && $this.val()!='') || ($this.val().substring($this.val().indexOf('/')+1).length==0 && $this.val()!='')){
							alert('El formato es incorrecto');
							$this.focus();
						}
					}
				});
			
				function noNumero(key){
					if ((key > 47 && key < 58) || (key > 95 && key < 106) || key==13 || key==8  || key==9 || key==37  || key==39){
						return false;
					}else{
						return true;
					}
				}
				
				$this.bind('keydown',
				function (e)
				{						
					var key=e.keyCode;
					if(_options.tipo=='decimal'){
						if (noNumero(key) && (key !=188 && key !=190 && key!=110)){
							e.preventDefault(); 
						}		
					}else if(_options.tipo=='cta'){
						if ( noNumero(key) && key !=45 ){ 
							e.preventDefault(); 
						}		
					}else if(_options.tipo=='fono'){
						if (noNumero(key) && (key !=45 && key !=43 && key!=32) ){ 
							e.preventDefault(); 
						}		
					}else if(_options.tipo=='peso'){
						if (noNumero(key) ||( key !=43 && key !=47 && key !=45)){ 
							e.preventDefault(); 
						}
						if($this.val().indexOf('+')!=-1 && key==43) e.preventDefault(); 
						if($this.val().indexOf('/')!=-1 && key==47) e.preventDefault(); 
						if($this.val().indexOf('-')!=-1 && key==45) e.preventDefault(); 		
					}else if(_options.tipo=='presion'){
						if (noNumero(key) && key!=111){ 
							e.preventDefault(); 
						}
					}else{
						if(noNumero(key)){
							e.preventDefault();
						}
					}
				});
			});
		},
        menu:function(options){
            if(!options){
                options={}
            }
            var _options={
                idMenu      : options.idMenu        || '',
                imagen      : options.imagen        || '',
                contenido   : options.contenido     || ' ',
                ancho       : options.ancho         || 150,
                color_fondo : options.color_fondo   || '#fff',
                color_borde : options.color_borde   || '#454545',
                posicion    : options.posicion      || 'a',
                desvanecer  : options.desvanecer    || 'false',
                ancho_img   : options.ancho_img     || '18',
                altura_img  : options.altura_img    || '18',
                nom_frame   : options.nom_frame    || 'nueva_ventana'
            };
            this.each(function(){
                var pos_ini_img = 0;
                var pos_fin_img = 0;
                var pos_ini_con = 0;
                var pos_fin_con = 0;
                var pos_ini_id 	= 0;
                var pos_fin_id 	= 0;
                var en_menu     = 0;
                var en_enlace   = 0;
				var cont		= 0;
                var $this   = $(this);
                var $lista  = $('<table id="' + _options.ident + '" border="1" cellspacing="0"></table>');
                $lista.addClass('menu');    
                $this.addClass('cabecera');    
                var lista ="";
                while(_options.contenido.indexOf(',',pos_ini_con)!=-1)
				{
					cont ++;					
                    if(_options.imagen!=''){
                        pos_fin_img = _options.imagen.indexOf(',',pos_ini_img);
                    }
                    if(_options.idMenu!=''){
                        pos_fin_id = _options.idMenu.indexOf(',',pos_ini_id);
                    }
                    pos_fin_con = _options.contenido.indexOf(',',pos_ini_con) ;                   
                    lista='<tr><td ';             					
                    if(_options.idMenu!=''){
                        lista+=' id="' + _options.idMenu.substring(pos_ini_id,pos_fin_id) + '"';
                    }
                    lista+='>';                    
                    if(_options.imagen!=''){
                        if($.trim(_options.imagen.substring(pos_ini_img,pos_fin_img))!=''){
                            lista += '<img src="' + _options.imagen.substring(pos_ini_img,pos_fin_img) + 
                                    '" height="' + _options.altura_img + '" width="' + _options.ancho_img+ '">';
                        }                                                 
                    }
                    lista +=_options.contenido.substring(pos_ini_con,pos_fin_con) + '</td></tr>';
                    $lista.append(lista);                    
                    pos_ini_img = pos_fin_img +1;
                    pos_ini_con = pos_fin_con +1;
                    pos_ini_id = pos_fin_id +1;
                }                       
                $lista.css({'background-color'  :_options.color_fondo,
                            'border-color'      :_options.color_borde,
                            'width'             :_options.ancho});
                lista='<tr><td ';             
                    if(_options.idMenu!=''){
                        lista+=' id="' + _options.idMenu.substring(pos_ini_id) + '"';
                    }
                    lista+='>';                    
                    if(_options.imagen!=''){
                        if($.trim(_options.imagen.substring(pos_ini_img))!=''){
                            lista += '<img src="' + _options.imagen.substring(pos_ini_img) + 
                                    '" height="' + _options.altura_img + '" width="' + _options.ancho_img+ '">';
                        }                                                 
                    }
                    lista +=_options.contenido.substring(pos_ini_con) + '</td></tr>';
                $lista.append(lista);
                $this.parent().append($lista);
                $this.bind('mouseenter click',
                    function(){
                        var posicion    = $this.position();
                        if(_options.posicion.length==1){
                            var pos_top     = 0;
                            var pos_left    = 0;
                            if(_options.posicion=='a'){                    
                                pos_top = posicion.top  + 18;
                                pos_left= posicion.left;
                            }
                            else if (_options.posicion=='d'){
                                pos_top = posicion.top;
                                pos_left = posicion.left;
                            }
                        }
                        en_enlace	= 1;
						//en_menu		= 1;
                        $lista.css({'top':pos_top,'left':pos_left,'display':'block'})
                });
                $this.bind('mouseleave',
                    function(){    
                       en_enlace=0;                   
                       setTimeout(
                           function(){
                                if(en_menu!=1){
                                    $lista.css('display','none');
                                }
                            },10);                            
                });
                $lista.bind('mouseover',
                    function(){                    
                        en_menu=1;
                });
                $lista.bind('mouseleave',
                    function(){                    
                        en_menu=0;
                        setTimeout(
                           function(){
                                if(en_enlace!=1 && en_menu!=1){
                                    $lista.css('display','none');
                                }
                            },10);                 
                });
                $lista.bind('click',
                    function(){                    
                        setTimeout(
                           function(){
                                $lista.css('display','none');
                            },10); 
                });				
            });            
        },		
		menu_context:function(options){
            if(!options){
                options={}
            }
            var _options={
                idMenu      : options.idMenu        || '',
				classItem   : options.classItem        || '',
                imagen      : options.imagen        || '',
                contenido   : options.contenido     || ' ',
				boton		: options.boton			|| 1,
                ancho       : options.ancho         || 150,
                color_fondo : options.color_fondo   || '#fff',
                color_borde : options.color_borde   || '#454545',
                posicion    : options.posicion      || 'a',
                desvanecer  : options.desvanecer    || 'false',
                ancho_img   : options.ancho_img     || '18',
                altura_img  : options.altura_img    || '18',
                nom_frame   : options.nom_frame    || 'nueva_ventana'
            };
            this.each(function(){
                var pos_ini_img = 0;
                var pos_fin_img = 0;
                var pos_ini_con = 0;
                var pos_fin_con = 0;
                var pos_ini_id 	= 0;
                var pos_fin_id 	= 0;
				var pos_ini_class= 0;
                var pos_fin_class= 0;
                var $this   = $(this);
                var $lista  = $('<table id="' + _options.ident + '" border="1" cellspacing="0"></table>');
                $lista.addClass('menu_context');    
                var lista ="";
                while(_options.contenido.indexOf(',',pos_ini_con)!=-1)
				{					
                    if(_options.imagen!=''){
                        pos_fin_img = _options.imagen.indexOf(',',pos_ini_img);
                    }
                    if(_options.idMenu!=''){
                        pos_fin_id = _options.idMenu.indexOf(',',pos_ini_id);
                    }
					if(_options.classItem!=''){
                        pos_fin_class = _options.classItem.indexOf(',',pos_ini_class);
                    }
                    pos_fin_con = _options.contenido.indexOf(',',pos_ini_con) ;                   
                    lista='<tr><td ';             					
                    if(_options.idMenu!=''){
                        lista+=' id="' + _options.idMenu.substring(pos_ini_id,pos_fin_id) + '"';
                    }
					if(_options.classItem!=''){
                        lista+=' class="' + _options.classItem.substring(pos_ini_class,pos_fin_class) + '"';
                    }
                    lista+='>';                    
                    if(_options.imagen!=''){
                        if($.trim(_options.imagen.substring(pos_ini_img,pos_fin_img))!=''){
                            lista += '<img src="' + _options.imagen.substring(pos_ini_img,pos_fin_img) + 
                                    '" height="' + _options.altura_img + '" width="' + _options.ancho_img+ '">';
                        }                                                 
                    }
                    lista +=_options.contenido.substring(pos_ini_con,pos_fin_con) + '</td></tr>';
                    $lista.append(lista);                    
                    pos_ini_img 	= pos_fin_img + 1;
					pos_ini_con 	= pos_fin_con + 1;
					pos_ini_id 		= pos_fin_id + 1;
					pos_ini_class 	= pos_fin_class + 1;
                }                       
                $lista.css({'background-color'  :_options.color_fondo,
                            'border-color'      :_options.color_borde,
                            'width'             :_options.ancho});
                lista='<tr><td ';             
                    if(_options.idMenu!=''){
                        lista+=' id="' + _options.idMenu.substring(pos_ini_id) + '"';
                    }
					if(_options.classItem!=''){
                        lista+=' class="' + _options.classItem.substring(pos_ini_class) + '"';
                    }
                    lista+='>';                    
                    if(_options.imagen!=''){
                        if($.trim(_options.imagen.substring(pos_ini_img))!=''){
                            lista += '<img src="' + _options.imagen.substring(pos_ini_img) + 
                                    '" height="' + _options.altura_img + '" width="' + _options.ancho_img+ '">';
                        }                                                 
                    }
                    lista +=_options.contenido.substring(pos_ini_con) + '</td></tr>';
                $lista.append(lista);
                $('body').append($lista);				
                $this.bind('mousedown',
                    function(e){
						if(e.which==_options.boton){
							var posicion    = $this.position();
							if(_options.posicion.length==1){
								var pos_top     = 0;
								var pos_left    = 0;
								if(_options.posicion=='a'){                    
									pos_top = posicion.top  + 18;
									pos_left= posicion.left;
								}
								else if (_options.posicion=='d'){
									pos_top = posicion.top;
									pos_left = posicion.left;
								}
							}
							$lista.css({'top':pos_top,'left':pos_left,'display':'block'})
									.focus();
						}
                });
				
				$lista.find('td').mouseenter(function(){
									$(this).css({'background':'#7068FD','color':'#FFFFFF'});
								})
								.mouseleave(function(){
									$(this).css({'background':'#FFFFFF','color':'#000000'});
								});
				$lista.focusout(function(){setTimeout(function(){$lista.hide();},300);});
            });            
        },
		autoResize: function(options){
			if(!options){
				options = {};
			}
			var _options = {
				maxHeight: options.maxHeight || null,
				minHeight: options.minHeight || null,
				textHold: options.textHold || null,
				activeClass: options.activeClass || null
			};
			this.each(function(){
				var $this = $(this);
				if($this.val() == "" && _options.textHold){
					$this.val(_options.textHold);
				}
				$this.initHeight = $this.css("height");
				if(_options.maxHeight){
					$this.css("overflow", "auto");
				}else{
					$this.css("overflow", "hidden");
				}
				var _value = null;
				var $clon = $this.clone(true);
				$clon.css({
					visibility: "hidden",
					position: "absolute",
					top: 0,
					overflow: "hidden",
					width: parseInt($this.width())-10
				});
				$clon.attr("name","clon");
				$clon.attr("id", "");
				$this.parent().append($clon);
				var clon = $clon[0];
				var me = $this;
				$this.ready(autoFit);
				$this.bind("keyup" , autoFit)
					.bind("focus", function(){
						if(_options.textHold){
							if(this.value == _options.textHold){
								this.value = "";
							}
						}
						if(_options.minHeight){
							me.css("height", _options.minHeight+"px");
							$clon.css("height", _options.minHeight+"px");
							autoFit(true);
						}
						if(_options.activeClass){
							me.addClass(_options.activeClass);
						}
					})
					.bind("blur", function(){
						if(_options.textHold){
							if(this.value == ""){
								this.value = _options.textHold;
								if(_options.minHeight && me.initHeight){
									$clon.css("height", me.initHeight);
									me.css("height", me.initHeight);
									autoFit();
								}
							}
						}else{
							if(_options.minHeight && me.initHeight){
								$clon.css("height", me.initHeight);
								me.css("height", me.initHeight);
								autoFit();
							}
						}
						if(_options.activeClass){
							me.removeClass(_options.activeClass);
						}
					});
				function autoFit(force){
						//alert('');
				    	clon.value = me.val();
				    	//Comprueba si ha cambiado el valor del textarea
				    	if (_value != clon.value || force===true){
					    _value = clon.value;
					    var h = clon.scrollHeight;
					    if(_options.maxHeight && h > _options.maxHeight){
						me.css("height", _options.maxHeight + "px");
					    }else{
							//alert(h);
					    	me.css("height", parseInt(h) + "px");
					    }
						
				    	}
				}
				autoFit();
			});
		},			
		habilita_texto:function(options){
			if(!options){
				options={}
			}
			
			var _options={
				$this	: options.check || $(this),
				$texto	: options.texto,
				valida	: options.valida || '0', // '0': no valida texto ; '1': valida texto
				texto_vacio: options.texto_vacio || ''
			}
			this.each(function(){
				var click_$this='0';
				_options.$this.bind('click',
				function ()
				{
					if((_options.$this.is(':checked') && _options.$this.attr('type')=='checkbox') || (_options.$this.val()=='1' && _options.$this.attr('type')=='radio')){
						_options.$texto.removeAttr('disabled','disabled')
										.val(_options.$texto.data('valor'))
										.css('background','#fff')
										.each(function(i){if(i==0){$(this).focus();}});
					}
					else{
						_options.$texto.attr('disabled','disabled')
										.data('valor',_options.$texto.val())
										.css('background','#E6E6E6')
										.val(_options.texto_vacio);
					}					
				});
				_options.$this.focusin(function(){click_$this='1';});
				_options.$this.focusout(function(){click_$this='0';});
				_options.$texto.focusout(function(){	
										
						setTimeout(function(){
							//alert('entre');
							if($.trim(_options.$texto.val())=='' && _options.valida=='1' && click_$this=='0'){
								alert('Debe ingresar el detalle de la seleccion');
								_options.$texto.focus();	
							}
						},100);
				});
				_options.$this.ready(
				function ()
				{
					setTimeout(function(){
						if(_options.$this.is(':checked')){
							_options.$texto.removeAttr('disabled','disabled')
									.css('background','#fff');
						}
						else{
							_options.$texto.attr('disabled','disabled')
									.css('background','#E6E6E6')
									.val(_options.texto_vacio);
						}
					},10);
				});
			});
		},
		set_val:function(options){
			if(!options){
				options={}
			}
			
			var _options={
				valor	: options.valor
			}
			this.each(function(){
				var tipo	= $(this).attr('type');
				var $this	= $(this);
				var nombre	= "";
				$(this).ready(
				function ()
				{
					switch(tipo){						
						case 'checkbox':
							var valor	= _options.valor == '1' ? true:false;
							$this.attr('checked',valor);
						break;
						case 'radio':
							nombre 	= $this.attr('name');
							$.each($("input[name='" + nombre + "']"),function(){if($(this).val()==_options.valor){$(this).attr('checked',true)};});
							break;
						default :							
							var valor	= _options.valor == 'null' ? '':_options.valor.replace(/~/gi,'\n');
							$this.val(valor);
							break;
					}
				});
			});
		},
		autocompletar:function(options){
			if(!options){
				options={}
			}			
			var _options={
				tabla			: options.tabla,//
				campo_busq		: options.campo_busq || options.nombre,
				codigo			: options.codigo,
				nombre			: options.nombre,
				campo_id		: options.campo_id || options.codigo,
				campo_criterio1	: options.campo_criterio1 || '',
				valor_criterio1	: options.valor_criterio1 || '',
				campo_criterio2	: options.campo_criterio2 || '',
				valor_criterio2	: options.valor_criterio2 || ''
			}
			this.each(function(){
				var $this		= $(this);
				$this.autocomplete('../../busqueda_jquery.jsp?tabla=' + 
				_options.tabla + '&campo_busq=' + 
				_options.campo_busq + '&codigo=' + 
				_options.codigo + '&nombre=' + 
				_options.nombre + '&cc1=' + 
				_options.campo_criterio1 + '&vc1=' + 
				_options.valor_criterio1 + '&cc2=' + 
				_options.campo_criterio2 + '&vc2=' + 
				_options.valor_criterio2 );
				$this.result(function(event, data, formated){$('#' + _options.campo_id).val(data[1]);});
				$this.focusout(
					function(){
						setTimeout(function(){
							if($('#' + _options.campo_id).val()=='' && $this.val()!=''){
								alert('Debe seleccionar una opcion de la lista');
								$this.focus();
							}
						},200);
					}
				);
				$this.keyup(
					function(){
						if($this.val()==''){
							$('#' + _options.campo_id).val('');
						}
					}
				);
				$this.ready(
					function(){
						$this.parent().append($('<input style="display:none" type="text" id="' + _options.campo_id + '"  name="' + _options.campo_id + '">'));
					}
				)
			});
		},
		validar_campo:function(options){
			if(!options){
				options={}
			}			
			var _options={
				tipo		: options.tipo,
				tamano  	: options.tamano
			}
			this.each(function(){
				var $this		= $(this);				
				$this.keypress(				
					function(e){
						if($this.val().length>=_options.tamano && _options.tipo!='DATE' && e.which!=8){
							return false;
						}
					}
				);
				$this.ready(
					function(){
						switch(_options.tipo){
						case 'DATE':							
							$this.attr('size','9')
								.validar_fecha();
							break;
						case  'INTEGER' :  case 'LONG': 
							$this.formato_numero();
							break;
						case 'NUMERIC': case 'DECIMAL': case 'FLOAT': 
							$this.formato_numero({tipo:'decimal'});
							break;
						}
						if($this.attr('type')=='checkbox'){
							$this.val('1');
						}
						$this.attr('name',$this.attr('id'));
					}
				);
			});
		},
		calendario_medico:function(options){
			if(!options){
				options={}
			}			
			var _options={
				id_medico	: options.id_medico,
				jsp			: options.jsp || 'listado',
				var_fecha	: options.var_fecha || 'f_fecha'
			}
			this.each(function(){
				var $this		= $(this);
				var $calendario = $('<div id="div_calendario"></div>');
				var $mensaje 	= $('<div id="mensaje_calendario">Click en la flechita para cambiar de dia</div>');
				$mensaje.css({'position':'absolute',
								'color':'#f00',
								'font-weight':'bold',
								'font-size':'10px',
								'width':'200px',
								'left': parseInt($this.css('width').substring(0,$this.parent().css('width').length-2))-200,
								'top' : 0});
				$calendario.load('../../calendar.jsp', {f_id_medico:_options.id_medico,
													f_contenedor:$this.attr('id'),
													f_jsp:_options.jsp,
													f_var_fecha:_options.var_fecha})
							.css({'position':'absolute',
								 'background':'#FFFFFF',
									'left': parseInt($this.css('width').substring(0,$this.parent().css('width').length-2))-60,
									'top' : 10
								})								
				$('body').append($mensaje)
						.append($calendario)
			});
		},
		mover:function(options){
			if(!options){
				options={}
			}			
			var _options={
				punto	: options.punto || $(this)
			}
			this.each(function(){
				var mover = 0;
				var cx = 0;
				var cy  = 0;
				var ox = 0;
				var oy  = 0;
				var $this = $(this);
				_options.punto.mousedown(function(e){
						cx = e.pageX;
						cy = e.pageY;
						ox = $this.css('left').substring(0,$this.css('left').length-2);
						oy = $this.css('top').substring(0,$this.css('top').length-2);
						mover=1;
						_options.punto.css('cursor','move');
					});
				_options.punto.bind('mouseup',function(){
						mover=0;
						_options.punto.css('cursor','hand');
					});
				$(document).mousemove(function(e){
					if(mover==1){
						var nleft = ox - (cx-e.pageX);
						var ntop  = oy - (cy-e.pageY);
						$this.css({'left':nleft,'top':ntop});
					}
				});
			});
		},
		mensaje_emergente:function(options){
			if(!options){
				options={}
			}			
			var _options={
				texto	: options.texto || 'Cargando',
				tiempo	: options.tiempo || 1000,
				borde   : options.borde || '5',
				width 	: options.width || 200,
				left	: options.left || $(this).position().left + parseInt($(this).css('width').substring(0,$(this).css('width').length-2)/2 -100),
				fontsize: options.fontsize || '11px'
			}
			this.each(function(){
				$this = $(this);
				$('.emergente').remove();
				$emergente = $('<div>' + _options.texto + '</div>');
				$emergente.css({'background':'#000',
								'color':'#FFF',
								'text-align':'center',
								'position':'absolute',
								'padding-botton':'5px',
								'padding-top':'5px',
								'display':'none',
								'width':_options.width,
								'opacity':0.75,
								'font-size':_options.fontsize,
								'line-height':'15px'})
							.addClass('emergente');
				$this.append($emergente);
				$emergente.css({'top': $this.position().top + parseInt($this.css('height').substring(0,$this.css('height').length-2)/2),
								'left':options.left})
						   .fadeIn('fast');
			    //alert($this.position().left + parseInt($this.css('width').substring(0,$this.css('width').length-2)/2));
				if(_options.tiempo !=0){
					$emergente.delay(_options.tiempo).fadeOut('fast',function(){$('.emergente').remove();});
				}
				if(_options.borde !=0){
					$emergente.corners(_options.borde);
				}
			});
		},
		habilita_button:function(options){
			if(!options){
				options={}
			}			
			var _options={
				buttons	: options.buttons || $(this),
				textboxs	: options.textboxs
			}
			this.each(function(){				
				var $buttons;
				var $textboxs;
				if(typeof _options.buttons=='string'){
					var ids = _options.buttons.split(",");
					var idx = '';
					$.each(ids,function(key,val){
						if(key==0) idx = idx + '#' + val;
						else
							idx = idx + ',' + '#' + val;
					});
					$buttons = $(idx);
				}else{
					$buttons = _options.buttons;
				}
				if(typeof _options.textboxs=='string'){
					var ids = _options.textboxs.split(",");
					var idx = '';
					$.each(ids,function(key,val){
						if(key==0) idx = idx + '#' + val;
						else
							idx = idx + ',' + '#' + val;
					});
					$textboxs = $(idx);
				}else{
					$textboxs = _options.textbox;
				}
				
				
				habilita_button();
				$textboxs.keyup(habilita_button);
				
				function habilita_button(){
					var error = 0;
					$.each($textboxs,function(key,val){
						if($(this).val()==''){
							error=1;
							return false;
						}
					});
					if(error==1){
						$buttons.attr('disabled','disabled');
					}else{
						$buttons.removeAttr('disabled');
					}
				}
			});
		}
    })
}(jQuery))