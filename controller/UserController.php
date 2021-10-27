<?php
require_once "./model/UserModel.php";
require_once "./view/UserView.php";
require_once "./helpers/AuthHelper.php";

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


    public function modifyRol($clave)
    {

            $this->model->updateRol($clave, $_POST['nuevoRol']);
            $users = $this->model->getUsers();
            $this->view->renderPanel($users);
 
               //$this->view->showHome();
    }


    public function showPanel()
    {
        $users = $this->model->getUsers();
       
            $this->view->renderPanel($users);
   
          //  $this->view->showHome();
    }

    public function registrarUsuario()
    {

           if (!empty($_POST['email']) && !empty($_POST['nombre']) && !empty($_POST['password'])) {

            $hashedPasswd = password_hash($_POST['password'], PASSWORD_ARGON2ID);

            if ($this->model->insertUser($_POST['email'], $hashedPasswd, $_POST['nombre'])) {
                $this->view->renderLogin('Ingresate para terminar el registro');
            } else {
                $this->view->renderRegistro("El email ya esta registrado");
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
         session_destroy();
        $this->view->showHome();
    }
}
