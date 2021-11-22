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
                $isLoggin = $this->helper->isLoggin();
                $this->view->renderSubject($materia, $id_usuario, $isLoggin);
            } else {
                $this->redirectHome();
            }
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
        if ($isAdmin == true) {
            $carreras = $this->carrera_model->getDegreeProgram();
            $this->view->renderFormSubject($carreras, $isAdmin, $aviso);
        } else {
            $this->view_user->renderLogin();
        }
    }
    //INSERTAR MATERIA
    public function addSubject()
    {
        if (
            isset($_POST['nombre']) && isset($_POST['profesor']) &&
            isset($_POST['id_carrera'])
        ) {

            if (
                isset($_FILES['image'])  && $_FILES['image']['type'] == "image/jpg" ||
                $_FILES['image']['type'] == "image/jpeg" ||  $_FILES['image']['type'] == "image/png"
            ) {
                $this->model->addSubject(
                    $_POST['nombre'],
                    $_POST['profesor'],
                    $_FILES['image'],
                    $_POST['id_carrera']
                );
            } else {
                $this->model->addSubject(
                    $_POST['nombre'],
                    $_POST['profesor'],
                    null,
                    $_POST['id_carrera']
                );
            }
            $this->view->showLocationToAddFormSubjects();
        }
    }




    //   BORRAR MATERIA
    public function deleteSubject($id)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            if (isset($id)) {
                $this->model->deleteSubject($id);
                $this->showTableOfSubjects();
            } else {
                $this->redirectHome();
            }
        } else {
            $this->view_user->renderLogin();
        }
    }
    //EDITAR MATERIA
    public function editSubject($id_materia)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            if (isset($id)) {
                $this->model->editSubject($_POST['nombre'], $_POST['profesor'], $id_materia);
                $this->showTableOfSubjects();
            } else {
                $this->redirectHome();
            }
        } else {
            $this->view_user->renderLogin();
        }
    }



    //   ------------------------------EDITAR BORRAR MATERIAS----------------------------------------------



    public function showTableOfSubjects($tablasMaterias = null)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if (isset($_GET['materia-filtro']) || isset($_GET['profesor-filtro']) || isset($_GET['carrera-filtro'])) {
            $this->filtroAvanzado($isAdmin);
        }


        if (!isset($_GET['nroPagina'])) {
            $nroPagina = 1;
        } else {
            $nroPagina = $_GET['nroPagina'];
        }
        if (ctype_digit($nroPagina)) {
            $offset = ($nroPagina - 1) * 5;
            //si no te mandaron materias se tienen que obtener materias
            if (empty($tablasMaterias)) {
                $tablasMaterias = $this->model->paginarMaterias($offset);
            }
            $cantidadTotalDeMaterias = $this->model->obtenerCantidadDeMaterias();
            //esto me permie que si tengo 11 materias la q sigue me la muestre 
            //en un registro y luego el boton desaparece
            $nroPagMax = ceil($cantidadTotalDeMaterias / 5);
            $this->view->renderTableSubjects($tablasMaterias, $isAdmin, $nroPagina, $nroPagMax);
        } else {
            $this->view->showHome();
        }
    }

    //filtro avanzado
    public function filtroAvanzado($isAdmin)
    {
        if (isset($_GET['materia-filtro']) || isset($_GET['profesor-filtro']) || isset($_GET['carrera-filtro'])) {
            $tablasMaterias = $this->model->filtroModel($_GET['materia-filtro'], $_GET['profesor-filtro'], $_GET['carrera-filtro']);
            $this->view->renderTableSubjects($tablasMaterias, $isAdmin);
        }
    }


    public function redirectHome()
    {
        $this->view->showHome();
    }
}
