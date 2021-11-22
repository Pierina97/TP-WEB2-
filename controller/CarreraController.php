<?php
require_once "helpers/AuthHelper.php";
require_once "model\CarreraModel.php";
require_once "model\MateriaModel.php";
require_once "view\CarreraView.php";
require_once "view\UserView.php";
class CarreraController
{
    private $model;
    private $view;
    private $view_user;
    private $helper;
    private $model_materia;

    public function __construct()
    {
        $this->model = new CarreraModel();
        $this->view = new CarreraView();
        $this->helper = new AuthHelper();
        $this->model_materia = new MateriaModel();
        $this->view_user = new UserView();
    }

    public function showHome()
    {
        $carreras = $this->model->getDegreeProgram();
        $this->view->showHome($carreras);
    }


    public function filterDegreeProgram($nombre_carrera, $id_carrera)
    {
        $nombre_con_espacios = str_replace('-', ' ', $nombre_carrera);
        $materias = $this->model->filterDegreeProgram($id_carrera, $nombre_con_espacios);
        if (!empty($materias))
            $this->view->renderDegreeProgram($materias, $nombre_con_espacios);
        else
            $this->view->showHomeLocation();
    }
    //VISTA FORMULARIO AGREGAR CARRERA
    public function formDegreeProgram()
    {
      
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
        $this->view->FormAddDegreeProgram("", $isAdmin);
        } else {
            $this->view_user->renderLogin();
        }
    }
    //AGREGAR CARRERA
    public function addDegreeProgram()
    {

        $isAdmin = $this->helper->checkLoggedIn();

        if (!empty($_POST['nombre']) && !empty($_POST['duracion'])) {
            $this->model->addDegreeProgram($_POST['nombre'], $_POST['duracion']);
            $this->view->showLocationToAddFormDegreeProgram();
        } else {
            $this->view->formAddDegreeProgram("faltan completar campos", $isAdmin);
        }
    }
    //MOSTRAR TABLA EDITAR Y BORRAR CARRERA
    public function showTableOfDegreePrograms($aviso = "")
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $tablaCarreras = $this->model->getTableDegreeProgram();
        $this->view->renderTableDegreePrograms($isAdmin, $tablaCarreras, $aviso);
    }
    //borrar carrera
    public function deleteDegreeProgram($id_carrera)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $materiasAsociadas = $this->model_materia->searchIdDegreeProgramByTableSubjects($id_carrera);

            if (count($materiasAsociadas) == 0) {
                $this->model->deleteDegreeProgram($id_carrera);
                $this->view->renderTableOfLocationDegreePrograms();
            } else {
                $this->showTableOfDegreePrograms("La carrera que ha seleccionado no se puede borrar ya que tiene asociada materias");
            }
        } else {
            $this->view_user->renderLogin();
        }
    }
    public function editDegreeProgram($id_carrera)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $this->model->editDegreeProgram($_POST['nombre'], $_POST['duracion'], $id_carrera);
            $this->view->renderTableOfLocationDegreePrograms();
        } else {
            $this->view_user->renderLogin();
        }
    }
}
