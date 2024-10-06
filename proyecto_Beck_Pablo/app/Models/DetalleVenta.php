<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVenta extends Model{
    protected $table = 'detalle_venta';
    
    protected $primaryKey = 'id_detalle_venta';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_venta','id_producto', 'detalle_cantidad', 'detalle_precio'];
}