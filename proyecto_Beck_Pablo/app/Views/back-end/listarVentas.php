<div class="container-fluid bg-light">
    <div class="text-center" style="padding: 30px">
        <h3>Listado de Ventas</h3> 
    </div>
    
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuariosVentas as $idCliente => $usuario): ?>
                <tr>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['apellido']; ?></td>
                    <td>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?php echo $idCliente; ?>">
                            Ver Detalles
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php foreach($usuariosVentas as $idCliente => $usuario): ?>
    <!-- Modal de Bootstrap -->
    <div class="modal fade" id="modal<?php echo $idCliente; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $idCliente; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?php echo $idCliente; ?>">Productos comprados por <?php echo $usuario['nombre'] . " " . $usuario['apellido']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Marca</th>
                                <th>Fecha</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuario['ventas'] as $venta): ?>
                                <tr>
                                    <td><?php echo $venta['nom_producto']; ?></td>
                                    <td><?php echo $venta['detalle_cantidad']; ?></td>
                                    <td><?php echo $venta['detalle_precio']; ?></td>
                                    <td><?php echo $venta['marca']; ?></td>
                                    <td><?php echo $venta['fecha_venta']; ?></td>
                                    <td><img src="<?php echo base_url('public/assets/uploads/' . $venta['img_producto']); ?>" alt="<?php echo $venta['nom_producto']; ?>" style="width: 50px; height: 50px;"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
