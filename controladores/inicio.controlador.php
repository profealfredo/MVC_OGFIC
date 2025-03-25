<?php
require_once "modelos/estudiante.php";

class InicioControlador{
    private $modelo;

    public function __construct(){
       // $this->modelo=new Estudiante();
        
    }

    public function Inicio(){
        
        require_once "vistas/header.php";
        require_once "vistas/inicio/principal.php";
        require_once "vistas/footer.php";
    }
}