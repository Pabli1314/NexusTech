<div class="container-fluid bg-light">
    <h3 class="text-center" style="padding: 30px">Usuarios Registrados</h3>
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apelido</th>
            <th scope="col">DNI</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario){
            if ($usuario['perfil'] == 2) {
        ?>
            <tr>
            <th><?= $usuario['nombre'] ?></th>
            <td><?= $usuario['apellido'] ?></td>
            <td><?= $usuario['dni'] ?></td>
            <td><?= $usuario['telefono'] ?></td>
            <td><?= $usuario['correo'] ?></td>
            <td>
                    <?php if ($usuario['estado_activo'] == 1) { ?>
                        <a class="btn btn-danger btn-sm same-size" href="<?php echo base_url('usuario/eliminar_usuario/'.$usuario['id']); ?>">Eliminar</a>
                    <?php } else { ?>
                        <a class="btn btn-success btn-sm same-size" href="<?php echo base_url('usuario/activar_usuario/'.$usuario['id']); ?>">Activar</a>
                    <?php } ?>
            </td>
            </tr>
        <?php }} ?>
    </tbody>
    </table>
</div>
