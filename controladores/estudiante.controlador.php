<?php
require_once "modelos/estudiante.php";

class EstudianteControlador {
    private $modelo;

    public function __construct(){
        $this->modelo = new Estudiante();
    }
    
    
    public function Inicio(){
        require_once "vistas/header.php";
        require_once "vistas/estudiante/index.php";
        require_once "vistas/footer.php";
    }
    
    
    public function FormRegistrar(){
        require_once "vistas/header.php";
        require_once "vistas/estudiante/registro.php";
        require_once "vistas/footer.php";
    }
    
    
    public function Guardar(){
        
        $p = new Estudiante();
       
        $p->setEmail($_POST['email']);
        
        $p->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $p->setRol($_POST['rol']);  
        $p->setNombres($_POST['nombres']);
        $p->setApellidos($_POST['apellidos']);
        $p->setCedula($_POST['cedula']);
       
        $p->setCodigo($_POST['codigo']);
        
        
        $id_usuario = $p->insertarUsuario($p);
        $p->setId_usuario($id_usuario);
        
        $p->insertarEstudiante($p);

        header("Location: ?c=estudiante&a=FormInisesion");
        exit; 
    }
    
    
    public function FormInisesion(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
        
        $mensajeError = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
        require_once "vistas/header.php";
        require_once "vistas/estudiante/login.php"; 
        require_once "vistas/footer.php";
    }
    
    
    public function IniciarSesion(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            
            $usuario = $this->modelo->autenticar($email, $password);
            if ($usuario && $usuario->rol === 'estudiante') {
                $_SESSION['id_usuario'] = $usuario->id_usuario;
                $_SESSION['rol'] = $usuario->rol;
                header("Location: ?c=estudiante&a=Bienvenida");
                exit;
            } else {
                
                header("Location: ?c=estudiante&a=FormInisesion&mensaje=Credenciales%20incorrectas");
                exit;
            }
        } else {
            $this->FormInisesion();
        }
    }
    
    
    public function Bienvenida(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        };
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: ?c=estudiante&a=FormInisesion");
            exit;
        }
        require_once "vistas/header.php";
        require_once "vistas/estudiante/bienvenida.php";
        require_once "vistas/footer.php";
    }

    public function SolicitudAval(){
        session_start();
        
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: ?c=estudiante&a=FormInisesion");
            exit;
        }

        require_once "modelos/docente.php";
        require_once "modelos/modalidad.php";

        $docenteModel = new Docente();
        $listaAreas = $docenteModel->listarAreasDocentes();
        $modalidadModel = new Modalidad();

        $listaDocentes = $docenteModel->listarDocentes();
        $listaModalidades = $modalidadModel->listarModalidades();
       
        require_once "vistas/header.php";
        require_once "vistas/estudiante/sol.aval.php";
        require_once "vistas/footer.php";
    }

    public function GuardarSolicitud(){
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: ?c=estudiante&a=FormInisesion");
            exit;
        }
        
        
        $director = $_POST['director'];
        $especialidad = $_POST['especialidad'];
        $modalidad = $_POST['modalidad'];
        
        
        $uploadDir = "assets/uploads/solicitudes/";
       
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $formatoFile = $_FILES['formato'];
        $registroFile = $_FILES['registro'];
        
        
        $formatoPath = "";
        if ($formatoFile['error'] === UPLOAD_ERR_OK) {
            $formatoPath = $uploadDir . basename($formatoFile['name']);
            move_uploaded_file($formatoFile['tmp_name'], $formatoPath);
        }
        
        
        $registroPath = "";
        if ($registroFile['error'] === UPLOAD_ERR_OK) {
            $registroPath = $uploadDir . basename($registroFile['name']);
            move_uploaded_file($registroFile['tmp_name'], $registroPath);
        }
        
        
        
        
        header("Location: ?c=estudiante&a=SolicitudConfirmacion");
        exit;
    }

    public function SolicitudConfirmacion(){
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: ?c=estudiante&a=FormInisesion");
            exit;
        }
        require_once "vistas/header.php";
        require_once "vistas/estudiante/solicitud_confirmacion.php";
        require_once "vistas/footer.php";
    }

    public function VerModalidades() {
        session_start();
        // Verifica si el estudiante está autenticado
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: ?c=estudiante&a=FormInisesion");
            exit;
        }
    
        
        require_once "vistas/header.php";
        require_once "vistas/estudiante/modalidades.php"; 
        require_once "vistas/footer.php";
    }
    
    
    

    
}



