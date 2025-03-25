<?php

require_once "modelos/usuario.php";
require_once "modelos/estudiante.php";
require_once "modelos/docente.php";
require_once "modelos/administrador.php";


class UsuarioControlador{
    private $modelo;

    public function __construct(){
        $this->modelo=new Usuario;
    }
    
    public function Inicio(){
        require_once "vistas/header.php";
        require_once "vistas/usuario/index.php";
        require_once "vistas/footer.php";
    }

    public function FormRegistrar(){
        require_once "vistas/header.php";
        require_once "vistas/usuario/registro.php";
        require_once "vistas/footer.php";
    }

    public function FormInisesion(){
        require_once "vistas/header.php";
        require_once "vistas/usuario/login.php";
        require_once "vistas/footer.php";
    }

    public function Guardar(){
        $p = new Usuario();
        $p->setEmail($_POST['email']);
        $p->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $p->setRol($_POST['rol']);
        $p->setNombres($_POST['nombres']);
        $p->setApellidos($_POST['apellidos']);
        $p->setCedula($_POST['cedula']);
        
        $id_usuario = $this->modelo->Insertar($p);
        
        if($_POST['rol'] == 'estudiante'){
            $p_estudiante = new Estudiante();
            $p_estudiante->setId_usuario($id_usuario);
            $p_estudiante->setCodigo($_POST['codigo']);
            $p_estudiante->insertarEstudiante($p_estudiante);
        } elseif($_POST['rol'] == 'docente'){
            $p_docente = new Docente();
            $p_docente->setId_usuario($id_usuario);
            $p_docente->setArea_docente($_POST['area_docente']);
            $p_docente->InsertarDocente($p_docente);
        } elseif($_POST['rol'] == 'admin'){
            $p_admin = new Administrador();
            $p_admin->setId_usuario($id_usuario);
            $p_admin->InsertarAdministrador($p_admin);
        }
        
        header("location:?c=usuario&a=FormInisesion");
    }

    public function Editar() {
        // 1. Obtener el ID del usuario a editar
        $id_usuario = $_GET['id']; // O $_POST['id'], según tu método de envío
        
        // 2. Llamar al modelo para obtener los datos actuales del usuario
        $usuario = $this->modelo->ObtenerPorId($id_usuario);
    
        // 3. Cargar la vista de edición y pasarle los datos del usuario
        require_once "vistas/header.php";
        require_once "vistas/usuario/editar.php";
        require_once "vistas/footer.php";
    }
    

    public function Actualizar() {
        // 1. Crear un objeto Usuario y asignar los valores del formulario
        $p = new Usuario();
        $p->setId_usuario(intval($_POST['id_usuario']));
        $p->setEmail($_POST['email']);
        $p->setRol($_POST['rol']);
        $p->setNombres($_POST['nombres']);
        $p->setApellidos($_POST['apellidos']);
        $p->setCedula($_POST['cedula']);
    
        // 2. Llamar al modelo para actualizar
        $this->modelo->Actualizar($p);
    
        // 3. Redirigir a la lista de usuarios
        header("Location: ?c=usuario");
    }

    // En UsuarioControlador.php
    public function IniciarSesion() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $email = $_POST['email'];
             $password = $_POST['password'];
        
             $usuario = $this->modelo->autenticar($email, $password);
              if ($usuario) {
                $_SESSION['id_usuario'] = $usuario->id_usuario;
                $_SESSION['rol'] = $usuario->rol;
                header("Location: ?c=usuario&a=Bienvenida");
                exit;
            } else {
                header("Location: ?c=usuario&a=FormInisesion&mensaje=Credenciales%20incorrectas");
                exit;
            }
        } else {
        $this->FormInisesion();
    }   
  }

  // En UsuarioControlador.php
  public function Bienvenida() {
     session_start();
     if (!isset($_SESSION['id_usuario'])) {
        header("Location: ?c=usuario&a=FormInisesion");
        exit;
     }
     require_once "vistas/header.php";
     require_once "vistas/usuario/bienvenida.php"; // Crea este archivo si no existe
     require_once "vistas/footer.php";
   }
    
    


   

}