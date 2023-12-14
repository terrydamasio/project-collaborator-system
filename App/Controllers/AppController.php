<?php
    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;
    use MF\Controller\HTTPResponse;

    session_start();

    class AppController extends Action {
        
        public function lista() {

            $this->validaAutenticacao();
            
            $this->setupPagination();

            $this->handleColaboradorRemoval();

            $this->render('lista', 'layout1');
        }

        private function setupPagination() {
            $colaboradores = Container::getModel('Colaboradores');
            $total_registros_pagina = 7;
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $deslocamento = ($pagina - 1) * $total_registros_pagina;

            $this->view->colaboradores = $colaboradores->getColaboradoresPorPagina($total_registros_pagina, $deslocamento);
            $total_colaboradores = $colaboradores->getColaboradores();
            $this->view->total_de_paginas = ceil($total_colaboradores['total'] / $total_registros_pagina);
            $this->view->pagina_ativa = $pagina;
        }

        private function handleColaboradorRemoval() {
            $this->view->remover = isset($_GET['remover']) ? $_GET['remover'] : '';
            $this->view->matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';

            if ($this->shouldRemoveColaborador()) { 
                $colaboradores = Container::getModel('Colaboradores');
                $colaboradores->__set('matricula', $this->view->matricula);
                $colaboradores->deletarColaborador();

                header('location: /lista?sucesso=remover');

            } else if ($_GET['remover'] && $_GET['remover'] == 'nao') {
                header('location: /lista');
            }
        }

        private function shouldRemoveColaborador() {
            return $_GET['remover'] && $_GET['remover'] == 'sim' && $this->view->matricula;
        }

        public function registrar() {

            $this->validaAutenticacao();

            //Criação dinâmica de cargos funcoes e verificação de email
            $cargos = Container::getModel('Cargos');
            $this->view->cargos = $cargos->getCargos();
            $this->view->funcoes = $cargos->getFuncoes();   
            $this->view->verificaEmail = false;

            try {
                $this->render('inserir', 'layout1');
            } catch(\Exception $e) {
                echo $e->getMessage() . "<br>" . $e->getCode();
            }
        }

        //valida e define o padrão de expressão regular para um endereço de e-mail válido
        private function validarEmail($email) {
            $email = trim($email);
            $padrao = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

            if (preg_match($padrao, $email)) {
                return false; 
            } else {
                return true; 
            }
        }

        public function verificarAtivo() {
            $dataRescisao = $_POST['data_rescisao'];
    
            // Verifica se a data de rescisão não está preenchida ou é menor que a data atual
            $ativo = empty($dataRescisao) || strtotime($dataRescisao) < time();
    
            echo json_encode(['ativo' => $ativo]);
        }

        //editar os dados do colaborador
        public function editar() {
            
            $this->validaAutenticacao();

            $colaboradores = Container::getModel('Colaboradores');
            $cargos = Container::getModel('Cargos');
            $this->view->cargos = $cargos->getCargos();
            $this->view->funcoes = $cargos->getFuncoes();   
            
            $this->view->matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';
                
            if(!empty($_GET['matricula']) && $this->view->matricula) { 
                $this->view->matricula = $_GET['matricula'];                   
                $colaboradores->__set('matricula', $this->view->matricula);

                $this->view->colaborador = $colaboradores->selectColaborador();
                
            }

            $this->render('editar', 'layout1');
        }

        //inserir os dados do colaborador
        public function inserir() {
            try {
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $colaboradores = Container::getModel('Colaboradores');

                    $colaboradores->__set('cpf', $_POST['cpf']);
                    $colaboradores->__set('ativo', $_POST['ativo']);
                    $colaboradores->__set('nome', $_POST['nome']);
                    $colaboradores->__set('data_nascimento', $_POST['data_nascimento']);
                    $colaboradores->__set('data_admissao', $_POST['data_admissao']);
                    $colaboradores->__set('email', $_POST['email']);
                    $colaboradores->__set('data_rescisao', $_POST['data_rescisao']);
                    $colaboradores->__set('usuario', $_POST['usuario']);
                    $colaboradores->__set('segunda_entrada', $_POST['segunda_entrada']);
                    $colaboradores->__set('segunda_saida', $_POST['segunda_saida']);
                    $colaboradores->__set('terca_entrada', $_POST['terca_entrada']);
                    $colaboradores->__set('terca_saida', $_POST['terca_saida']);
                    $colaboradores->__set('quarta_entrada', $_POST['quarta_entrada']);
                    $colaboradores->__set('quarta_saida', $_POST['quarta_saida']);
                    $colaboradores->__set('quinta_entrada', $_POST['quinta_entrada']);
                    $colaboradores->__set('quinta_saida', $_POST['quinta_saida']);
                    $colaboradores->__set('sexta_entrada', $_POST['sexta_entrada']);
                    $colaboradores->__set('sexta_saida', $_POST['sexta_saida']);
                    $colaboradores->__set('sabado_entrada', $_POST['sabado_entrada']);
                    $colaboradores->__set('sabado_saida', $_POST['sabado_saida']);
                    $colaboradores->__set('domingo_entrada', $_POST['domingo_entrada']);
                    $colaboradores->__set('domingo_saida', $_POST['domingo_saida']);
                    $colaboradores->__set('cargo', $_POST['cargo']);
                    $colaboradores->__set('funcao', $_POST['funcao']);
                    $colaboradores->__set('s_segunda_entrada', $_POST['s_segunda_entrada']);
                    $colaboradores->__set('s_segunda_saida', $_POST['s_segunda_saida']);
                    $colaboradores->__set('s_terca_entrada', $_POST['s_terca_entrada']);
                    $colaboradores->__set('s_terca_saida', $_POST['s_terca_saida']);
                    $colaboradores->__set('s_quarta_entrada', $_POST['s_quarta_entrada']);
                    $colaboradores->__set('s_quarta_saida', $_POST['s_quarta_saida']);
                    $colaboradores->__set('s_quinta_entrada', $_POST['s_quinta_entrada']);
                    $colaboradores->__set('s_quinta_saida', $_POST['s_quinta_saida']);
                    $colaboradores->__set('s_sexta_entrada', $_POST['s_sexta_entrada']);
                    $colaboradores->__set('s_sexta_saida', $_POST['s_sexta_saida']);
                    $colaboradores->__set('s_sabado_entrada', $_POST['s_sabado_entrada']);
                    $colaboradores->__set('s_sabado_saida', $_POST['s_sabado_saida']);
                    $colaboradores->__set('s_domingo_entrada', $_POST['s_domingo_entrada']);
                    $colaboradores->__set('s_domingo_saida', $_POST['s_domingo_saida']);

                    //IMPLEMENTAR VALIDAÇÃO DE QUADRO DE HORÀRIO
                      
                    //verifica se o CPF já existe
                    $existeCPF = $colaboradores->existeCPF();
                    if($existeCPF->rowCount() > 0) {
                        echo json_encode(['cpfExiste' => true]);
                        exit;
                    }      

                    //valida se é um email válido
                    $email = $_POST['email'];
                    $this->view->verificaEmail = $this->validarEmail($email);

                    //validação do Nome letra maiúscula 
                    $nome = $_POST["nome"];
                    if (preg_match("/^[A-Z][a-z]+ [A-Z][a-z]+$/", $nome) || preg_match("/^[A-Z][a-z]+(?: [A-Z][a-z]+)+$/", $nome)) {
                        $baseUsuario = strtolower(str_replace(" ", "_", $nome));
                    }

                    $colaboradores->inserir();
                    header('location: /lista?sucesso=inserir');
                }   

            } catch (\Exception $e) {
                echo 'Exceção capturada: ', $e->getMessage(), "\n";
            }
        }

        public function saveEdit() {
            try{ 

                $colaboradores = Container::getModel('Colaboradores');

                $this->view->matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';
                
                if(!empty($_GET['matricula']) && $this->view->matricula) { 
                    $this->view->matricula = $_GET['matricula'];                   
                    $this->view->colaborador = $colaboradores->selectColaborador();
                } 

                if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['matricula'])) {
                    $colaboradores->__set('matricula', $this->view->matricula);    
                    $colaboradores->__set('cpf', $_POST['cpf']);
                    $colaboradores->__set('ativo', $_POST['ativo']);
                    $colaboradores->__set('nome', $_POST['nome']);
                    $colaboradores->__set('data_nascimento', $_POST['data_nascimento']);
                    $colaboradores->__set('data_admissao', $_POST['data_admissao']);
                    $colaboradores->__set('email', $_POST['email']);
                    $colaboradores->__set('data_rescisao', $_POST['data_rescisao']);
                    $colaboradores->__set('usuario', $_POST['usuario']);
                    $colaboradores->__set('segunda_entrada', $_POST['segunda_entrada']);
                    $colaboradores->__set('segunda_saida', $_POST['segunda_saida']);
                    $colaboradores->__set('terca_entrada', $_POST['terca_entrada']);
                    $colaboradores->__set('terca_saida', $_POST['terca_saida']);
                    $colaboradores->__set('quarta_entrada', $_POST['quarta_entrada']);
                    $colaboradores->__set('quarta_saida', $_POST['quarta_saida']);
                    $colaboradores->__set('quinta_entrada', $_POST['quinta_entrada']);
                    $colaboradores->__set('quinta_saida', $_POST['quinta_saida']);
                    $colaboradores->__set('sexta_entrada', $_POST['sexta_entrada']);
                    $colaboradores->__set('sexta_saida', $_POST['sexta_saida']);
                    $colaboradores->__set('sabado_entrada', $_POST['sabado_entrada']);
                    $colaboradores->__set('sabado_saida', $_POST['sabado_saida']);
                    $colaboradores->__set('domingo_entrada', $_POST['domingo_entrada']);
                    $colaboradores->__set('domingo_saida', $_POST['domingo_saida']);
                    $colaboradores->__set('cargo', $_POST['cargo']);
                    $colaboradores->__set('funcao', $_POST['funcao']);
                    $colaboradores->__set('s_segunda_entrada', $_POST['s_segunda_entrada']);
                    $colaboradores->__set('s_segunda_saida', $_POST['s_segunda_saida']);
                    $colaboradores->__set('s_terca_entrada', $_POST['s_terca_entrada']);
                    $colaboradores->__set('s_terca_saida', $_POST['s_terca_saida']);
                    $colaboradores->__set('s_quarta_entrada', $_POST['s_quarta_entrada']);
                    $colaboradores->__set('s_quarta_saida', $_POST['s_quarta_saida']);
                    $colaboradores->__set('s_quinta_entrada', $_POST['s_quinta_entrada']);
                    $colaboradores->__set('s_quinta_saida', $_POST['s_quinta_saida']);
                    $colaboradores->__set('s_sexta_entrada', $_POST['s_sexta_entrada']);
                    $colaboradores->__set('s_sexta_saida', $_POST['s_sexta_saida']);
                    $colaboradores->__set('s_sabado_entrada', $_POST['s_sabado_entrada']);
                    $colaboradores->__set('s_sabado_saida', $_POST['s_sabado_saida']);
                    $colaboradores->__set('s_domingo_entrada', $_POST['s_domingo_entrada']);
                    $colaboradores->__set('s_domingo_saida', $_POST['s_domingo_saida']);
   
                    //validar quadro de horários
                    $segunda_entrada = strtotime($_POST['segunda_entrada']);
                    $segunda_saida = strtotime($_POST['segunda_saida']);
                    $terca_entrada = strtotime($_POST['terca_entrada']);
                    $terca_saida = strtotime($_POST['terca_saida']);
                    $quarta_entrada = strtotime($_POST['quarta_entrada']);
                    $quarta_saida = strtotime($_POST['quarta_saida']);
                    $quinta_entrada = strtotime($_POST['quinta_entrada']);
                    $quinta_saida = strtotime($_POST['quinta_saida']);
                    $sexta_entrada = strtotime($_POST['sexta_entrada']);
                    $sexta_saida = strtotime($_POST['sexta_saida']);
                    $sabado_entrada = strtotime($_POST['sabado_entrada']);
                    $sabado_saida = strtotime($_POST['sabado_saida']);
                    $domingo_entrada = strtotime($_POST['domingo_entrada']);
                    $domingo_saida = strtotime($_POST['domingo_saida']);
                    $s_segunda_entrada = strtotime($_POST['s_segunda_entrada']);
                    $s_segunda_saida = strtotime($_POST['s_segunda_saida']);
                    $s_terca_entrada = strtotime($_POST['s_terca_entrada']);
                    $s_terca_saida = strtotime($_POST['s_terca_saida']);
                    $s_quarta_entrada = strtotime($_POST['s_quarta_entrada']);
                    $s_quarta_saida = strtotime($_POST['s_quarta_saida']);
                    $s_quinta_entrada = strtotime($_POST['s_quinta_entrada']);
                    $s_quinta_saida = strtotime($_POST['s_quinta_saida']);
                    $s_sexta_entrada = strtotime($_POST['s_sexta_entrada']);
                    $s_sexta_saida = strtotime($_POST['s_sexta_saida']);
                    $s_sabado_entrada = strtotime($_POST['s_sabado_entrada']);
                    $s_sabado_saida = strtotime($_POST['s_sabado_saida']);
                    $s_domingo_entrada = strtotime($_POST['s_domingo_entrada']);
                    $s_domingo_saida = strtotime($_POST['s_domingo_saida']);

                    // 2.9.1 e 2.9.2- Os campos de entradas não podem ser maiores que suas respectivas saídas e os campos de saídas não podem ser menores que suas respectivas entradas

                    if($segunda_entrada > $segunda_saida || $terca_entrada > $terca_saida || $quarta_entrada > $quarta_saida || $quinta_entrada > $quinta_saida || $sexta_entrada > $sexta_saida || $sabado_entrada > $sabado_saida || $domingo_entrada > $domingo_saida || $s_segunda_entrada > $s_segunda_saida || $s_terca_entrada > $s_terca_saida || $s_quarta_entrada > $s_quarta_saida || $s_quinta_entrada > $s_quinta_saida || $s_sexta_entrada > $s_sexta_saida || $s_sabado_entrada > $s_sabado_saida || $s_domingo_entrada > $s_domingo_saida) {
                        header("location: /editar?matricula={$this->view->matricula}&erro=horario-1");
                        exit;
                    }

                    // 2.9.3 - Não deverá ser aceito um intervalo menor que 1 (uma) hora entre a primeira saída e a segunda entrada:
                    $intervaloSegunda = $s_segunda_entrada - $segunda_saida;
                    $intervaloTerca = $s_terca_entrada - $terca_saida;
                    $intervaloQuarta = $s_quarta_entrada - $quarta_saida;
                    $intervaloQuinta = $s_quinta_entrada - $quinta_saida;
                    $intervaloSexta = $s_sexta_entrada - $sexta_saida;
                    $intervaloSabado = $s_sabado_entrada - $sabado_saida;
                    $intervaloDomingo = $s_domingo_entrada - $domingo_saida;

                    if($intervaloSegunda < 3600 || $intervaloTerca < 3600 || $intervaloQuarta < 3600 || $intervaloQuinta < 3600 || $intervaloSexta < 3600 || $intervaloSabado < 3600 /*|| $intervaloDomingo < 3600*/) { //tirar domingo pq domingo não é dia útil
                        header("location: /editar?matricula={$this->view->matricula}&erro=horario-2");
                        exit;
                    }

                    //2.9.4 - Não deverá ser aceito uma primeira entrada com um intervalo menor de 11h desde a segunda saída do dia anterior
                    $intervaloAnteriorSegunda = $s_domingo_saida - $segunda_entrada;
                    $intervaloAnteriorTerca = $s_segunda_saida - $terca_entrada;
                    $intervaloAnteriorQuarta = $s_terca_saida - $quarta_entrada;
                    $intervaloAnteriorQuinta = $s_quarta_saida - $quinta_entrada;
                    $intervaloAnteriorSexta = $s_quinta_saida - $sexta_entrada;
                    $intervaloAnteriorSabado = $s_sexta_saida - $sabado_entrada;
                    $intervaloAnteriorDomingo = $s_sabado_saida - $domingo_entrada;

                    if(/*$intervaloAnteriorSegunda < 39600 ||*/ $intervaloAnteriorTerca < 39600 || $intervaloAnteriorQuarta < 39600 || $intervaloAnteriorQuinta < 39600 || $intervaloAnteriorSexta < 39600 || $intervaloAnteriorSabado < 39600 || $intervaloAnteriorDomingo < 39600) { //tirar segunda pq domingo não é dia útil
                        header("location: /editar?matricula={$this->view->matricula}&erro=horario-3");
                        exit;
                    }

                    //2.9.5 - O total de horas semanais não podem somar mais que 44 horas 
                    $totalHoras = 0;

                    $totalHoras += strtotime($_POST['segunda_saida']) - strtotime($_POST['segunda_entrada']);
                    $totalHoras += strtotime($_POST['terca_saida']) - strtotime($_POST['terca_entrada']);
                    $totalHoras += strtotime($_POST['quarta_saida']) - strtotime($_POST['quarta_entrada']);
                    $totalHoras += strtotime($_POST['quinta_saida']) - strtotime($_POST['quinta_entrada']);
                    $totalHoras += strtotime($_POST['sexta_saida']) - strtotime($_POST['sexta_entrada']);
                    $totalHoras += strtotime($_POST['sabado_saida']) - strtotime($_POST['sabado_entrada']);
                    //$totalHoras += strtotime($_POST['domingo_saida']) - strtotime($_POST['domingo_entrada']);
                    $totalHoras += strtotime($_POST['s_segunda_saida']) - strtotime($_POST['s_segunda_entrada']);
                    $totalHoras += strtotime($_POST['s_terca_saida']) - strtotime($_POST['s_terca_entrada']);
                    $totalHoras += strtotime($_POST['s_quarta_saida']) - strtotime($_POST['s_quarta_entrada']);
                    $totalHoras += strtotime($_POST['s_quinta_saida']) - strtotime($_POST['s_quinta_entrada']);
                    $totalHoras += strtotime($_POST['s_sexta_saida']) - strtotime($_POST['s_sexta_entrada']);
                    $totalHoras += strtotime($_POST['s_sabado_saida']) - strtotime($_POST['s_sabado_entrada']);
                    //$totalHoras += strtotime($_POST['s_domingo_saida']) - strtotime($_POST['s_domingo_entrada']);

                    $horasEstimadas = 44 * 3600; //44 horas semanais 

                    if($totalHoras > $horasEstimadas) {
                        header("location: /editar?matricula={$this->view->matricula}&erro=horario-4");
                        exit;
                    }
 
                    //valida se é um email válido
                    $email = $_POST['email'];
                    $this->view->verificaEmail = $this->validarEmail($email);
    
                    //validação do Nome letra maiúscula 
                    $nome = $_POST["nome"];
                    if (preg_match("/^[A-Z][a-z]+ [A-Z][a-z]+$/", $nome) || preg_match("/^[A-Z][a-z]+(?: [A-Z][a-z]+)+$/", $nome)) {
                        $baseUsuario = strtolower(str_replace(" ", "_", $nome));
                    }

                    $colaboradores->alterarDados();
                    header('location: /lista?sucesso=alterar');
                } else {
                    echo "Não caiu ";
                }

            } catch (\Exception $e) {
                echo 'Exceção capturada: ', $e->getMessage(), "\n";
            }
        }

        private function validaAutenticacao() {
            session_start();
            
            if(!$this->isAuthenticated()) {
                header('location: /login?login=erro');
            } 
        }

        private function isAuthenticated() {
            return isset($_SESSION['id_adm']) && $_SESSION['id_adm'] != '' && isset($_SESSION['usuario']) && $_SESSION['usuario'] != '';
        }

    }