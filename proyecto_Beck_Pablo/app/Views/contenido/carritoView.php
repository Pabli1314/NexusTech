<?php 
$cart = \Config\Services::cart(); 
$total = 0; 
?>
<?php if (session('mensaje')): ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session('mensaje') ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<br>
<h1 class="text-center">Carrito de compras</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Seguir Comprando</a></li>
    <li class="breadcrumb-item active" aria-current="page">Carrito</li>
  </ol>
</nav>
<br><br>

<?php if ($cart->contents() == NULL) { ?>
    <div class="container">
        <h2 class="text-center alert alert-danger">Carrito está vacío</h2>
    </div>
<?php } else { ?>
    <table id="mytable" class="table table-bordred table-striped">
        <thead>
            <tr>
                <th>N° item</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            $i = 1;
            foreach ($cart->contents() as $item): 
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td>$<?php echo $item['price']; ?></td>
                <td><?php echo $item['qty']; ?></td>
                <td>$<?php echo $item['subtotal']; $total += $item['subtotal']; ?></td>
                <td><a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="<?= base_url('eliminar-item/'.$item['rowid']); ?>">Eliminar</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Total Compra: $<?php echo $total; ?></td>
                <td><a href="<?= base_url('vaciar-carrito'); ?>" class="btn btn-outline-danger btn-sm same-size">Vaciar carrito</a></td>
                <td>
                    <button id="btnComprar" class="btn btn-primary btn-sm same-size" type="button">
                      <span id="spinner" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true" style="display: none;"></span>
                      <span id="buttonText">Ordenar compra</span>
                      <span class="visually-hidden" id="loadingText">Efectuando compra</span>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>

<script src="<?= base_url('public/assets/js/jspdf.min.js') ?>"></script>
<script>
document.querySelector('#btnComprar').addEventListener('click', function(event) {
    event.preventDefault();

    // Mostrar el spinner
    document.querySelector('#spinner').style.display = 'inline-block';

    // Ocultar el texto del botón y mostrar el texto de carga
    document.querySelector('#buttonText').style.display = 'none';
    document.querySelector('#loadingText').classList.remove('visually-hidden');

    // Deshabilitar el botón para prevenir múltiples clics
    document.querySelector('#btnComprar').classList.add('disabled');

    let doc = new jsPDF();

    let logo = new Image();
    logo.src = '<?= base_url('public/assets/img/nexustech.png') ?>';
    logo.onload = function() {
        doc.addImage(logo, 'PNG', 80, 10, 50, 30);

        doc.text('Comprobante de Compra', 105, 55, { align: 'center' });
        doc.text('----------------------------------------------------------------------------------------------------------------', 0, 60);

        let startY = 70;
        let marginX = 10;

        doc.text('Nombre y apellido: ', marginX, startY);
        doc.text('<?= session('nombre'). ' ' . session('apellido') ?>', marginX + 50, startY);
        startY += 10;
        doc.text('DNI: ', marginX, startY);
        doc.text('<?= session('dni') ?>', marginX + 50, startY);
        startY += 10;
        doc.text('Telefono: ', marginX, startY);
        doc.text('<?= session('telefono') ?>', marginX + 50, startY);
        startY += 10;
        doc.text('Correo: ', marginX, startY);
        doc.text('<?= session('correo') ?>', marginX + 50, startY);
        startY += 20;

        doc.text('N° ítem', marginX, startY);
        doc.text('Nombre', marginX + 20, startY);
        doc.text('Precio', marginX + 80, startY);
        doc.text('Cantidad', marginX + 120, startY);
        doc.text('Subtotal', marginX + 160, startY);

        startY += 10;

        <?php 
        $i = 1;
        foreach ($cart->contents() as $item) { ?>
            doc.text('<?= $i++ ?>', marginX, startY);
            doc.text('<?= $item['name'] ?>', marginX + 20, startY);
            doc.text('$<?= number_format($item['price'], 2, ',', '.') ?>', marginX + 80, startY);
            doc.text('<?= $item['qty'] ?>', marginX + 120, startY);
            doc.text('$<?= number_format($item['subtotal'], 2, ',', '.') ?>', marginX + 160, startY);
            startY += 10;
        <?php } ?>

        doc.text('Total Compra: $<?= number_format($total, 2, ',', '.') ?>', marginX, startY);

        startY += 20;
        doc.text('GRACIAS POR SU COMPRA', 105, startY, { align: 'center' });

        doc.save('Comprobante.pdf');

        window.location.href = '<?= base_url('guardar-venta'); ?>';
    };
});
</script>
