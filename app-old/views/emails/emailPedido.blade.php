<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<style>
		
table {
  max-width: 100%;
  background-color: transparent;
}

th {
  text-align: left;
}

.tablexxx {
  width: 100%;
  margin-bottom: 20px;
  border-collapse: collapse !important;
border-spacing: 0px !important;
}

.tablexxx > thead > tr > th,
.tablexxx > tbody > tr > th,
.tablexxx > tfoot > tr > th,
.tablexxx > thead > tr > td,
.tablexxx > tbody > tr > td,
.tablexxx > tfoot > tr > td {
  padding: 8px;
  line-height: 1.428571429;
  vertical-align: top;
  border-top: 1px solid #dddddd;
}

.tablexxx > thead > tr > th {
  vertical-align: bottom;
  border-bottom: 2px solid #dddddd;
}

.tablexxx > caption + thead > tr:first-child > th,
.tablexxx > colgroup + thead > tr:first-child > th,
.tablexxx > thead:first-child > tr:first-child > th,
.tablexxx > caption + thead > tr:first-child > td,
.tablexxx > colgroup + thead > tr:first-child > td,
.tablexxx > thead:first-child > tr:first-child > td {
  border-top: 0;
}

.tablexxx > tbody + tbody {
  border-top: 2px solid #dddddd;
}

.tablexxx .tablexxx {
  background-color: #ffffff;
}

.tablexxx-condensed > thead > tr > th,
.tablexxx-condensed > tbody > tr > th,
.tablexxx-condensed > tfoot > tr > th,
.tablexxx-condensed > thead > tr > td,
.tablexxx-condensed > tbody > tr > td,
.tablexxx-condensed > tfoot > tr > td {
  padding: 5px;
}

.tablexxx-bordered {
  border: 1px solid #dddddd;
}

.tablexxx-bordered > thead > tr > th,
.tablexxx-bordered > tbody > tr > th,
.tablexxx-bordered > tfoot > tr > th,
.tablexxx-bordered > thead > tr > td,
.tablexxx-bordered > tbody > tr > td,
.tablexxx-bordered > tfoot > tr > td {
  border: 1px solid #dddddd;
}

.tablexxx-bordered > thead > tr > th,
.tablexxx-bordered > thead > tr > td {
  border-bottom-width: 2px;
}

.tablexxx-striped > tbody > tr:nth-child(odd) > td,
.tablexxx-striped > tbody > tr:nth-child(odd) > th {
  background-color: #f9f9f9;
}

.tablexxx-hover > tbody > tr:hover > td,
.tablexxx-hover > tbody > tr:hover > th {
  background-color: #f5f5f5;
}

table col[class*="col-"] {
  position: static;
  display: table-column;
  float: none;
}

table td[class*="col-"],
table th[class*="col-"] {
  display: table cell;
  float: none;
}

.tablexxx > thead > tr > .active,
.tablexxx > tbody > tr > .active,
.tablexxx > tfoot > tr > .active,
.tablexxx > thead > .active > td,
.tablexxx > tbody > .active > td,
.tablexxx > tfoot > .active > td,
.tablexxx > thead > .active > th,
.tablexxx > tbody > .active > th,
.tablexxx > tfoot > .active > th {
  background-color: #f5f5f5;
}

.tablexxx-hover > tbody > tr > .active:hover,
.tablexxx-hover > tbody > .active:hover > td,
.tablexxx-hover > tbody > .active:hover > th {
  background-color: #e8e8e8;
}

.tablexxx > thead > tr > .success,
.tablexxx > tbody > tr > .success,
.tablexxx > tfoot > tr > .success,
.tablexxx > thead > .success > td,
.tablexxx > tbody > .success > td,
.tablexxx > tfoot > .success > td,
.tablexxx > thead > .success > th,
.tablexxx > tbody > .success > th,
.tablexxx > tfoot > .success > th {
  background-color: #dff0d8;
}

.tablexxx-hover > tbody > tr > .success:hover,
.tablexxx-hover > tbody > .success:hover > td,
.tablexxx-hover > tbody > .success:hover > th {
  background-color: #d0e9c6;
}

.tablexxx > thead > tr > .danger,
.tablexxx > tbody > tr > .danger,
.tablexxx > tfoot > tr > .danger,
.tablexxx > thead > .danger > td,
.tablexxx > tbody > .danger > td,
.tablexxx > tfoot > .danger > td,
.tablexxx > thead > .danger > th,
.tablexxx > tbody > .danger > th,
.tablexxx > tfoot > .danger > th {
  background-color: #f2dede;
}

