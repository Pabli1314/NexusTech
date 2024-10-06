<?php if (session('perfil') == 1){ ?>
  <nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="<?php echo base_url("administrador") ?>">NexusTech</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="#" class="nav-link active text-light"><?= "¡Hola! " . session('nombre') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="<?php echo base_url("listadoUsuarios") ?>">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-light" aria-current="page" href="<?php echo base_url("verConsultas") ?>">Consultas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?php echo base_url('listarVentas') ?>">Listar ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?php echo base_url('agregarProducto') ?>">Registrar productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?php echo base_url('/') ?>">Ver como cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="<?php echo base_url('cerrarSesion') ?>">Cerrar Sesion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } else{ ?>
<div class="modal show" id="myModal" tabindex="-1" role="dialog" style="display: block;">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Error</h5>
          </div>
          <div class="modal-body">
              En nuestras medidas de seguridad solo los administradores pueden entrar a esta parte de la web.
          </div>
          <div class="modal-footer">
              <a href="<?= base_url('/'); ?>" class="btn btn-info">Aceptar</a>
          </div>
      </div>
  </div>
</div>

<?php } ?>