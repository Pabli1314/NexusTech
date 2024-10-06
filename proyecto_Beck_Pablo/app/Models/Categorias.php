<?php

namespace App\Models;

use CodeIgniter\Model;

class Categorias extends Model{
    protected $table = 'categorias';
    
    protected $primaryKey = 'id_categoria';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_categoria','nom_categoria'];
}