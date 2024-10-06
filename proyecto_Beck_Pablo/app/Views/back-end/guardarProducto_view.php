<div class="container-fluid bg-light">
    <div class="container">
         <?php $formLabel = ['class' => 'form-label']; ?>
    <br>
    <?= form_open_multipart('insertar-producto') ?>
        <?php
            $lista['0'] = 'Seleccione categoría';
            foreach ($categorias as $row) {
                $categoria_id = $row['id_categoria'];
                $descripcion = $row['nom_categoria'];
                $lista[$categoria_id] = $descripcion;
            }
            echo form_dropdown('categoria', $lista, '0', 'class="form-control"');
        ?>
        <br>
        <?= form_label('Marca', 'marca', $formLabel) ?>
        <?= form_input(['name' => 'marca', 'id' => 'marca', 'class' => 'form-control']) ?>
        <br>
        <?= form_label('Nombre del producto', 'nom_producto', $formLabel) ?>
        <?= form_input(['name' => 'nom_producto', 'id' => 'nom_producto', 'class' => 'form-control']) ?>
        <br>
        <?= form_label('Precio', 'precio', $formLabel) ?>
        <?= form_input(['name' => 'precio', 'type' => 'number', 'id' => 'precio', 'class' => 'form-control']) ?>
        <br>
        <?= form_label('Stock', 'stock', $formLabel) ?>
        <?= form_input(['name' => 'stock', 'type' => 'number', 'id' => 'stock', 'class' => 'form-control']) ?>
        <br>
        <?= form_label('Descripción', 'descripcion', $formLabel) ?>
        <?= form_input(['name' => 'descripcion', 'id' => 'descripcion', 'class' => 'form-control']) ?>
        <br>
        <?= form_label('Imagen', 'imagen', $formLabel) ?>
        <?= form_upload(['name' => 'imagen', 'id' => 'imagen', 'class' => 'form-control']) ?>
        <br>
        <?= form_submit('guardar', 'Guardar', ['class' => 'btn btn-primary']) ?>
    <?= form_close() ?>
    <br>
    </div>
</div>
