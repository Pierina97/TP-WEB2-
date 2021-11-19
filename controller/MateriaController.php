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
        if (!$this->searchForMatches()) {
            if (
                isset($_POST['nombre']) && isset($_POST['profesor']) &&
                isset($_POST['id_carrera'])
            ) {

                if (
                    $_FILES['input_name']['type'] == "image/jpg" ||
                    $_FILES['input_name']['type'] == "image/jpeg" ||
                    $_FILES['input_name']['type'] == "image/png"
                ) {
                    // Se guarda el nombre y la ruta de la imagen.
                    $img = $_FILES['image']['name'];
                    $ruta = $_FILES['image']['tmp_name'];
                    $destino = "img/materia/" . $img;
                    // Se mueve la imagen a la carpeta img.
                    copy($ruta, $destino);
                    // Se insertan las imagenes.

                    $this->model->addSubject($_POST['nombre'], $_POST['profesor'], $img, $_POST['id_carrera']);
                    $this->view->showLocationToAddFormSubjects();
                }
            }
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
  //filtro avanzado
    public function filtroAvanzado()
    {
        $isAdmin = $this->helper->checkLoggedIn();
        $tablasMaterias = $this->model->filtroModel($_POST['materia-filtro'],$_POST['profesor-filtro'],$_POST['carrera-filtro']);
        $this->view->renderTableSubjects($tablasMaterias,$isAdmin);
    }
    //paginacion
     
    public function paginarMaterias($paginas){
       
        $isAdmin = $this->helper->checkLoggedIn();   
        $tablasMaterias = $this->model->paginarMaterias($paginas);
        $this->view->renderTableSubjects($tablasMaterias,$isAdmin);
        
    }

    public function redirectHome()
    {
        $this->view->showHome();
    }

    
}
