<!-- En este archivo se encontrará la estructura del Modal y del toast de Boostrap que mostrarán 
los errores y mensajes que se envían desde el controlador -->



<?php if (session('mensaje') || session('login') == false ): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= esc(session('mensaje')) ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($validation)): ?>
    <div class="modal fade show" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Errores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($validation as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        let myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show(); // Mostrar el modal automáticamente cuando haya errores de validación
    });
</script>
