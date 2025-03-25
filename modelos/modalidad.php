<?php
class Modalidad {
    protected $pdo;

    public function __construct() {
        $this->pdo = BasedeDatos::Conectar();
    }

    public function listarModalidades(): array {
        try {
            $stmt = $this->pdo->prepare("SELECT id_modalidad, nombre_modalidad FROM modalidades");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