.tablexxx-hover > tbody > tr > .danger:hover,
.tablexxx-hover > tbody > .danger:hover > td,
.tablexxx-hover > tbody > .danger:hover > th {
  background-color: #ebcccc;
}

.tablexxx > thead > tr > .warning,
.tablexxx > tbody > tr > .warning,
.tablexxx > tfoot > tr > .warning,
.tablexxx > thead > .warning > td,
.tablexxx > tbody > .warning > td,
.tablexxx > tfoot > .warning > td,
.tablexxx > thead > .warning > th,
.tablexxx > tbody > .warning > th,
.tablexxx > tfoot > .warning > th {
  background-color: #fcf8e3;
}

.tablexxx-hover > tbody > tr > .warning:hover,
.tablexxx-hover > tbody > .warning:hover > td,
.tablexxx-hover > tbody > .warning:hover > th {
  background-color: #faf2cc;
}

@media (max-width: 767px) {
  .tablexxx-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: scroll;
    overflow-y: hidden;
    border: 1px solid #dddddd;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    -webkit-overflow-scrolling: touch;
  }
  .tablexxx-responsive > .tablexxx {
    margin-bottom: 0;
  }
  .tablexxx-responsive > .tablexxx > thead > tr > th,
  .tablexxx-responsive > .tablexxx > tbody > tr > th,
  .tablexxx-responsive > .tablexxx > tfoot > tr > th,
  .tablexxx-responsive > .tablexxx > thead > tr > td,
  .tablexxx-responsive > .tablexxx > tbody > tr > td,
  .tablexxx-responsive > .tablexxx > tfoot > tr > td {
    white-space: nowrap;
  }
  .tablexxx-responsive > .tablexxx-bordered {
    border: 0;
  }
  .tablexxx-responsive > .tablexxx-bordered > thead > tr > th:first-child,
  .tablexxx-responsive > .tablexxx-bordered > tbody > tr > th:first-child,
  .tablexxx-responsive > .tablexxx-bordered > tfoot > tr > th:first-child,
  .tablexxx-responsive > .tablexxx-bordered > thead > tr > td:first-child,
  .tablexxx-responsive > .tablexxx-bordered > tbody > tr > td:first-child,
  .tablexxx-responsive > .tablexxx-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .tablexxx-responsive > .tablexxx-bordered > thead > tr > th:last-child,
  .tablexxx-responsive > .tablexxx-bordered > tbody > tr > th:last-child,
  .tablexxx-responsive > .tablexxx-bordered > tfoot > tr > th:last-child,
  .tablexxx-responsive > .tablexxx-bordered > thead > tr > td:last-child,
  .tablexxx-responsive > .tablexxx-bordered > tbody > tr > td:last-child,
  .tablexxx-responsive > .tablexxx-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .tablexxx-responsive > .tablexxx-bordered > tbody > tr:last-child > th,
  .tablexxx-responsive > .tablexxx-bordered > tfoot > tr:last-child > th,
  .tablexxx-responsive > .tablexxx-bordered > tbody > tr:last-child > td,
  .tablexxx-responsive > .tablexxx-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }
}

		.headerproductos{
			color: #000;
		}
		.tbodyproductos{
			color: blue;
		}
		</style>
	</head>
	<body>
		<h3>Gracias por su compra, agradecemos mucho su preferencia</h3>
	
		<?php  $columnas = array('producto' => 'Producto','cantidad' => 'Cantidad','precio' => 'Precio Unitario' )?>
		<div class="tablexxx-responsive">
				{{Form::tablaProductosEmail($productos)}}
		</div>
	<div class="panel-body">
					@if(sizeof($noStock))
					<p class="bg-danger">Los siguientes productos no estan disponibles inmediatamente, por favor pongase en contacto a los numeros siguientes para cualquier aclaración</p>
					<div class="tablexxx-responsive">
						<table class="tablexxx tablexxx-bordered fondoWhite">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Cantidad pedida</th>
									<th>Cantidad disponible</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($noStock as $producto) 	
								<tr>
									<td>{{$producto['producto']}}</td>
									<td>{{$producto['cantidadPedida']}}</td>
									<td>{{$producto['stockDisponible']}}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
					<div class="bg-danger">
						Es muy importante que nos contacte para aclarar el envio debido a que no todos los productos estan disponibles para envio inmediato.
					</div>
					@else
					<p class="bg-success">Su pedido fue procesado correctamente, una ves realizado el deposito por favor contactenos a los siguientes telefonos o al correo tienda@gruposiel.com para que su pedido se enviado a la brevedad posible. Gracias por su preferncia.</p>
					@endif
				</div>
	</body>
</html>