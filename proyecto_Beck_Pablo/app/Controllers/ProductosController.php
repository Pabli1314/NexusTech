<?php

namespace App\Controllers;
use App\Models\Productos;
class ProductosController extends BaseController{
    public function mouseVista(): string{
        $productos = new Productos();
        $data = [
            "titulo" => "Mouses", 
            'productos' => $productos->findAll()
        ];
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("productosViews/mouses").view("plantilla/piePagina");
    }

    public function tecladoVista(): string{
        $productos = new Productos();
        $data = [
            "titulo" => "Teclados",
            'productos' => $productos->findAll()
        ];
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("productosViews/teclados" ).view("plantilla/piePagina");
    }

    //Mostrar catalogo de monitores y televisores
    public function monitorVista(): string{
        $productos = new Productos();
        $data = [
            "titulo" => "Televisores y monitores", 
            'productos' => $productos->findAll()
        ];
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("productosViews/televisores-monitores").view("plantilla/piePagina");
    }

    public function netbooksVista(): string{
        $productos = new Productos();
        $data = [
            "titulo" => "Netbooks", 
            'productos' => $productos->findAll()
        ];
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("productosViews/netbooks").view("plantilla/piePagina");
    }

    public function celularesVista(): string{
        $productos = new Productos();
        $data = [
            "titulo" => "Celulares", 
            'productos' => $productos->findAll()
        ];
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("productosViews/celulares").view("plantilla/piePagina");
    }

    public function auricularesVista(): string{
        $productos = new Productos();
        $data = [
            "titulo" => "Auriculares", 
            'productos' => $productos->findAll()
        ];
        return view("plantilla/cabeza", $data).view("plantilla/nav").view("productosViews/auriculares").view("plantilla/piePagina");
    }
        
}