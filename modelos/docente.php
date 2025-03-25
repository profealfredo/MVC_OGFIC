<?php
require_once 'Usuario.php';

class Docente extends Usuario {
    private $area_docente;

    public function setArea_docente(string $area) {
        $this->area_docente = $area;
    }

    public function getArea_docente(): ?string {
        return $this->area_docente;
    }
    
    // Método para insertar en la tabla 'usuarios'
    public function insertarUsuario(Docente $p) {
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

    
    public function insertarDocente(Docente $p) {
       
        try {
            $consulta = "INSERT INTO docentes (id_usuario, area_docente)
                         VALUES(?, ?)";
            $stmt = $this->pdo->prepare($consulta);
            $stmt->execute(array(
                $p->getId_usuario(),
                $p->getArea_docente()
            ));
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function listarDocentes(): array {
        try {
            $sql = "SELECT d.id_usuario,
                           u.nombres,
                           u.apellidos,
                           d.area_docente
                    FROM docentes d
                    JOIN usuarios u ON d.id_usuario = u.id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listarAreasDocentes(): array {
        try {
            $sql = "SELECT DISTINCT area_docente FROM docentes WHERE area_docente IS NOT NULL AND area_docente <> ''";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
    
    
    
}
