<?php
require_once "controller/CarreraController.php";
require_once "controller/MateriaController.php";
require_once "controller/UserController.php";
require_once "route.php";
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');



// lee la acción
if (!empty($_GET['action']))
    $action = $_GET['action'];
else
    $action = 'carreras';     // acción por defecto si no envían

$params = explode('/', $action);

$carreraController = new CarreraController();
$materiaController = new MateriaController();
$userController = new UserController();

switch ($params[0]) {
    case 'carreras':
        //Verificacion para que no pasen parametros extra por la url
        if (!isset($params[1]))
            $carreraController->showHome($params);
        else
            $carreraController->showHome();
        break;

    case 'carrera':
        if (isset($params[1]) && isset($params[2]))
            $carreraController->filterDegreeProgram($params[1], $params[2]);
        else
            $materiaController->redirectHome();
        break;

    case 'materias':
        if (!isset($params[1]))
            $materiaController->showSubjects();
        else
            $materiaController->redirectHome();
        break;

    case 'detalle':
        // if (isset($params[2], $params[1]))
        $materiaController->filterSubject($params[2], $params[1]);
        // else
        //     $materiaController->redirectHome();
        break;

    case 'login':
        $userController->showLogin();
        break;

    case 'logout':
        $userController->logOut();
        break;

    case 'verify':
        $userController->verifyLogin();
        break;

    case 'registro':
        $userController->showRegistro();
        break;

    case 'signup':
        $userController->registrarUsuario();
        break;

    case 'modifyrol':
        if (isset($params[1])) {
            $userController->editarRol($params[1]);
        }

    case 'panel':
        $userController->showPanel();
        break;
    case 'borrarusuario':
        $userController->borrarUsuario($params[1]);
        break;


        //   ------------------------------VISTA AGREGAR MATERIA CARRERA------------------------------------------------

    case 'agregarcarrera':
        $carreraController->formDegreeProgram();
        break;
    case 'agregarmateria':
        $materiaController->formSubject();
        break;
        //   ------------------------------AGREGAR CARRERA MATERIA------------------------------------------------
    case 'agregar-carrera':
        $carreraController->addDegreeProgram();
        break;

    case 'agregar-materia':
        $materiaController->addSubject();
        break;
        //   ------------------------------EDITAR BORRAR CARRERA------------------------------------------------
    case 'tablacarreras':
        $carreraController->showTableOfDegreePrograms();
        break;

    case 'borrarcarrera':
        if (isset($params[1]))
            $carreraController->deleteDegreeProgram($params[1]);

        break;

    case 'editarcarrera':
        if (isset($params[1]))
            $carreraController->editDegreeProgram($params[1]);

        break;
        //   ------------------------------EDITAR BORRAR MATERIA------------------------------------------------
    case 'tablamaterias':
        $materiaController->showTableOfSubjects();
        break;

    case 'borrarmateria':
        if (isset($params[1]))
            $materiaController->deleteSubject($params[1]);
        else
            $materiaController->redirectHome();
        break;

    case 'editarmateria':
        if (isset($params[1]))
            $materiaController->editSubject($params[1]);
        else
            $materiaController->redirectHome();
        break;

    case 'filtroavanzado':
        $materiaController->filtroAvanzado();
        break;
    // case 'paginado':
    //     $materiaController->paginaMaterias($params[1]);
    //     break;

        //   ------------------------------AGREGAR CARRERA MATERIA------------------------------------------------

    case 'agregarcarrera':
        $carreraController->formDegreeProgram();
        break;
    case 'agregarmateria':
        $materiaController->formSubject();
        break;


    default:
        echo "404 NOT FOUND";
        break;
}
