<br>
<div class="container-fluid bg-light">
	<h3>Productos comprados por <?php $ventas['nombre'] . " " . $ventas['apellido'] ?></h3>
	<table class="table table-striped table-hover table-bordered align-middle">
		<thead class="table-dark">
			<th>ID detalle venta</th>
			<th>ID venta</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Fecha</th>
		</thead>
		<tbody>
			<?php foreach($detalle as $row) ?>
				<tr>
					<td><?php $row['id_detalle_venta'] ?></td>
					<td><?php $row['id_venta'] ?></td>
					<td><?php $row['nom_producto'] ?></td>
					<td><?php $row['detalle_cantidad'] ?></td>
					<td><?php $row['detalle_precio'] ?></td>
					<td><?php $row['fecha'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div> 