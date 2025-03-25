<?php

require_once "modelos/docente.php";

class DocenteControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new Docente();
    }
    
    public function Inicio(){
        require_once "vistas/header.php";
        require_once "vistas/docente/index.php";
        require_once "vistas/footer.php";
    }

    public function FormRegistrar(){
        require_once "vistas/header.php";
        require_once "vistas/docente/registro.php";
        require_once "vistas/footer.php";
    }

    public function FormInisesion(){
        require_once "vistas/header.php";
        require_once "vistas/docente/login.php";
        require_once "vistas/footer.php";
    }

    public function Guardar(){
        
        $p = new Docente();
        
        $p->setEmail($_POST['email']);
        $p->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $p->setRol($_POST['rol']);  // Se espera que sea 'docente'
        $p->setNombres($_POST['nombres']);
        $p->setApellidos($_POST['apellidos']);
        $p->setCedula($_POST['cedula']);
       
        $p->setArea_docente($_POST['area_docente']);
        
        
        $id_usuario = $p->insertarUsuario($p);
        $p->setId_usuario($id_usuario);
        
        
        $p->insertarDocente($p);
        
        header("Location: ?c=docente");
    }
}
