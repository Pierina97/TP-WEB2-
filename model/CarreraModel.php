<?php

class CarreraModel
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

    
    //PARA LA VISTA PRINCIPAL, Y PARA EL SELECT
    function getDegreeProgram()
    {
        $sentencia = $this->db->prepare('SELECT nombre, id_carrera FROM carrera');
        $sentencia->execute(array());
        $carreras = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $carreras;
    }
    // -------------------------------------MOSTRAR TABLAS----------------------------------------
    function getTableDegreeProgram()
    {
        $sentencia = $this->db->prepare('SELECT * FROM carrera');
        $sentencia->execute(array());
        $tablaCarreras = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $tablaCarreras;
    }
  


    public function filterDegreeProgram($id_carrera, $nombre_carrera)
    {
        $sentencia = $this->db->prepare("SELECT materia.nombre, carrera.id_carrera, materia.id_materia FROM carrera INNER JOIN materia
                                            ON carrera.id_carrera = materia.id_carrera WHERE carrera.id_carrera = ? AND carrera.nombre = ?");
        $sentencia->execute(array($id_carrera, $nombre_carrera));

        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function getTableSubjects($id, $nombre)
    {
        $sentencia = $this->db->prepare('SELECT nombre, id_carrera FROM carrera WHERE id_carrera= ? AND nombre = ? ');
        $sentencia->execute(array($id, $nombre));
        $carreras = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return  $carreras;
    }

    //   ------------------------------AGREGAR CARRERA Y MATERIAS----------------------------------------------
    //AGREGAR CARRERA

    function addDegreeProgram($nombre, $duracion)
    {
        $sentencia = $this->db->prepare("INSERT INTO carrera(nombre,duracion) VALUES(?,?)");
        $sentencia->execute(array($nombre, $duracion));
    }



    //   ------------------------------EDITAR BORRAR CARRERA----------------------------------------------       

    // buscarIdCarreraEnTablaMateria
    public function searchIdDegreeProgramByTableSubjects($id_carrera)
    {
        $sentencia = $this->db->prepare("SELECT id_carrera FROM `materia` WHERE id_carrera=?");
        $sentencia->execute(array($id_carrera));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //BORRAR CARRERA
    public function deleteDegreeProgram($id_carrera)
    {
        $sentencia = $this->db->prepare("DELETE FROM carrera WHERE id_carrera=?");
        $sentencia->execute(array($id_carrera));
    }
    //EDITAR CARRERA
    public function editDegreeProgram($nombre, $duracion, $id_carrera)
    {
        $sentencia = $this->db->prepare("UPDATE `carrera` SET `nombre`=?,`duracion`=?WHERE `id_carrera`=?");
        $sentencia->execute(array($nombre, $duracion, $id_carrera));
    }
}
