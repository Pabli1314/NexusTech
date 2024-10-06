<div class="container-fluid bg-light">
    <?php $formLabel = ['class' => 'form-label']; ?>

    <br>
    <?= form_open_multipart('actualizar') ?>
        <?= form_hidden('id_producto', $producto['id_producto']) ?>
        <?php
            $lista['0'] = 'Seleccione categoría';
            if (!empty($categorias)) {
                foreach ($categorias as $row) {
                    $categoria_id = $row['id_categoria'];
                    $descripcion = $row['nom_categoria'];
                    $lista[$categoria_id] = $descripcion;
                }
            }
            $sel = $producto['cat_producto']; 
            echo form_dropdown('categoria', $lista, $sel, 'class="form-control"');
        ?>
        <br>
        <?= form_label('Marca', 'marca', $formLabel) ?>
        <?= form_input(['name' => 'marca', 'id' => 'marca', 'class' => 'form-control', 'value' => $producto['marca'] ]) ?>
        <br>
        <?= form_label('Nombre del producto', 'nom_producto', $formLabel) ?>
        <?= form_input(['name' => 'nom_producto', 'id' => 'nom_producto', 'class' => 'form-control', 'value' => $producto['nom_producto'] ]) ?>
        <br>
        <?= form_label('Precio', 'precio', $formLabel) ?>
        <?= form_input(['name' => 'precio', 'type' => 'number', 'id' => 'precio', 'class' => 'form-control', 'value' => $producto['precio'] ]) ?>
        <br>
        <?= form_label('Stock', 'stock', $formLabel) ?>
        <?= form_input(['name' => 'stock', 'type' => 'number', 'id' => 'stock', 'class' => 'form-control', 'value' => $producto['stock'] ]) ?>
        <br>
        <?= form_label('Descripción', 'descripcion', $formLabel) ?>
        <?= form_textarea(['name' => 'descripcion', 'id' => 'descripcion', 'class' => 'form-control', 'value' => $producto['descripcion'] ]) ?>
        <br>
        <?= form_label('Imagen', 'imagen', $formLabel) ?>
        <?= form_upload(['name' => 'imagen', 'id' => 'imagen', 'class' => 'form-control']) ?>
        <center>
            <img src="<?php echo base_url('public/assets/uploads/'.$producto['img_producto']);?>" alt="" style="height:150px; width:150px" >
        </center>
        <br>
        <?php echo form_hidden('id', $producto['id_producto']); ?>
        <?php echo form_hidden('imagen', $producto['img_producto'])?>
        <?= form_submit('guardar', 'Guardar', ['class' => 'btn btn-primary']) ?>
    <?= form_close() ?>
    <br>
</div>  
            