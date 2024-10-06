<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas extends Model{
    protected $table = 'ventas';
    
    protected $primaryKey = 'id_venta';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_cliente', 'fecha_venta'];
}