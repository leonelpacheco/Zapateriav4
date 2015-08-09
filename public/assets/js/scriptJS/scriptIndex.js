$(function(){
	$("#body").on("click",function(event){
		event.stopPropagation();
		//$("#liCart").slideUp("slow");
	})
	
	/*eventos al pasar el mouse sobre las categorias*/
	$('.categorias>li:has(ul)').hover(
		function(e){
			$(this).find('ul:first').css({display: "block"});
			var y = $(this).offset().top;
			$(this).find('ul:first').offset({top:y});
		},
		function(e){
			$(this).find('ul').css({display: "none"});
		}
    );
    /*eventos al pasar el mouse sobre las subcategorias*/
	$('.subCategorias>li:has(ul)').hover(
		function(e){
			$(this).find('ul:first').css({display: "block"});
			var y = $(this).offset().top;
			$(this).find('ul:first').offset({top:y});
		},
		function(e){
			$(this).find('ul').css({display: "none"});
		}
    );
    /*eventos al pasar el mouse en un producto*/
    $('.productos>li:has(div)').hover(
		function(e){
			$(this).find('div:first').removeClass('hidden');
			$(this).find('div:first').css({display: "block"});
			var y = $(this).offset().top;
			$(this).find('div:first').offset({top:y});
		},
		function(e){
			$(this).find('div').css({display: "none"});
		}
    );
    /*poner fondo al elemento de la lista categorias cuando se pasa a subcatgorias*/
	$(".categorias>li>a")
	.mouseleave(function(){
		$(this).prop("style","background-color:#F5F5F5");
	})//se quita el fondo a todos los elementos al quitar el mouse de un elemto catgorias
	.mouseenter(function(){
		$(".categorias>li>a").removeProp("style");
	})
	/*poner fondo al elemento de la lista subcategorias cuando se pasa a productos*/
	$(".subCategorias>li>a")
	.mouseleave(function(){
		$(this).prop("style","background-color:#F5F5F5");
	})//se quita el fondo a todos los elementos al quitar el mouse de un elemto produproductos
	.mouseenter(function(){
		$(".subCategorias>li>a").removeProp("style");
	});

	/*evento para agregar productos al carrito*/
	$("body").on("click",".addCart",function(e){
		e.preventDefault();
		var img       = $("#root").val()+"/"+$(this).parent().parent().parent().find('.img-responsive').attr('src');
		var txtprecio = $(this).parent().find('.precio').text();
		var precio    = $.trim(txtprecio).slice(1);
		/*esta funion esta en scritpCart*/
		addCart($(this).attr('href'),$(this).attr('name'),img,precio);
	});
	/*evento para quitar un elemento del carrito*/
	/*evento para mostrar el carrito de compras*/
	$("body").on("click",".removeProducto",function(){
		var id = $(this).find("input[name=id]").val();
		/*esta funion esta en scritpCart.js*/
		removeCart(id);
	})



	$("#liCart").mouseenter(function(){
		$("#cart").slideDown("slow");
	});	
	$("#wrap").on("click",function(event){
		$("#cart").slideUp("slow");
	})
	
	/*$("#liCart").mouseleave(function(){
		$("#cart").slideToggle("slow");
	});//se quita el fondo a todos los elementos al quitar el mouse de un elemto produproductos
	*/
	/*evento para actualizar el #de productos*/
	$("body").on("click",".blockIcon",function(){
		var td = $(this).parent();
		var id = td.find('input[name=idUpdate]').val();
		var cantidad = td.find('input[name=cantUpdade]').val();
		updateCart(id,cantidad)
	})
	$("#alCarrito").on("click",function(){
		var cantidad  = $("#cantidadProducto").val();
		var id        = $("#idProducto").val();
		var name      = $("#nameProducto").text();
		var img       = $("#root").val()+"/assets/img/productos/"+$("#imgProducto").val();
		var txtprecio = $("#precioProducto").text();
		var precio    = $.trim(txtprecio).slice(1);
		/*esta funion esta en scritpCart*/
		addCart(id,name,img,precio,cantidad);
	})
	var width = 0;
	var length = ($("#carrusel>.carrusel-box").length * 150 ) - 300;
	
	$("#next").on("click",function(){
		if (length >= width) {
			width +=150;
		}
		$("#carrusel").attr("style","left: -"+width+"px");
	})
	$("#before").on("click",function(){
		if(width >= 150 ){
			width -=150;
		}
		$("#carrusel").attr("style","left: -"+width+"px");
	})
})

/*funcion para hacer una peticion ajax, devuelve un objeto xhttpRequest
*url diraccion de la pericion
*data informacion que se envia
*method: post,get u otro
*dataType: json,text,xml etc
*async: 1 false, otro true
*/
function ajax(url,data,method,dataType,async){
	var typeAsync = (async == 1) ? false : true;
	var objAjax = $.ajax({
					url:url,
					type:method,
					data : data,
					dataType : dataType,
					async : typeAsync,
					beforeSend : function(){
						$('body').attr('style','cursor:wait;')
					}
				})
	return objAjax;
}

/**
*Funcion que sirve pra permitir solo numeros, solo caracteres o ambos
*evento: onkeypress , permitidos : num|car|num_car
*/
function f_permite(elEvento, permitidos) {
    // Variables que definen los caracteres permitidos
    var numeros = "0123456789";
    var caracteres = " abcdefghijklmnÃ±opqrstuvwxyzABCDEFGHIJKLMNÃ‘OPQRSTUVWXYZ";
    var numeros_caracteres = numeros + caracteres;
    var teclas_especiales = [8, 37, 39, 46];
    
    // Seleccionar los caracteres a partir del parÃ¡metro de la funciÃ³n
    switch(permitidos) {
        case 'num':
            permitidos = numeros;
            break;
        case 'car':
            permitidos = caracteres;
            break;
        case 'num_car':
            permitidos = numeros_caracteres;
            break;
    }

    // Obtener la tecla pulsada
    var evento = elEvento || window.event;
    var codigoCaracter = evento.charCode || evento.keyCode;
    var caracter = String.fromCharCode(codigoCaracter);

    // Comprobar si la tecla pulsada es alguna de las teclas especiales
    // (teclas de borrado y flechas horizontales)
    var tecla_especial = false;
    for(var i in teclas_especiales) {
        if(codigoCaracter == teclas_especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
    // o si es una tecla especial
    return permitidos.indexOf(caracter) != -1 || tecla_especial;
}

function formatMoney(nStr,nDecimales)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2.substring(0,(nDecimales+1)); 
}

   

	