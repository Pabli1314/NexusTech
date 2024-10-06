<div class="container-fluid bg-light">
<h3 class="text-center" style="padding: 30px;">Mis Compras</h3>
<?php if (!empty($consulta) && is_array($consulta)): ?>
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nombre del Producto</th>
                <th scope="col">Marca</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Fecha de Compra</th>
                <th scope="col">Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consulta as $row): ?>
                <tr>
                    <td><?= $row['nom_producto'] ?></td>
                    <td><?= $row['marca'] ?></td>
                    <td><?= $row['detalle_cantidad'] ?></td>
                    <td>$<?= number_format($row['detalle_precio'], 2, ',', '.') ?></td>
                    <td><?= $row['fecha_venta'] ?></td>
                    <td><img src="<?= base_url('public/assets/uploads/'.$row['img_producto']) ?>" alt="Imagen Producto" width="100"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="container-md text-center">
        <img src="<?= base_url('public/assets/img/carrito.png') ?>" id="imgCarrito">
        <h1>Realiza tu primera compra y los productos adquiridos se mostrarán aquí.</h1>
    </div>
<?php endif; ?>
</div>
