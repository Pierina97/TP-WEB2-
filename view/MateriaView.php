<?php

require_once "helpers/AuthHelper.php";
require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class MateriaView
{

    private $smarty;
    private $helper;

    public function __construct()
    {
        $this->smarty = new Smarty();

        $this->helper = new AuthHelper();
    }


    public function renderSubject($materia)
    {
        $this->smarty->assign('materia', $materia);
        $this->smarty->display("templates/detalle.tpl");
    }
    //   --------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------

    //VISTA FORMULARIO PARA INGRESAR MATERIA ->ESTAN LAS CARRERAS PARA EL SELECT.
    public function renderFormSubject($carreras)
    {
        $this->smarty->assign('carreras', $carreras);
        $this->smarty->assign('rol', $this->helper->checkIsAdmin());
        $this->smarty->display("templates/ingresamateria.tpl");
    }
    public function showLocationToAddFormSubjects()
    {
        header("Location: " . BASE_URL . "agregarmateria");
    }

    //   -----------------------------VISTA TABLAS MATERIA----------------------------------------
    public function renderTableSubjects($tablaMaterias, $logged)
    {
        $this->smarty->assign('tablaMaterias', $tablaMaterias);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('rol', $this->helper->checkIsAdmin());
        $this->smarty->display("templates/editarborrarmateria.tpl");
    }

    //   ----------------------------location materia----------------------------------------    
    public function renderTableOfLocationSubjects()
    {
        header("Location: " . BASE_URL . "tablamaterias");
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
