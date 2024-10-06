<br>

<nav aria-label="breadcrumb" class="miBreadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Nuestros Productos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mouses</li>
  </ol>
</nav>

<br>
<br>

<div class="container">
    <div class="row">
        <?php foreach($productos as $row): ?>
            <?php if($row['estado_producto'] == 1 && $row['cat_producto'] == 1): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= base_url('public/assets/uploads/'.$row['img_producto']) ?>" class="card-img-top" alt="Imagen del producto">
                        <div class="card-body">
                            <center>
                                <h5 class="card-title">$<?= number_format($row['precio'], 2, ',', '.')  ?></h5>
                                <p class="card-text"><?= $row['nom_producto'] ?></p>
                                <a href="<?= base_url('visitar/'.$row['id_producto'])?>" class="btn btn-info">Visitar</a>
                            </center>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    </div>
</div>