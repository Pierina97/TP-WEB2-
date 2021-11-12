<?php
require_once "model\MateriaModel.php";
require_once "view\MateriaView.php";
require_once "helpers/AuthHelper.php";
require_once "model/CarreraModel.php";
require_once "view\UserView.php";
//SUBJECT = MATERIA  
class MateriaController
{
    private $model;
    private $view;
    private $view_user;
    private $helper;
    private $carrera_model;

    public function __construct()
    {
        $this->model = new MateriaModel();
        $this->user_model = new UserModel();
        $this->carrera_model = new CarreraModel();
        $this->view = new MateriaView();
        $this->view_user = new UserView();
        $this->helper = new AuthHelper();
    }


    //filtrar materias
    public function filterSubject($id_materia, $nombre)
    {
        if (isset($id_materia, $nombre))
            if ($this->model->getSubjectById($id_materia)) {
                $materia = $this->model->getSubjectById($id_materia);
                //  $user= $this->user_model->getUsers();
                $id_usuario = $this->helper->userId();
                $this->view->renderSubject($materia, $id_usuario);
            } else
                $this->redirectHome();
        else
            $this->redirectHome();
    }

    //MOSTRAR MATERIAS
    public function showSubjects()
    {
        $materias = $this->model->getSubjects();
        $this->view->renderSubjects($materias, false);
    }

    //MOSTRAR FORMULARIO INSERTAR MATERIA
    public function formSubject($aviso = "")
    {

        $isAdmin = $this->helper->checkLoggedIn();
        $carreras = $this->carrera_model->getDegreeProgram();
        $this->view->renderFormSubject($carreras, $isAdmin, $aviso);
    }

    //INSERTAR MATERIA
    public function addSubject()
    {

        if (isset($_POST['nombre'], $_POST['profesor'], $_POST['id_carrera'])) {
            if (!empty($_POST['nombre']) &&  !empty($_POST['profesor']) &&
             !empty($_POST['id_carrera'])) {
                if (!$this->searchForMatches()) {

                    if (!empty($_FILES['imagen']['type'])) {

                        // $fileTemp = $_FILES["imagen"]["tmp_name"];




                        if (
                            $_FILES['imagen']['type'] == "image/jpg" ||
                            $_FILES['imagen']['type'] == "image/jpeg" ||
                            $_FILES['imagen']['type'] == "image/png"
                        ) {

                            $this->model->addSubject($_POST['nombre'], $_POST['profesor'], $_POST['id_carrera'], $_FILES['imagen']);

                            $this->view->showLocationToAddFormSubjects();
                        }
                    } else {
                        $this->model->addSubject($_POST['nombre'], $_POST['profesor'], $_POST['id_carrera']);
                        $this->view->showLocationToAddFormSubjects();
                    }
                }
            }
            $this->formSubject("Faltan completar Campos");
        }
    }


    //buscamos si hay coincidencias (ya una materia con ese nombre y ese ID)
    private function searchForMatches()
    {
        $carrera = $this->model->searchForMatches($_POST['id_carrera'], $_POST['nombre']);
        return !empty($carrera);
    }


    //   ------------------------------EDITAR BORRAR MATERIAS----------------------------------------------

    //MOSTRAR TABLA BORRAR EDITAR MATERIAS

    public function showTableOfSubjects()
    {

        $isAdmin = $this->helper->checkLoggedIn();
        $tablasMaterias = $this->model->getTableOfSubjects();
        $this->view->renderTableSubjects($tablasMaterias, $isAdmin);
    }
    //   BORRAR MATERIA
    public function deleteSubject($id)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->deleteSubject($id);
            $this->view->renderTableOfLocationSubjects();
        } else {
            $this->view_user->renderLogin();
        }
    }

    //EDITAR MATERIA
    public function editSubject($id_materia)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->editSubject($_POST['nombre'], $_POST['profesor'], $_POST['id_carrera'], $id_materia);
            $this->view->renderTableOfLocationSubjects();
        } else {
            $this->view_user->renderLogin();
        }
    }



    public function redirectHome()
    {
        $this->view->showHome();
    }
}
