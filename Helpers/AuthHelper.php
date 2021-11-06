<?php
 session_start();
class AuthHelper
{
   
    public function __construct()
    {
    }


    function checkLoggedIn()
    {
      
        if (!isset($_SESSION['email'])) {
            header("Location: " . BASE_URL . "login");
            die();
        } else {
            $isAdmin = $this->checkIsAdmin();
            return $isAdmin;
        }
    }
    function checkIsAdmin()
    {
        if (($_SESSION['rol']) == "admin") {
            return true;
        } else {
            return false;
        } 
    }

    function chequearIdAdmin($id_usuario)
    {      
        //  el id que yo quiero borrar tiene que ser distinto al id de la sesion actual
        if (($_SESSION['id_usuario']) == $id_usuario) {

            return true;
        } else {
            return false;
        }
      
    }
   
}
session_abort();