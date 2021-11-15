<?php
require_once "model/ComentariosModel.php";
require_once "Helpers/AuthHelper.php";
require_once "ApiController.php";

class ApiComentarioController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ComentarioModel();
        $this->helper = new AuthHelper();
    }


    //ver comentarios por materias
    public function viewCommentsBySubjects($params = [])
    {
        $id_materia = $params[":ID"];

        $comentario = $this->model->mostrarComentarios($id_materia);

        if ($comentario) {
            $this->view->response($comentario, 200);
        } else {
            $this->view->response("No hay comentarios en esta materia", 404);
        }
    }

    public function  addComments()
    {
        $this->helper->checkLoggedIn();   
        $body = $this->getData();
        $id = $this->model->addComments($body->comentario, $body->puntaje, $body->id_materia, $body->id_usuario);
        if ($id != 0) {
            $this->view->response("El comentario  se insertó correctamente", 200);
        } else {
            $this->view->response("El comentario no se pudo enviar", 500);
        }   
    }


    function deleteComment($params = null)
    {
        $isAdmin = $this->helper->checkLoggedIn();
        if ($isAdmin == true) {
            $id_comentario = $params[":ID"];

            //primero hay que ver si esta
            $comentario = $this->model->getComment($id_comentario);

            if ($comentario) {
                $this->model->deleteComment($id_comentario);
                $this->view->response("La comentario con el id=  $id_comentario fue borrada", 200);
            } else {
                $this->view->response("La comentario con el id=  $id_comentario no existe", 404);
            }
        }
    }

    // Como usuario quiero poder ordenar los comentarios por antigüedad o puntaje,
    // ascendente o descendente. (Via API REST)


    //ordenar los comentarios por antiguedad 
    public function  sortCommentsByAge($params = [])
    {
        // $this->helper->checkLoggedIn();
        $id_materia = $params[":ID"];    
               
        $comentarios = $this->model->sortCommentsByAge($id_materia);
        if ($comentarios) {
            $this->view->response($comentarios, 200);
        } else {
            $this->view->response("No hay comentarios para mostrar", 404);
        }
    }

    // Como usuario quiero poder filtrar los comentarios por cantidad de puntos.  (Via API REST)
    //filtrar comentarios por puntaje
    public function filterCommentsByScore($params = null)
    {

        $puntaje = $params[":puntaje"];
        $comentarios = $this->model->filterCommentsByScore($puntaje);

        if ($comentarios) {
            $this->view->response($comentarios, 200);
        } else {
            $this->view->response("No hay comentarios con puntaje $puntaje", 404);
        }
    }
}
