<?php
require_once "./model/UserModel.php";
require_once "./view/UserView.php";
require_once "helpers/AuthHelper.php";

class UserController {

    private $model;
    private $view;
    private $helper;

    function __construct(){
        $this->model = new UserModel();
        $this->view = new UserView();
        $this->helper = new AuthHelper();
    }
 
    function showLogin(){
        $this->view->renderLogin();
    }

    function showRegistro(){
        $this->view->renderRegistro();
    }

    public function redirectHome(){
        $this->view->showHome();
    }

    public function modifyRol($clave){
        if($this->check_rol($_POST['nuevoRol']) && $this->helper->checkIsAdmin()){
            $this->model->updateRol($clave, $_POST['nuevoRol']);
            $users = $this->model->getUsers();
            $this->view->renderPanel($users);
        }else
            $this->redirectHome();
    }

    private function check_rol($rol){
        return ($rol && ($rol == 'admin' || $rol == 'usuario')) ? true : false;
    }

    public function showPanel(){
        $users = $this->model->getUsers();
        if ($this->helper->checkIsAdmin())
            $this->view->renderPanel($users);
        else
            $this->redirectHome();
    }

    public function registrarUsuario(){

        $registered = true;
        
         if (!empty($_POST['email']) && !empty($_POST['nombre']) && !empty($_POST['password'])){
             $hashedPasswd = password_hash($_POST['password'], PASSWORD_BCRYPT);

        
         try {
             $this->model->insertUser($_POST['email'], $hashedPasswd, $_POST['nombre']);
         } catch (Throwable $th) {
             $this->view->renderRegistro("El email ya esta registrado");
             $registered = false;
         }

         if ($registered)
             $this->view->renderLogin('Ingresate para terminar el registro');

         }else
             $this->view->renderRegistro("No puedes registrar campos vacios.");
    }   

  

    public function verifyLogin(){
      
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $user = $this->model->getUser($_POST['email']);
            $campos_validos = $this->login_check($user, $_POST['password'], $_POST['email']);
            if ($campos_validos) {
                session_start();
                $_SESSION["email"] = $_POST['email'];
                $_SESSION['nombre'] = $user->nombre;
                $_SESSION['rol'] = $user->rol;
             
           
                $this->view->showHome();
            }else
                $this->view->renderLogin("Datos incorrectos");
        }
    }
    public function login_check($user, $password){
       
        $checked = ( $user && password_verify($password , $user->passwd) ) ? true : false;

     
        return $checked;
    }

    public function logOut(){
        session_start();
        session_destroy();
        $this->redirectHome();
    }

}
