<?php 
    namespace App\Controllers;

	use MF\Controller\Action;
	use MF\Model\Container;

    session_start();

	class AuthController extends Action {

        public function autenticar() {

            if(!empty($_POST['usuario']) && !empty($_POST['senha'])) {
                $adm = Container::getModel('Administradores');
                $adm->__set('usuario', $_POST['usuario']);
                $adm->__set('senha', $_POST['senha']);
                
                $result = $adm->autenticar();
                
                //validar usuario autenticado
                if($result->rowCount() > 0) {
                    $row = $result->fetchObject();
  
                    $_SESSION['id_adm'] = $row->id_adm;
                    $_SESSION['usuario'] = $row->usuario;
                    $_SESSION['senha'] = $row->senha;

                    header('location: /lista');
                } else {
                    header('location: /login?erro=acessonegado');
                }
            } else {
                header('location: /login?erro=acessonegado');
            }
        }

        public function sair() {
            session_start();
            session_destroy();
            session_unset();

            header('location: /login');
        }
    }