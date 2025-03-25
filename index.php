<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


spl_autoload_register(function($class) {
    
    $file = __DIR__ . '/modelos/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    
    $file = __DIR__ . '/controladores/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    
    throw new Exception("Clase $class no encontrada");
});

require_once "modelos/basededatos.php";

if(!isset($_GET['c'])){
    require_once "controladores/inicio.controlador.php";
    $controlador = new InicioControlador();
    call_user_func(array($controlador,"Inicio"));
} else{
    $controlador = $_GET['c'];
    require_once "controladores/$controlador.controlador.php";
    $controlador = ucwords($controlador)."Controlador";
    $controlador = new $controlador;
    $accion = isset($_GET['a']) ? $_GET['a'] : "Inicio";
    call_user_func(array($controlador,$accion));
}

