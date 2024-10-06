<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url() ?>">NexusTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Nuestros Productos
            </a>
            <ul class="dropdown-menu">
                <p class="text-start">Acesorios</p>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?php echo base_url("mouses");?>">Mouse</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url("teclados");?>">Teclados</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url("auriculares");?>">Auriculares</a></li> <br>
                <p class="text-start">Dispositivos</p>
                <hr class="dropdown-divider">	
                <li><a class="dropdown-item" href="<?php echo base_url("televisores-monitores");?>">Televisores y Monitores</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url("celulares");?>">Celulares</a></li>
                <li><a class="dropdown-item" href="<?php echo base_url("netbooks");?>">Netbooks</a></li>
            </ul>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('carrito')?>" class="nav-link active"><i class="fa-solid fa-cart-shopping"></i> Mi carrito</a>
            </li>
            <?php if (session('perfil') == 1) { ?>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url('administrador') ?>">Volver al administrador</a>
                </li>   
            <?php } ?>
            <?php if(session('login')){ ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url("mis-compras/".session('id'));?>">Mis compras</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active"><?= "¡Hola! " . session('nombre') ?></a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url('cerrarSesion') ?>" class="nav-link text-light">Cerrar Sesion</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url('iniciarSesion') ?>" >Iniciar sesion</a>
                </li>
            <?php }?>
        </ul>
        <form class="d-flex" role="search" method="post" action="<?= site_url('buscador/buscar') ?>">
            <?= csrf_field() ?> <!-- Añade el campo CSRF para protección -->
            <?= form_input([
                'name' => 'query',  // Nombre del campo input
                'class' => 'form-control me-2', 
                'type' => 'search', 
                'placeholder' => 'Buscar', 
                'aria-label' => 'Search'
            ])?>
            <?= form_submit('buscar', 'Buscar', ['class' => 'btn btn-outline-info']) ?>
        </form>
        </div>
    </div>
    </nav>
</header>
