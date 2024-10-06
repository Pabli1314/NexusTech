<br>
<div class="container">
    <div class="row">
        <?php if(isset($productos) && !empty($productos)): ?>
            <?php foreach($productos as $row): ?>
                <?php if($row['estado_producto'] == 1): ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="<?= base_url('public/assets/uploads/'.$row['img_producto']) ?>" class="card-img-top" alt="Imagen del producto">
                            <div class="card-body">
                                <center>
                                    <h5 class="card-title">$<?= number_format($row['precio'], 2, ',', '.') ?></h5>
                                    <p class="card-text"><?= $row['nom_producto'] ?></p>
                                    <a href="<?= base_url('visitar/'.$row['id_producto'])?>" class="btn btn-info">Visitar</a>
                                </center>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="container text-center">
                <div class="alert alert-warning" role="alert">
                    No se encontraron productos.
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
