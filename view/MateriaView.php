<?php


require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class MateriaView
{

    private $smarty;
  

    public function __construct()
    {
        $this->smarty = new Smarty();

    }


    public function renderSubject($materia)
    {
        $this->smarty->assign('materia', $materia);
        $this->smarty->display("templates/detalle.tpl");
    }



    //   --------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------

    //VISTA FORMULARIO PARA INGRESAR MATERIA ->ESTAN LAS CARRERAS PARA EL SELECT.
    public function renderFormSubject($carreras,$isAdmin)
    {
        $this->smarty->assign('carreras', $carreras);
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->display("templates/ingresamateria.tpl");
    }
    public function showLocationToAddFormSubjects()
    {
        header("Location: " . BASE_URL . "agregarmateria");
    }

    //   -----------------------------VISTA TABLAS MATERIA----------------------------------------
    public function renderTableSubjects($tablaMaterias,$isAdmin)
    {
        
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('tablaMaterias', $tablaMaterias);
    
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
