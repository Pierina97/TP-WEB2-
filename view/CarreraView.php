<?php
require_once "helpers/AuthHelper.php";
require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class CarreraView {

    private $smarty;
   private $helper;

    public function __construct() {
        $this->smarty = new Smarty();
        $this->helper = new AuthHelper();
        $this->smarty->assign('mostrarTodo', true);
        $this->smarty->assign('nombre_carrera', "");
    }

    public function showHome($carreras, $logged){
        $this->smarty->assign('carreras', $carreras);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('rol', $this->helper->checkIsAdmin());
        $this->smarty->display('templates/carreras.tpl');
    }

    public function renderDegreeProgram($materias, $nombre = ""){
        $this->smarty->assign('materias', $materias);
        $this->smarty->assign('nombre_carrera', $nombre);
        $this->smarty->display('templates/materias.tpl');
    }


    //   -------------------------------FORMULARIO---------------------------------------
    //   -------------------VISTAS AGREGAR-----------------------------------
    //vista carrera
    public function formAddDegreeProgram(){
        $this->smarty->assign('rol', $this->helper->checkIsAdmin());
        $this->smarty->display("templates/ingresacarrera.tpl");
    }

    

     //   -----------------------------VISTA TABLAS CARRERA----------------------------------------
     public function renderTableDegreePrograms($tablaCarreras="",$isAdmin="", $logged="",$aviso=""){
        $this->smarty->assign('tablaCarreras', $tablaCarreras);
        $this->smarty->assign('logged', $logged);
        $this->smarty->assign('aviso', $aviso);
             $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->display("templates/editarborrarcarrera.tpl");
    }
      //   ----------------------------location carreras----------------------------------------    
    public function renderTableOfLocationDegreePrograms(){
        header("Location: ".BASE_URL."tablacarreras");
    }


//   ----------------------------location----------------------------------------      
    public function showHomeLocation(){
        header("Location: ".BASE_URL."carreras");
    }

    public function showLocationToAddFormDegreeProgram(){

        header("Location: ".BASE_URL."agregarcarrera");   
    }

   

}