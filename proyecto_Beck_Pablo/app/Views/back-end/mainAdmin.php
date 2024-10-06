<?php $categorias = ['Mouse', 'Teclado', 'Auriculares', 'Televisores', 'Monitores', 'Celulares', 'Netbooks']; ?>
<?php if (session('perfil') == 1): ?> 
    <div class="container-fluid bg-light">
        <h3 class="text-center py-4">Listado de productos</h3>

        <table class="table table-striped table-bordered table-hover text-center align-middle">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Categoría</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Nombre del producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto): ?>
                <tr>
                    <th scope="row"><?php echo $categorias[$producto['cat_producto']-1]?></th>
                    <td><?php echo htmlspecialchars($producto['marca']) ?></td>
                    <td><?php echo htmlspecialchars($producto['nom_producto']) ?></td>
                    <td>$<?php echo number_format($producto['precio'], 2) ?></td>
                    <td><?php echo htmlspecialchars($producto['stock']) ?></td>
                    <td><?php echo htmlspecialchars($producto['descripcion']) ?></td>
                    <td><img src="public/assets/uploads/<?php echo htmlspecialchars($producto['img_producto'])?>" alt="Imagen del producto" class="img-fluid img-thumbnail" style="max-width: 100px;"></td>
                    <td>
                        <a href="<?php echo base_url('editar/'.$producto['id_producto']) ?>" class="btn btn-warning btn-sm btn-block mb-2">Editar</a>
                        <?php if ($producto['estado_producto'] == 1): ?>
                            <a class="btn btn-danger btn-sm btn-block mb-2" href="<?php echo base_url('producto/eliminar_producto/'.$producto['id_producto']); ?>">Eliminar</a>
                        <?php else: ?>
                            <a class="btn btn-success btn-sm btn-block mb-2" href="<?php echo base_url('producto/activar_producto/'.$producto['id_producto']); ?>">Activar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif ?>
