<?php
require_once 'Usuario.php';  

class Estudiante extends Usuario {
    private $codigo;
    protected $pdo;

    public function __construct() {
        parent::__construct(); 
        $this->pdo = BasedeDatos::Conectar();
    }

    
    public function getCodigo(): ?string {
        return $this->codigo;
    }

    public function setCodigo(string $codigo) {
        $this->codigo = $codigo;
    }

    // Método para insertar en la tabla 'usuarios'
    public function insertarUsuario(Estudiante $p) {
        try {
            $consulta = "INSERT INTO usuarios(email, password, rol, nombres, apellidos, cedula)
                         VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($consulta);
            $stmt->execute(array(
                $p->getEmail(),
                $p->getPassword(),
                $p->getRol(),
                $p->getNombres(),
                $p->getApellidos(),
                $p->getCedula()
            ));
            return $this->pdo->lastInsertId();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    // Método para insertar en la tabla 'estudiantes'
    public function insertarEstudiante(Estudiante $p) {
        try {
            $consulta = "INSERT INTO estudiantes(id_usuario, codigo)
                         VALUES(?, ?)";
            $this->pdo->prepare($consulta)
                      ->execute(array(
                          $p->getId_usuario(),
                          $p->getCodigo()
                      ));
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    
}
