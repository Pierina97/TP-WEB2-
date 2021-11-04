<?php
require_once "./model/UserModel.php";
require_once "./view/UserView.php";
require_once "./Helpers/AuthHelper.php";

class UserController
{

    private $model;
    private $view;
    private $helper;

    function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->helper = new AuthHelper();
    }

    public function showLogin()
    {
        $this->view->renderLogin();
    }
    public function showRegistro()
    {
        $this->view->renderRegistro();
    }



    public function showPanel()
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $users = $this->model->getUsers();
        $this->view->renderPanel($isAdmin, "", $users);
    }


    public function borrarUsuario($id_usuario)
    {

        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            //  el id que yo quiero borrar tiene que ser distinto al id de la sesion actual
            $borraAdmin = $this->helper->chequearIdAdmin($id_usuario);
            if ($borraAdmin === false) {
                $this->model->borrarUsuario($id_usuario);
                $this->view->panelLocation();
            } else {
                $users = $this->model->getUsers();
                $this->view->renderPanel($isAdmin, "No se puede cambiar su propio estado", $users);
            }
        } else {
            $this->view->showHome();
        }
    }

    public function modifyRol($id_usuario)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            //  el id que yo quiero editar tiene que ser distinto al id de la sesion actual    
            $editaAdmin = $this->helper->chequearIdAdmin($id_usuario);
            if ($editaAdmin === false) {
                if (isset($_POST['rol']) && !empty($_POST['rol'])) {

                    $this->model->updateRol($_POST['rol'], $id_usuario);
                    $this->view->panelLocation();
                }
            }
        }
    }

    public function registrarUsuario()
    {

        if (!empty($_POST['email']) && !empty($_POST['nombre']) && !empty($_POST['password'])) {

            $hashedPasswd = password_hash($_POST['password'], PASSWORD_ARGON2ID);
            $checkExist = $this->model->getUser($_POST['email']);
            if ($checkExist) {
                $this->view->renderRegistro("El email que quiere ingresar ya esta registrado");
            } else {
                $this->model->insertUser($_POST['email'], $hashedPasswd, $_POST['nombre']);
                $this->view->renderLogin('Ingresate para terminar el registro');
            }
        } else {
            $this->view->renderRegistro("Faltan completar campos");
        }
    }
    public function verifyLogin()
    {

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Obtengo el usuario de la base de datos
            $user = $this->model->getUser($email);
            // Si el usuario existe y las contraseñas coinciden
            if ($user && password_verify($password, $user->passwd)) {
                session_start();
                $_SESSION['id_usuario'] = $user->id_usuario;
                $_SESSION["email"] = $_POST['email'];
                $_SESSION['nombre'] = $user->nombre;
                $_SESSION['rol'] = $user->rol;
                $this->view->showHome();
            } else {
                $this->view->renderLogin("contraseña incorrecta");
            }
        } else {
            $this->view->renderLogin("faltan completar campos");
        }
    }

    public function logOut()
    {
        session_start();
        session_destroy();
        $this->view->showHome();
    }
}
