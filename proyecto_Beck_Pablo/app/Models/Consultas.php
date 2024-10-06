<?php

namespace App\Models;

use CodeIgniter\Model;

class Consultas extends Model{
    protected $table = 'consultas';
    
    protected $primaryKey = 'id_consulta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_consulta','nombre', 'correo', 'consulta', 'fecha', 'estado_leido'];

}