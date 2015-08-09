//productos obtenidos
var arrProductos;
/*productos que se mostraban antes del change*/
var beforeShow = 10;
/*esta variable sirve para saber el numero de pagina actual */
var puntero = 0;
$(function(){
	getProductos('');
	$("#categorias input[type=checkbox]").on('click',function(){
		var ids = $("input[name='categorias[]']").serialize();
		getProductos(ids);
	})
	$("#mostrar").on("change",function(){
		var showCurrent = $(this).val();
		var inicio;
		var fin; 

		if( puntero == 1 ){
			inicio = 0;
			fin    = showCurrent;
		}else{
			/*obtenemos la posicion de inicio para mostrar los productos*/
			inicio = puntero * showCurrent;
			fin    = (puntero * showCurrent)+showCurrent;
		}
		//console.log(puntero+"inicio:"+inicio+"fin:"+fin);
		$("#results").html( buildThumbnails(inicio,fin) );
		buildPagination('paginacion');
		beforeShow = showCurrent;
	})
	$("#subcategoria").on('change',function(){
		var data = "";
		var url;
		var bnd = 0;
		if ( $(this).val() != '') {
			url  = 'getBySubcategoria';
			data = 'subcategoria='+$(this).val();
		}else{
			url = 'getByCategorias';
			bnd = 1;
		}
		//console.log(data);
		var objAjax = ajax(url,data,'post','json',0);
		objAjax
		.done(function(json){
			arrProductos = json;
			if( bnd ==1 ){
				arrProductos = json['productos'];
			}
			$('body').attr('style','cursor:auto;');
			var numPro = $("#mostrar").val();
			buildPagination('paginacion');
			puntero = 1;
			$("#results").html(buildThumbnails(0,numPro));
			$('body').attr('style','cursor:auto;');
		})
		.fail(function(){
			$("#results").html('Error');
			$('body').attr('style','cursor:auto;');
		})
		
	})
	/*eventos al dar clic en los numeros de las paginas*/
	$("#paginacion").on("click","li>a",function(e){
		e.preventDefault();
		var pag    = $(this).text();
		/**Validamos que no sean las botones next y before*/
		if(pag != '»' && pag != '«'){
			var tP     = arrProductos.length;
			var li     = $(this).parent();
			
			/*numero de productos por pagina*/
			var numPro = $("#mostrar").val();
			/*intervalo inicio para mostrar los productos*/
			var inicio = (pag-1) * numPro;
			/*numero de paginas total*/
			var tPages = tP/numPro;
			var residuo= tP%numPro;
			/*si existe un residuo se agrega una pagina mas y se trunca tpages*/
			tPages = (residuo != 0) ? Math.floor(tPages) + 1 : Math.floor(tPages);

			$("#paginacion").find('.active').removeClass('active');
			li.addClass('active');
			puntero = pag;

			/*si la pag es 1 bloqueamos el elemento atras*/
			if(pag == 1){
				$("#paginacion").find("li:first").addClass('disabled')
			}else{
				$("#paginacion").find("li:first").removeClass('disabled')
			}
			/*si la pagina es la ultima se bloque el boton siguiente de la paginacion*/
			if(pag == tPages){
				$("#paginacion").find("#next").addClass('disabled');
			}else{/*si no se desbloquea*/
				$("#paginacion").find("#next").removeClass('disabled');
			}
			/*se comprueba que no sean los botones next y before*/

			
			$("#results").html(buildThumbnails(inicio,(inicio+numPro)));
		}
	})
	/*eventos para botones next y before de la paginacion*/
	$("#paginacion").on("click","#next",function(e){
		e.preventDefault();
		if( !$(this).hasClass('disabled') ){
			var current = $("#paginacion").find(".active").removeClass('active').next().addClass('active');
			var tP      = arrProductos.length;
			var numPro  = $("#mostrar").val();
			/*numero de paginas total*/
			var tPages  = tP/numPro;
			var residuo = tP%numPro;
			var inicio  = (puntero)*numPro;
			/*si existe un residuo se agrega una pagina mas y se trunca tpages*/
			//console.log(inicio);
			tPages = (residuo != 0) ? Math.floor(tPages) + 1 : Math.floor(tPages);
			if(tPages == current.text()){
				$("#paginacion #next").addClass('disabled');
				$("#paginacion #before").removeClass('disabled');
			}
			$("#results").html(buildThumbnails(inicio,(inicio+numPro)));
		}
	})
	$("#paginacion").on("click","#before",function(e){
		e.preventDefault();
		if( !$(this).hasClass('disabled') ){
			var numPro  = $("#mostrar").val();
			var inicio = (puntero-1)*numPro;
			var current = $("#paginacion").find(".active").removeClass('active').prev().addClass('active');
			if(1 == current.text()){
				$("#paginacion #before").addClass('disabled');
				$("#paginacion #next").removeClass('disabled');
			}
			$("#results").html(buildThumbnails(inicio,(inicio+numPro)));
		}
	})
})

