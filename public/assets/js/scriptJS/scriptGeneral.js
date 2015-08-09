$(function(){
	
	/*evento vinculado a todos los botone eliminar*/
	$(".icon-close").on('click',function(e){
		e.preventDefault();
		var link = $(this).parent().parent();
		var data = '_token='+$('input[name=_token]').val();+'_method=DELETE';
		var resp = ajax($(this).prop('href'),data,'delete');
		resp.done(function(data){
			if(data == 1){
				link.remove()
			}else{
				alert('No se pudo eliminar el recurso');
			}
		})
		.fail(function(){
			alert('error');
		})
	})
})


function ajax(url,data,method){
	var objAjax = $.ajax({
					url:url,
					type:method,
					data : data
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
