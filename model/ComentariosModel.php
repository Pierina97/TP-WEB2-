<?php

class ComentarioModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_carreras;charset=utf8', 'root', '');
    }
    public function __destruct()
    {
        $this->db = null;
    }

    public  function getComment($id_comentario)
    {
        $sentencia = $this->db->prepare("SELECT id_comentario FROM comentario WHERE id_comentario=?");
        $sentencia->execute(array($id_comentario));
        $id = $sentencia->fetch(PDO::FETCH_OBJ);
        return $id;
    }
    // public  function getComments(){
    //     $sentencia = $this->db->prepare("SELECT * FROM comentario");
    //     $sentencia->execute();
    //     $comentario = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //     return $comentario;
    // }

    function deleteComment($id_comentario)
    {
        $sentencia = $this->db->prepare("DELETE FROM comentario  WHERE id_comentario=?");
        $sentencia->execute(array($id_comentario));
        return $sentencia->rowCount();
    }

    public function addComments($comentario, $puntaje, $id_materia, $id_usuario,$fecha)
    {

        $sentencia = $this->db->prepare("INSERT INTO comentario(comentario,puntaje,id_materia,id_usuario,fecha) VALUES(?,?,?,?,?)");
        $sentencia->execute(array($comentario, $puntaje, $id_materia, $id_usuario,$fecha));
        return $this->db->lastInsertId();
    }

    public function mostrarComentarios($id_materia)
    {
        $sentencia = $this->db->prepare("SELECT  usuario.nombre, comentario.comentario, comentario.puntaje, comentario.id_comentario, comentario.fecha FROM usuario INNER JOIN comentario 
                                         ON usuario.id_usuario = comentario.id_usuario  WHERE id_materia=?");
        $sentencia->execute(array($id_materia));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    // Como usuario quiero poder filtrar los comentarios por cantidad de puntos.  (Via API REST)
    //filtrar comentarios por puntaje
    public function filterCommentsByScore($puntaje,$id_materia)
    {
        $sentencia = $this->db->prepare("SELECT  usuario.nombre, comentario.comentario, comentario.puntaje, comentario.id_comentario, comentario.fecha FROM usuario INNER JOIN comentario 
        ON usuario.id_usuario = comentario.id_usuario  WHERE puntaje=? AND id_materia=?");
        $sentencia->execute(array($puntaje,$id_materia));
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
    }
    // Como usuario quiero poder ordenar los comentarios por antigüedad o puntaje,
    // ascendente o descendente. (Via API REST)
    //ordenar los comentarios por antiguedad 
    public function sortCommentsByAge($id_materia)
    {
        
        $sentencia = $this->db->prepare("SELECT  usuario.nombre, comentario.comentario, comentario.puntaje, comentario.id_comentario, comentario.fecha FROM usuario INNER JOIN comentario 
                                        ON usuario.id_usuario = comentario.id_usuario  WHERE id_materia=? ORDER BY comentario.fecha DESC");
        $sentencia->execute([$id_materia]);
        $comentarios = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $comentarios;
  
    }
}
