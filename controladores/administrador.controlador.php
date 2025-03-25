<?php

require_once "modelos/administrador.php";

class AdministradorControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new Administrador();
    }
    
    public function Inicio(){
        require_once "vistas/header.php";
        require_once "vistas/administrador/index.php";
        require_once "vistas/footer.php";
    }

    public function FormRegistrar(){
        require_once "vistas/header.php";
        require_once "vistas/administrador/registro.php";
        require_once "vistas/footer.php";
    }

    public function Guardar(){
        $p = new Administrador();
       
        $p->setEmail($_POST['email']);
        $p->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $p->setRol($_POST['rol']); // Se espera que sea 'admin'
        $p->setNombres($_POST['nombres']);
        $p->setApellidos($_POST['apellidos']);
        $p->setCedula($_POST['cedula']);
        
        
        $id_usuario = $p->insertarUsuario($p);
        $p->setId_usuario($id_usuario);
        
       
        $p->insertarAdministrador($p);

        header("Location: ?c=administrador");
    }
}
