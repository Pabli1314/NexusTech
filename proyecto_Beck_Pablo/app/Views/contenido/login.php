<?php
    $formLabel = [
        'class' => 'form-label'
    ];
    
?>
<br>
<div class="container text-center">
    <?php if (!empty($validation)): ?>
        <div class="modal show" id="myModal" tabindex="-1" role="dialog" style="display: block;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Errores</h5>
                        </div>
                        <div class="modal-body">

                                        <?php foreach ($validation as $error): ?>
                                            <ul>
                                                <li><?= esc($error)?></li>
                                            </ul>
                                        <?php endforeach ?>
                                        </div>
                        <div class="modal-footer">
                            <a href="<?php echo base_url('iniciarSesion')?>" class="btn btn-info">Cerrar</a>
                        </div>
                    </div>
                </div>
            </div>     
        
    <?php endif ?>
    <?php if (session('mensaje')): ?>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php echo session('mensaje') ?>
            </div>
            </div> 
            </div>   
        <?php endif; ?>                                       
    <?php echo form_open('form_iniciarSesion');?>
        <?php echo form_label('Correo', 'correo', $formLabel) ?>
        <?php echo form_input(['name' => 'correo', 'class' => 'form-control', 'id' => 'correo']);?>
        <br>
        <?php echo form_label('Contraseña', 'password', $formLabel) ?>
        <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'id' => 'password']);?>
        <br>
        <?php echo form_submit('iniciar-sesion', 'Iniciar sesion', 'class="btn btn-info"') ?>
        <a class="btn btn-outline-info text-dark" href="<?php echo base_url('registrarse'); ?>">Registrarse</a>
    <?php echo form_close(); ?>
</div>


