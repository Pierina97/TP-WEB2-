<?php
require_once "helpers/AuthHelper.php";
require_once "model\CarreraModel.php";
require_once "model\MateriaModel.php";
require_once "view\CarreraView.php";

class CarreraController
{
    private $model;
    private $view;
    private $helper;
    private $model_materia;

    public function __construct()
    {
        $this->model = new CarreraModel();
        $this->view = new CarreraView();
        $this->helper = new AuthHelper();
        $this->model_materia = new MateriaModel();
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
            $this->redirectHome();
    }
    //VISTA FORMULARIO AGREGAR CARRERA
    public function formDegreeProgram()
    {
       
            $this->view->FormAddDegreeProgram();
    
            $this->showHome();
    }
    //AGREGAR CARRERA
    public function addDegreeProgram()
    {
        if (isset($_POST['nombre'], $_POST['duracion'])) {
            $this->model->addDegreeProgram($_POST['nombre'], $_POST['duracion']);
            $this->view->showLocationToAddFormDegreeProgram();
        } else
            $this->showHome();
    }
    //TABLA EDITAR Y BORRAR CARRERA
    public function showTableOfDegreePrograms()
    {
      

        $tablasCarrera = $this->model->getTableDegreeProgram();
        $this->view->renderTableDegreePrograms($tablasCarrera);
    }
    //borrar carrera
    public function deleteDegreeProgram($id_carrera)
    {

            $materiasAsociadas = $this->model_materia->searchIdDegreeProgramByTableSubjects($id_carrera);

            if (count($materiasAsociadas) == 0) {

                $this->model->deleteDegreeProgram($id_carrera);
                $this->view->renderTableOfLocationDegreePrograms();
            } else {

                $tablasCarreras =  $this->model->getTableDegreeProgram();
                $this->view->renderTableDegreePrograms($tablasCarreras, $this->helper->checkLoggedIn(),"", "La carrera que ha seleccionado no se puede borrar ya que tiene asociada materias,");
            }
        } 
    
    public function editDegreeProgram($id_carrera)
    {
   
        $this->model->editDegreeProgram($_POST['nombre'], $_POST['duracion'], $id_carrera);
        $this->view->renderTableOfLocationDegreePrograms();
    }

    public function redirectHome()
    {
        $this->view->showHomeLocation();
    }
}
