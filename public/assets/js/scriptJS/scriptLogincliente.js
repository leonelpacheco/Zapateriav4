$(function(){
	$("#login").on('click',function(e){
		e.preventDefault();
		var data = 'email='+$("#email").val()+'&password='+$("#password").val();
		var url  = $('#root').val() + '/dologin';
		
		alert (url);
		var objAjax = $.ajax(url,data,'post','json', 0 );

		objAjax.done(function(data){
			$('body').attr('style','cursor:auto;');
			if( data['status'] == 0 ){
				window.location = $("#root").val() +'/' + data['redirect'] ;
			}else{
				alert(data['msj']);
			}
		})
		.fail(function(){
			alert('Ocurrio un problema');
		})
	})
})