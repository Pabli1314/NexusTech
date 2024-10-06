<br>
<div class="container">
    <div class="text-center"><h1>Contactos</h1></div>

        <p>Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos a través de los siguientes medios:</p>
        
        <h2>Teléfono</h2>

        <p>+54 234 567 8900. De Lunes a Sabado de 9:00 hasta las 21:30.</p>
        <br>
        <h2>Envíanos un mensaje</h2>
        <?php
            $formLabel = [
                'class' => 'form-label'
            ];
            
        ?>
        <?php if (session('login')) { ?>
            <div class="container">
                <?= form_open('validarConsulta') ?>
                <?= form_hidden('nombre', session('nombre')." ".session('apellido')); ?>
                <?= form_hidden('correo', session('correo')); ?>
                <br>
                <?php echo form_label('Consulta', 'consulta'); ?>
                <?php echo form_textarea(['name' => 'consulta', 'class' => 'form-control', 'id' => 'consulta']);?>
                <br>
                <?php echo form_submit('enviar', 'Enviar', ['class' => 'btn btn-info', 'id'=> 'enviarFormulario']);?> 
                <?php echo form_close(); ?>
            </div> 
        <?php } else { ?>
        <div class="container">
        <?php echo form_open('validarConsulta') ?>
        <?php echo form_label('Nombre', 'nombre'); ?>
        <?php echo form_input(['name' => 'nombre', 'class' => 'form-control', 'id' => 'nombre']);?> 
        <br>
        <?php echo form_label('Correo', 'correo'); ?>
        <?php echo form_input(['name' => 'correo', 'class' => 'form-control', 'id' => 'correo']); ?>
        <br>
        <?php echo form_label('Consulta', 'consulta'); ?>
        <?php echo form_textarea(['name' => 'consulta', 'class' => 'form-control', 'id' => 'consulta']);?>
        <br>
        <?php echo form_submit('enviar', 'Enviar', ['class' => 'btn btn-info', 'id'=> 'enviarFormulario']);?> 
        <?php echo form_close(); ?>
    </div> 
    <?php } ?>
         <br> <br>
       <div class="container">
       <h2>Dirección de la empresa</h2>
        <p>Junin y La Rioja, Corrientes Capital, Argentina</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.0591953724165!2d-58.8406369255335!3d-27.467416416607065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca48e0dd4ad%3A0x6438a6e6c458a8ec!2sLa%20Rioja%20%26%20Junin%2C%20Corrientes!5e0!3m2!1ses-419!2sar!4v1713393689362!5m2!1ses-419!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <br> <br>
        <h2>Síguenos en nuestras redes sociales</h2>
        <p>
        <i class="fa-brands fa-facebook"></i> <a href="https://www.facebook.com" target="_blank">Facebook</a> |
        <i class="fa-brands fa-instagram"></i>  <a href="https://www.instagram.com" target="_blank">Instagram</a>
        </p>
       </div>
        
    </div>
</div>

<script>
    const myModal = document.querySelector('#myModal');
    const cerrarModal = document.querySelector('#cerrarModal');

</script>
