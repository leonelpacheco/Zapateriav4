
$(function(){
	var tr;
	var productos;
	/*agregar una nueva fila*/
	$("#agregar").on("click",function(){
		productos = $("#productosHidden").html();
		tr = '<tr><td name="col1"></td><td name="col2"><select class="form-control" name="productos[]" >'+productos+'</select></td><td><input class="form-control" type="text"  name="cantidad[]"/></td><td><span class="icon-close" style="font-size:25px;color:red;"></span></td></tr>';
		$('#pedido_productos').append(tr);
	})
	/*evento change para los selects de la tabla productos de pedidos*/
	$("#pedido_productos").on('change','select[class=form-control]',function(){
		var id = $(this).val();
		//$("#productosHidden").find("option[value="+id+"]").remove();
		var tr = $(this).parent().parent();
		var tdFirst = tr.find('td[name=col1]');
		tdFirst.html(id);
	})
	/*quitar una fila*/
	$("#pedido_productos").on('click','td .icon-close',function(){
		
		var tr     = $(this).parent().parent();
		var option = tr.find('.form-control :selected');
		var val    = option.val();
		var text   = option.html();
		$("#productosHidden").append('<option value="'+val+'">'+text+'</option>');
		tr.remove();
	})
})
