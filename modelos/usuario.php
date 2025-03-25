<?php

class Usuario{
    protected $pdo;

    private $id_usuario;
    private $email;
    private $password;
    private $rol;
    private $nombres;
    private $apellidos;
    private $cedula;
    
    public function __construct()
    { $this->pdo = BasedeDatos ::Conectar();
        
    }

    public function getId_usuario() : ?int{
        return $this->id_usuario;
    }

    public function setId_usuario(int $id){
        $this->id_usuario=$id;
    }

    public function getEmail() : ?string{
        return $this->email;
    }

    public function setEmail(string $mail){
        $this->email=$mail;
    }

    public function getPassword() : ?string{
        return $this->password;
    }

    public function setPassword(string $pass){
        $this->password=$pass;
    }

    public function getRol() : ?string{
        return $this->rol;
    }

    public function setRol(string $rol){
        $this->rol=$rol;
    }

    public function getNombres() : ?string{
        return $this->nombres;
    }
    
    public function setNombres(string $nom){
        $this->nombres=$nom;
    }

    public function getApellidos() : ?string{
        return $this->apellidos;
    }
    
    public function setApellidos(string $ape){
        $this->apellidos=$ape;
    }

    public function getCedula() : ?string{
        return $this->cedula;
    }

    public function setCedula(string $ced){
        $this->cedula=$ced;
    }

     

    public function Listar(){
        try{
            $consulta=$this->pdo->prepare("SELECT * FROM usuarios;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Insertar(Usuario $p): int {
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
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorId(int $id): ?stdClass {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
            $consulta->execute([$id]);
            return $consulta->fetch(PDO::FETCH_OBJ) ?: null;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Usuario $p) {
        try {
            $sql = "UPDATE usuarios 
                    SET email = ?, rol = ?, nombres = ?, apellidos = ?, cedula = ?
                    WHERE id_usuario = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $p->getEmail(),
                $p->getRol(),
                $p->getNombres(),
                $p->getApellidos(),
                $p->getCedula(),
                $p->getId_usuario()
            ]);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    
    public function autenticar(string $email, string $password) {
        try {
             $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
             $stmt->execute([$email]);
             $usuario = $stmt->fetch(PDO::FETCH_OBJ);
         if ($usuario && password_verify($password, $usuario->password)) {
            return $usuario; // Retorna el objeto con los datos del usuario
            }
          return false;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    
    
}