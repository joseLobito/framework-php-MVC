<?php

class Paginas extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $datos = [
            'title' => 'Bienvenidos'
        ];
        $this->view('pages/inicio', $datos);
    }
}
