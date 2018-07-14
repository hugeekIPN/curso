<?php
//require_once "controller/sessionController.php";
require_once "controller/loginController.php";
require_once "controller/usuariosController.php";

sessionController::startSession();

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die("Valió barriga Sr...!");
}

/*
$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
die("Valió barriga Sr...!");
 */

$action = $_POST['action'];

switch ($action) {
    case 'logearse':
        $login   = new loginController();
        $logeado = $login->login($_POST['username'], $_POST['password']);

        if ($logeado === true) {
            echo json_encode(array(
                'status' => 'success',
                'page'   => 'index.php',
            ));
        }

        break;

    /* CRUD de Cliente  */
    case 'addUsuario':
        $usuario = new usuariosController();
        echo json_encode($usuario->nuevoUsuario($_POST));
        break;

    case 'getUsuario':
        $usuario = new usuarioscontroller($_POST['userId']);
        echo json_encode($usuario->getUsuario());
        break;

    case 'updateUsuario':
        $usuario = new usuarioscontroller($_POST['usuarioId']);
        echo json_encode($usuario->updateUsuario($_POST));
        break;

    case 'deleteUsuario':
        $usuario = new usuariosController($_POST['usuarioId']);
        echo json_encode($usuario->deleteUsuario($_POST));
        break;
    case 'getEvento':
        $evento = new eventoController($_POST['eventoId'], null);
        echo json_encode($evento->getEvento());
        break;


        
    default:
        break;
}