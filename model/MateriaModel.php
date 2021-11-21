<?php

class MateriaModel
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

    //----------MATERIAS POR id----------
    public function getSubjectById($id_materia)
    {
        $sentencia = $this->db->prepare("SELECT * FROM materia WHERE id_materia = ?");
        $sentencia->execute(array($id_materia));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

    public function getSubject()
    {
        $sentencia = $this->db->prepare("SELECT nombre, id_materia FROM materia");
        $sentencia->execute(array());
        $materias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $materias;
    }

    function getSubjects()
    {
        $sentencia = $this->db->prepare('SELECT * FROM materia');
        $sentencia->execute(array());
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function searchForMatches($id_carrera, $nombre)
    { {
            $sentencia = $this->db->prepare('SELECT nombre, id_carrera FROM materia WHERE id_carrera = ? AND nombre = ?');
            $sentencia->execute(array($id_carrera, $nombre));
            $carreras = $sentencia->fetch(PDO::FETCH_OBJ);
            return  $carreras;
        }
    }
    //-----------------------INSERTAR materia ------------------------------------------------     
    //   //Insertar una imagen.
    //   public function insertarImagen($imagen, $id_noticia)
    //   {
    //       $sentencia = $this->db->prepare("INSERT INTO imagen (imagen,id_noticia) VALUES (?, ?)");
    //       $sentencia->execute([$imagen, $id_noticia]);
    //   }
    function  addSubject($nombre, $profesor, $imagen = null, $id_carrera)
    {
        $pathImg = null;
        if ($imagen)
            $pathImg = $this->uploadImage($imagen);
        $sentencia = $this->db->prepare("INSERT INTO materia(nombre,profesor,imagen,id_carrera) VALUES(?,?,?,?)");
        $sentencia->execute(array($nombre, $profesor, $pathImg, $id_carrera));
    }
    private function uploadImage($image)
    {
        $target = "img/materia." . uniqid() . "." . strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        move_uploaded_file($image['tmp_name'], $target);
        return $target;
    }
    function getTableOfSubjects()
    {
        $sentencia = $this->db->prepare('SELECT materia.id_materia, materia.nombre, materia.profesor, carrera.nombre as nombre_carrera
                                         FROM materia INNER JOIN carrera ON carrera.id_carrera=materia.id_carrera');
        $sentencia->execute(array());
        $tablaMaterias = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $tablaMaterias;
    }

    //   ------------------------------EDITAR BORRAR MATERIAS----------------------------------------------       

    //BORRAR MATERIA
    public function deleteSubject($id_materia)
    {
        $sentencia = $this->db->prepare("DELETE FROM materia WHERE id_materia=?");
        $sentencia->execute(array($id_materia));
    }

    public function editSubject($nombre, $profesor, $id_materia)
    {

        $sentencia = $this->db->prepare("UPDATE `materia` SET `nombre`=?,`profesor`=?WHERE `id_materia`=?");
        $sentencia->execute(array($nombre, $profesor, $id_materia));
    }
    // buscarIdCarreraEnTablaMateria
    public function searchIdDegreeProgramByTableSubjects($id_carrera)
    {
        $sentencia = $this->db->prepare("SELECT id_carrera FROM `materia` WHERE id_carrera=?");
        $sentencia->execute(array($id_carrera));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    public function filtroModel($nombre, $profesor, $carrera)
    {
        $sentencia = $this->db->prepare(" SELECT materia.id_materia, materia.nombre, materia.profesor, carrera.nombre as nombre_carrera
        FROM materia INNER JOIN carrera ON carrera.id_carrera=materia.id_carrera WHERE materia.nombre LIKE ? AND materia.profesor LIKE ? AND carrera.nombre LIKE ?  ");
        $sentencia->execute(array("%$nombre%", "%$profesor%", "%$carrera%"));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function paginarMaterias($offset)
    {

        $sentencia = $this->db->prepare("SELECT materia.id_materia, materia.nombre, materia.profesor, carrera.nombre as nombre_carrera
        FROM materia INNER JOIN carrera ON carrera.id_carrera=materia.id_carrera ORDER BY materia.id_materia ASC LIMIT 5 OFFSET $offset");

        $sentencia->execute(array());
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerCantidadDeMaterias()
    {
        $sentencia = $this->db->prepare("SELECT COUNT(*) FROM materia");
        $sentencia->execute();
        return $sentencia->fetchColumn();   //retorna la primera columna de la primera fila (0,0)
    }
}
