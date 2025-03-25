<?php
require_once 'Usuario.php';

class Administrador extends Usuario {
    

    
    public function insertarUsuario(Administrador $p): int {
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
            return intval($this->pdo->lastInsertId());
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    
    public function insertarAdministrador(Administrador $p) {
        try {
            $consulta = "INSERT INTO administradores (id_usuario) VALUES(?)";
            $stmt = $this->pdo->prepare($consulta);
            $stmt->execute(array(
                $p->getId_usuario()
            ));
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
