<div class="container-fliud bg-white"> 
    <br>
    <div class="text-center" style="margin: 5px">
        <div class="h3">Consultas Registradas</div>
    </div>
    <br>
    <table class="table table-striped table-hover table-bordered align-middle">
    <thead class="table-dark">
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Consulta</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado Leido</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($consultas as $consulta): ?>
            <tr>
                <td class="table-warning"  scope="row"><?php echo $consulta['nombre']; ?></td>
                <td class="table-warning"><?php echo $consulta['correo']; ?></td>
                <td class="table-warning"><?php echo $consulta['consulta']; ?></td>
                <td class="table-warning"><?php echo $consulta['fecha']; ?></td>
                <td>
                     <?php if ($consulta['estado_leido'] == 0) { ?>
                        <a class="btn btn-dark btn-sm same-size" href="<?php echo base_url('leerConsulta'.$consulta['id_consulta']); ?>">Marcar como leído.</a>
                    <?php } else { ?>
                        <a class="btn btn-info btn-sm same-size" href="<?php echo base_url('noLeerConsula/'.$consulta['id_consulta']); ?>">Desmarcar como leído</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
    </table>
   
    
</div>
