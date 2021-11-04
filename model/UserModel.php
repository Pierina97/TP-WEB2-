<?php

class UserModel{
    private $db;
    
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_carreras;charset=utf8', 'root', '');
    }
 
    public function insertUser($email, $passwd, $nombre){
        $sentencia = $this->db->prepare("INSERT INTO usuario(email, passwd, nombre) VALUES(?, ?, ?)");
        $sentencia->execute(array($email, $passwd, $nombre));
    }

    public function getUser($email){
        $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $sentencia->execute(array($email));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function getUsers(){
        $sentencia = $this->db->prepare("SELECT * FROM usuario");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateRol($rol,$id_usuario){
 
        $sentencia = $this->db->prepare("UPDATE usuario SET rol=? WHERE id_usuario=?");
    
        $sentencia->execute(array($rol,$id_usuario));
    }

    function borrarUsuario($id_usuario)
    {
        $sentencia = $this->db->prepare("DELETE FROM usuario WHERE id_usuario=?");
        $sentencia->execute(array($id_usuario));
      
    }
}