/*
*Funcion que obiene un json con los productos por categoria
*Recibe las ids de las categorias y el numero de productos que se mostraran
*llama a buildThumbnails para poner el numero de articulos por pagina
*/
function getProductos(ids){
	
	var objAjax = ajax('getByCategorias',ids,'post','json',0);
		objAjax
	.done(function(data){
		/*data tiene dos objetos: productos y subcategorias*/
		arrProductos = data.productos;
		
		/*se obtienen las subcategorias*/
		var strSubcategorias = '<option value="">Todas</option>';
		for (var i in data.subcategorias ) {
			strSubcategorias += '<option value="'+data.subcategorias[i].id+'">'+ data.subcategorias[i].subcategoria+'</option>';
		}
		$("#subcategoria").html(strSubcategorias);
		//numero de productos por pagina
		var numPro = $("#mostrar").val();
		buildPagination('paginacion');
		puntero = 1;
		$("#results").html(buildThumbnails(0,numPro));
		$('body').attr('style','cursor:auto;');
	})
	.fail(function(){
		$('body').attr('style','cursor:auto;')
		$("#results").html('Error');
	})

}
/*Construye las cajas para las imgs
*recibe inicio y fin
*/
function buildThumbnails(inicio,fin){
	var htmlProductos = "";
	var htmlProductoss = "";
	/*total de articulos*/
	var nP = arrProductos.length;
	/*se valida que no se desborde*/
	if(fin >= nP ){
		fin = nP;
	}
	if(inicio < 0){
		inicio = 0;
	}

	for (var x = inicio; x < fin; x++) {
		var activ=arrProductos[x].activo;
			htmlProductos += 	'<div class="col-xs-6 col-md-3">';
			htmlProductos += 		'<div class="thumbnail thumbnailprod">';
			htmlProductos +=			'<a href="'+$("#root").val()+"/producto/"+arrProductos[x].id+'" class="">';
			htmlProductos +=				'<img class="img-responsive" style="max-width:158px; height:84px;"src="assets/img/productos/'+arrProductos[x].img+'" alt="'+arrProductos[x].producto+'">';
			htmlProductos +=			'</a>';	
		
			
		if(activ==1){
			

			htmlProductos +=          	'<div class="caption">';
			htmlProductos +=			 	'<div style="height:35px"><h5 class="nombre">'+arrProductos[x].producto+'</h5></div>';
			htmlProductos +=        		 '<div class="detalle"><div class="col-md-12 col-xs-12"> <span class="text-right precio"> $'+formatMoney(arrProductos[x].precio_inicial,2)+'</span></div><a class="btn btn-primary btn-sm addCart" href="'+arrProductos[x].id+'" name="'+arrProductos[x].producto+'" >Al carrito</a></div>';
			htmlProductos +=			 '</div>';																																																
			htmlProductos += 		'</div>';
			htmlProductos +=	'</div>';	

			/*
		htmlProductos +=        		 '<div class="detalle"><a class="btn btn-primary btn-sm addCart" href="'+arrProductos[x].id+'" name="'+arrProductos[x].producto+'" >Al carrito</a><span class="text-right precio"> $'+formatMoney(arrProductos[x].precio_inicial,2)+'</span></div>'

								
			
			*/
		}
		
			if(activ==3){
			
			
			
			htmlProductos +=          	'<div class="caption">';
			htmlProductos +=			 	'<div style="height:35px"><h5 class="nombre">'+arrProductos[x].producto+'</h5></div>';
			htmlProductos +=        		 '<div class="detalle"><div class="col-md-12 col-xs-12">Solo en tienda</div><a class="btn btn-primary btn-sm" href="'+$("#root").val()+"/producto/"+arrProductos[x].id+'" >Ver detalles</a></div>';

			//<a class="btn btn-primary btn-sm" href="{{route('index')}}/producto/{{$producto->id}}" >Ver Detalles</a>
			htmlProductos +=			 '</div>';
			htmlProductos += 		'</div>';
			htmlProductos +=	'</div>';
			
		}
	}

	

	return htmlProductos;
}

/*funcion que construye la paginacion*/
function buildPagination(contener){
	/*total de productos*/
	var tP         = arrProductos.length;
	/*productos por pagina*/
	var numPro     = $("#mostrar").val();
	var tPages     = tP/numPro;
	var residuo    = tP%numPro;
	var disabled   = "";
	var active     = "";
	var pagination = '<li id="before" class="disabled"><span>&laquo;</span></li>';
	tPages = (residuo != 0) ? Math.floor(tPages) + 1 : Math.floor(tPages);
	
	for (var i = 0; i < tPages; i++) {
		active = (i == 0)?'active':'';
		pagination += '<li class="'+active+'"><a href="#">'+(i+1)+'</a></li>';
	}
	disabled = (tPages == 1)?'disabled':'';
	pagination += '<li id="next" class="'+disabled+'"><a  href="#">&raquo;</a></li>';
	$("#"+contener).html(pagination);
}

