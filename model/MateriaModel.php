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


    
    //OBTENER LAS MATERIAS PARA EL SELECT
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

   function searchForMatches($id_carrera, $nombre){
    {
        $sentencia = $this->db->prepare('SELECT nombre, id_carrera FROM materia WHERE id_carrera = ? AND nombre = ?');    
        $sentencia->execute(array($id_carrera, $nombre));
        $carreras = $sentencia->fetch(PDO::FETCH_OBJ);
        return  $carreras;
    }
   }
        //-----------------------INSERTAR materia ------------------------------------------------     

    function  addSubject($nombre, $profesor, $id_carrera)
    {
        $sentencia = $this->db->prepare("INSERT INTO materia(nombre,profesor,id_carrera) VALUES(?,?,?)");
        $sentencia->execute(array($nombre, $profesor, $id_carrera));

    }
        function getTableOfSubjects()
    {
        $sentencia = $this->db->prepare('SELECT * FROM materia');
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

    public function editSubject($nombre, $profesor, $id_carrera, $id_materia)
    {
        $sentencia = $this->db->prepare("UPDATE `materia` SET `nombre`=?,`profesor`=?,`id_carrera`=? WHERE `id_materia`=?");
        $sentencia->execute(array($nombre, $profesor, $id_carrera, $id_materia));
    }
    // buscarIdCarreraEnTablaMateria
    public function searchIdDegreeProgramByTableSubjects($id_carrera)
    {
        $sentencia = $this->db->prepare("SELECT id_carrera FROM `materia` WHERE id_carrera=?");
        $sentencia->execute(array($id_carrera));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
      
    }
 
}
