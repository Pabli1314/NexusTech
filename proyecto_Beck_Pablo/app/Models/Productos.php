<?php

namespace App\Models;

use CodeIgniter\Model;

class Productos extends Model{
    protected $table = 'productos';
    
    protected $primaryKey = 'id_producto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_producto', 'cat_producto', 'marca', 'nom_producto' ,'precio', 'stock', 'descripcion', 'img_producto', 'estado_producto'];
    
    public function search($query) {
        return $this->select('productos.*, categorias.nom_categoria')
                    ->join('categorias', 'categorias.id_categoria = productos.cat_producto')
                    ->like('productos.nom_producto', $query)
                    ->orLike('productos.descripcion', $query)
                    ->orLike('categorias.nom_categoria', $query)  // Añadido para buscar también en el campo 'nom_categoria'
                    ->findAll();
    }
}