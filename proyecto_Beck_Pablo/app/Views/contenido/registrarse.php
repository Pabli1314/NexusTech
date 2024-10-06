<br>
<?php
    $formLabel = [
        'class' => 'form-label'
    ];  
?>


<div class="container-md text-center">
  <?php echo form_open('formularioRegistrarse');?>
    <?php echo form_label('Nombre', 'nombre', $formLabel); ?>
    <?php echo form_input(['name' => 'nombre', 'class' => 'form-control', 'id' => 'nombre']);?>
    <br>
    <?php echo form_label('Apellido', 'apellido', $formLabel); ?>
    <?php echo form_input(['name' => 'apellido', 'class' => 'form-control', 'id' => 'apellido']);?>
    <br>
    <?php echo form_label('DNI', 'dni', $formLabel); ?>
    <?php echo form_input(['name' => 'dni', 'class' => 'form-control', 'id' => 'dni', "type" => "number"]);?>
    <br>
    <?php echo form_label('Telefono', 'telefono', $formLabel); ?>
    <?php echo form_input(['name' => 'telefono', 'class' => 'form-control', 'id' => 'telefono', "type" => "number"]);?>
    <br>
    <?php echo form_label('Correo', 'correo', $formLabel); ?>
    <?php echo form_input(['name' => 'correo', 'class' => 'form-control', 'id' => 'correo']);?>
    <br>
    <?php echo form_label('Contraseña', 'password', $formLabel); ?>
    <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'id' => 'password']);?>
    <br>
    <?php echo form_label('Repetir contraseña', 'repetir-password', $formLabel); ?>
    <?php echo form_password(['name' => 'repetir-password', 'class' => 'form-control', 'id' => 'repetir-password']);?>
    <br>
    <?php echo form_checkbox('validar', 'validar', false); ?> <label for="">Acepto los <a href="<?php echo base_url('terminos-y-condiciones'); ?>">terminos y condiciones</a>.</label>
    <br> <br>
    <?php echo form_submit('crear-cuenta', 'Crear cuenta', 'class="btn btn-info"'); ?>
  <?php echo form_close(); ?>  
    </div>
