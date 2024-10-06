
		<!-- Configurar el Carousel con las imagenes de cada producto --> 
		<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
			<img src="public/assets/img/teclados.jpeg" class="imgCarousel" alt="...">
			</div>
			<div class="carousel-item">
			<img src="public/assets/img/3.jpg" class="imgCarousel" alt="...">
			</div>
			<div class="carousel-item">
			<img src="public/assets/img/2.jpeg" class="imgCarousel" alt="...">
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
		</div>

		  <!-- Cards -->
		<br>

<h3 class="text-center">Nuestros Productos</h3> <br>

<div class="container">
    <div class="row">
    	<?php $cont = 0; //Es un contador ?>
        <?php foreach($productos as $row): ?>
            <?php if($row['estado_producto'] == 1): ?>
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
                <?php $cont++ ?>
            <?php endif; ?>
            <?php if ($cont == 12) {
            	break;
            } ?>
        <?php endforeach ?>
    </div>
</div>
