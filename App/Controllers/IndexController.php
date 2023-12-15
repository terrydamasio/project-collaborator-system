<?php
    namespace App\Controllers;

    use Exception;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action {
        
        public function index() {

            date_default_timezone_set('America/Sao_Paulo');

            $colaboradores = Container::getModel('Colaboradores');
            $this->view->colaboradores = $colaboradores->selecionarColaborador();

            $this->render('index', 'layout3');
        }

        public function registrarPonto() {
            date_default_timezone_set('America/Sao_Paulo');

            $horario_atual = date("H:i:s");
            $data_entrada = date('Y/m/d');

            $colaboradores = Container::getModel('Pontos');
            $colaboradores->__set('matricula', $_POST['matricula']);
            $result = $colaboradores->selectPonto();

            if($result && $result->rowCount() > 0) {
                $row = $result->fetch(\PDO::FETCH_ASSOC);
                extract($row); 

                $colaboradores->__set('id', $id);
                $result = $colaboradores->updatePonto();

                //verifica se usuário já bateu ponto de primeira saída 
                if(($primeira_saida == "") || ($primeira_saida == null)) {
                    
                }
                
            } else {
                $colaboradores->__set('data_entrada', $data_entrada);
                $colaboradores->__set('horario_atual', $horario_atual);
                $colaboradores->__set('matricula_usuario', $_POST['matricula']);
                $result = $colaboradores->criarRegistroUsuario();

                if($result->rowCount())
                    header('location: /?registro=sucesso');
                else 
                    echo "Registro não foi inserido";
            }
        }


        public function login() {
            $this->render('login', 'layout2');
        }

    
    }