<?php 
$categorias = ['Mouse', 'Teclado', 'Auriculares', 'Televisores', 'Monitores', 'Celulares', 'Netbooks']; 
?>
<br>
<div class="container">
    <div class="text-center">
        <img src="<?= base_url('public/assets/uploads/'.$producto['img_producto']) ?>" alt="Imagen del Producto" class="rounded float-start" style="width: 350px;
    height: 350px;
    border: black solid;">
        <div class="rounded float-end">
            <ul class="list-group">
                <li class="list-group-item text-start"><strong>Precio: </strong>$<?= number_format($producto['precio'], 2, ',', '.') ?></li>
                <li class="list-group-item text-start"><strong>Categoría: </strong> <?= $categorias[$producto['cat_producto'] - 1] ?></li>
                <li class="list-group-item text-start"><strong>Marca: </strong> <?= $producto['marca'] ?></li>
                <li class="list-group-item text-start"><strong>Nombre del producto: </strong><?= $producto['nom_producto'] ?></li>
                <li class="list-group-item text-start"><strong>Descripción: </strong> <?= $producto['descripcion'] ?></li>
            </ul>
            <br>
            <?php if (session('login')): ?>
                <?= form_open('carrito/agregar') ?>
                <?= form_hidden('id', $producto['id_producto']) ?>
                <?= form_hidden('name', $producto['nom_producto']) ?>
                <?= form_hidden('price', $producto['precio']) ?>
                <?= form_submit('comprar', 'Agregar al carrito', "class='btn btn-info'") ?>
                <?= form_close() ?>
            <?php endif; ?>
        </div>        
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>