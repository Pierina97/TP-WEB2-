<?php
require_once "./libs/smarty-3.1.39/libs/Smarty.class.php";

class UserView{
    private $smarty;

    public function __construct(){
        $this->smarty = new Smarty();
    }

    public function renderLogin($error = null){
      
        $this->smarty->assign("error", $error);
        $this->smarty->display("templates/login.tpl");
    } 

    public function renderRegistro($error = null){
       
        $this->smarty->assign("error", $error);
        $this->smarty->display("templates/registro.tpl");
    }  

    public function showHome(){
        header("Location: ".BASE_URL."carreras");
    }  
    public function panelLocation(){
        header("Location: ".BASE_URL."panel");
    }  

    public function renderPanel($isAdmin,$aviso="",$users=""){
       $this->smarty->assign('isAdmin', $isAdmin);
        $this->smarty->assign('users', $users);
        $this->smarty->assign('aviso', $aviso);
        $this->smarty->display("templates/panel.tpl");
    }
    

}