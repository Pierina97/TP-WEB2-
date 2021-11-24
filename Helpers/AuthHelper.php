<?php
session_start();
class AuthHelper
{

    public function __construct()
    {
    }
    public function checkLoggedIn()
    {

        if (!isset($_SESSION['email'])) {
            header("Location: " . BASE_URL . "login");
            die();
        } else {
            $isAdmin = $this->checkIsAdmin();
            return $isAdmin;
        }
    }

    public function checkIsAdmin()
    {

        if (isset($_SESSION['rol']) && ($_SESSION['rol']) == "admin") {
            //admin
            return true;
        } else {
            //usuario
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
    function userId()
    {

        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            return $id_usuario;
        }
    }
    function isLoggin()
    {
        return  isset($_SESSION['email']);
    }

    public function checkUserPanel()
    {

        if (isset($_SESSION['email'])  && $_SESSION['rol'] == 'admin') {
            return true;
        } else {
            header("Location: " . BASE_URL . "login");
            die();
        }
    }
}
session_abort();
