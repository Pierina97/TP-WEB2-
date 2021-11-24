<?php


require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class MateriaView
{

    private $smarty;


    public function __construct()
    {
        $this->smarty = new Smarty();
    }


    public function renderSubject($materia, $id_usuario, $isLoggin,$isAdmin)
    {
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('isLoggin', $isLoggin);
        $this->smarty->assign('id_usuario', $id_usuario);
        $this->smarty->assign('materia', $materia);
        $this->smarty->display("templates/detalle.tpl");
    }

    public function renderDegreeProgram($materias, $nombre = "")
    {
        $this->smarty->assign('materias', $materias);
        $this->smarty->assign('nombre_carrera', $nombre);
        $this->smarty->display('templates/materias.tpl');
    }

    //   --------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------

    //VISTA FORMULARIO PARA INGRESAR MATERIA ->ESTAN LAS CARRERAS PARA EL SELECT.
    public function renderFormSubject($carreras = "", $isAdmin = "", $aviso = "")
    {
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->assign('carreras', $carreras);
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->display("templates/ingresamateria.tpl");
    }

    public function showLocationToAddFormSubjects()
    {
        header("Location: " . BASE_URL . "agregarmateria");
    }

    //   -----------------------------VISTA TABLAS MATERIA----------------------------------------
    public function renderTableSubjects($tablaMaterias = "", $isAdmin, $nroPagina = 1, $nroPagMax = "")
    {
        $this->smarty->assign('nroPagMax', $nroPagMax);
        $this->smarty->assign('nroPagina', $nroPagina);
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('tablaMaterias', $tablaMaterias);
        $this->smarty->display("templates/editarborrarmateria.tpl");
    }

    //   ----------------------------location materia----------------------------------------    
    public function renderTableOfLocationSubjects()
    {

        header("Location: " . BASE_URL . "tablamaterias?nroPagina=1");
    }

    public function showHome()
    {
        header("Location: " . BASE_URL . "carreras");
    }

    public function renderSubjects($materias, $mostrarTodo = true)
    {
        $this->smarty->assign('materias', $materias);
        $this->smarty->assign('mostrarTodo', $mostrarTodo);
        $this->smarty->display("templates/materias.tpl");
    }
}
