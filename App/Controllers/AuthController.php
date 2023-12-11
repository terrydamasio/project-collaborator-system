<?php 
    namespace App\Controllers;

	use MF\Controller\Action;
	use MF\Model\Container;

	class AuthController extends Action {

        public function autenticar() {

            if(!empty($_POST['usuario']) && !empty($_POST['senha'])) {
                $adm = Container::getModel('Administradores');
                $adm->__set('usuario', $_POST['usuario']);
                $adm->__set('senha', $_POST['senha']);
                
                $autenticar = $adm->autenticar();

                //validar usuario autenticado
                if($autenticar->rowCount() > 0) {
                    session_start();

                    $row = $autenticar->fetchObject();
                    $_SESSION['id_adm'] = $adm->__get('id_adm');
                    $_SESSION['usuario'] = $adm->__get('usuario'); 

                    echo $_SESSION['id_adm'];
                    echo $_SESSION['usuario'];

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