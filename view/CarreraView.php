<?php
require_once "helpers/AuthHelper.php";
require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class CarreraView {

    private $smarty;
 
    public function __construct() {
        $this->smarty = new Smarty();   
        $this->smarty->assign('mostrarTodo', true);
        $this->smarty->assign('nombre_carrera', "");
      
    }

    public function showHome($carreras="",$isAdmin="",$isLoggin=""){

        $this->smarty->assign('isLoggin', $isLoggin);
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('carreras', $carreras);
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
    public function formAddDegreeProgram($aviso="",$isAdmin=""){
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->display("templates/ingresacarrera.tpl");
    }

    

     //   -----------------------------VISTA TABLAS CARRERA----------------------------------------
     public function renderTableDegreePrograms($isAdmin,$tablaCarreras,$aviso=""){
        $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('tablaCarreras', $tablaCarreras);
      
        $this->smarty->assign('aviso', $aviso);
   
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