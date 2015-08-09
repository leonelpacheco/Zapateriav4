$(function(){
	$("#categoria_id").on("change",function(){
		var id = $(this).val();
		var url = $("#root").val()+"/subcategorias/getSubcategoriasByCategoria"
		var peticion = ajax(url,"categoria_id="+id,'post','json'); 
		peticion
		.done(function(data){
			var option = "";
			for(x in data){
				option += '<option value="'+data[x].id+'">'+data[x].subcategoria+'</option>'; 
			}
			$("#subcategoria_id").html(option);
		})
		.fail(function(){
			alert("Ocurrio un problema");
		})
	})
	$("input[name=imgFile]").on("change",function(){
		$("#img").val($(this).val())
	})
	$("#submitproducto").on("click",function(event){
		if( ! validar("#formproducto")){
			event.preventDefault();
			return;
		}
		console.log('ok')
	})
$("#submitcategoria").on("click",function(event){
        if( ! validar("#FormCategoria")){
            event.preventDefault();
            return;
        }
        console.log('ok')
    })
$("#submitsubcategoria").on("click",function(event){
        if( ! validar("#FormSubcategoria")){
            event.preventDefault();
            return;
        }
        console.log('ok')
    })
$("#submituser").on("click",function(event){
        if( ! validar("#FormUser")){
            event.preventDefault();
            return;
        }
        console.log('ok')
    })

})

function ajax(url,data,method,dataType){
	var objAjax = $.ajax({
					url:url,
					type:method,
					data : data,
					dataType : dataType
				})
	return objAjax;
}
var validar = function (selector){
    //var texts = $(selector).find(":text");
    var bnd ;
    console.log(selector)
    $(selector).find(":text").each(function( index ) {
        var minlength = ( $(this).attr('minlength') ) ? $(this).attr('minlength') : 0 ;
        var required = ( $(this).attr('required') ) ? 1 : 0 ;

        var campoVal = $.trim( $(this).val() );
        var campolength = campoVal.length;
        console.log(required)
        if( minlength || required ){
        	console.log('lal')
            if ( required && campolength == 0 ){
                $(this).addClass('campoNoValido');
                $(this).attr('title',"Campo requerido");
                $('html,body').animate({scrollTop: $(this).offset().top - 48}, 800);
                bnd = false;
                return bnd;
            }else{
                $(this).removeAttr('title');
                $(this).removeClass('campoNoValido');
                bnd = true;
            }
            if( minlength != 0 && campolength < minlength ){
                $(this).attr('title',"El campo debe tener almenos "+minlength+' caracteres')
                $(this).addClass('campoNoValido');
                $('html,body').animate({scrollTop: $(this).offset().top - 48}, 800);
                console.log("minlengt")
                bnd = false;
                return bnd;
            } else {
                $(this).removeAttr('title')
                $(this).removeClass('campoNoValido');
                bnd = true;
                //return true;
            }
        }
    });
    return bnd;
}