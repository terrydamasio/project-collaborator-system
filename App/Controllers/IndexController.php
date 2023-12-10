<?php
    namespace App\Controllers;

    use Exception;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action {
        
        public function index() {
            $colaboradores = Container::getModel('Colaboradores');

            //variáveis de paginação
            $total_registros_pagina = 7;
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $deslocamento = ($pagina - 1) * $total_registros_pagina;

            $this->view->colaboradores = $colaboradores->getColaboradoresPorPagina($total_registros_pagina, $deslocamento);
            $total_colaboradores = $colaboradores->getColaboradores();
            $this->view->total_de_paginas = ceil($total_colaboradores['total'] / $total_registros_pagina);
            $this->view->pagina_ativa = $pagina;

            //remoção de colaboradores
            $this->view->remover = isset($_GET['remover']) ? $_GET['remover'] : '';
            $this->view->matricula = isset($_GET['matricula']) ? $_GET['matricula'] : '';

            if ($_GET['remover'] && $_GET['remover'] == 'sim' && $this->view->matricula) { 
                $colaboradores = Container::getModel('Colaboradores');
                $colaboradores->__set('matricula', $this->view->matricula);
                $colaboradores->deletarColaborador();

                header('location: /?sucesso=remover');

            } else if ($_GET['remover'] && $_GET['remover'] == 'nao') {
                header('location: /');
            }

            $this->render('index', 'layout1');
        }

        public function registrar() {
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

                    //criação de variáveis dinâmicas
                    $this->view->segunda_entrada = $_POST['segunda_entrada'];
                    $this->view->segunda_saida = $_POST['segunda_saida'];
                    $this->view->terca_entrada = $_POST['terca_entrada'];
                    $this->view->terca_saida = $_POST['terca_saida'];
                    $this->view->quarta_entrada = $_POST['quarta_entrada'];
                    $this->view->quarta_saida = $_POST['quarta_saida'];
                    $this->view->quinta_entrada = $_POST['quinta_entrada'];
                    $this->view->quinta_saida = $_POST['quinta_saida'];
                    $this->view->sexta_entrada = $_POST['sexta_entrada'];
                    $this->view->sexta_saida = $_POST['sexta_saida'];
                    $this->view->sabado_entrada = $_POST['sabado_entrada'];
                    $this->view->sabado_saida = $_POST['sabado_saida'];
                    $this->view->domingo_entrada = $_POST['domingo_entrada'];
                    $this->view->domingo_saida = $_POST['domingo_saida'];
                    $this->view->s_segunda_entrada = $_POST['s_segunda_entrada'];
                    $this->view->s_segunda_saida = $_POST['s_segunda_saida'];
                    $this->view->s_terca_entrada = $_POST['s_terca_entrada'];
                    $this->view->s_terca_saida = $_POST['s_terca_saida'];
                    $this->view->s_quarta_entrada = $_POST['s_quarta_entrada'];
                    $this->view->s_quarta_saida = $_POST['s_quarta_saida'];
                    $this->view->s_quinta_entrada = $_POST['s_quinta_entrada'];
                    $this->view->s_quinta_saida = $_POST['s_quinta_saida'];
                    $this->view->s_sexta_entrada = $_POST['s_sexta_entrada'];
                    $this->view->s_sexta_saida = $_POST['s_sexta_saida'];
                    $this->view->s_sabado_entrada = $_POST['s_sabado_entrada'];
                    $this->view->s_sabado_saida = $_POST['s_sabado_saida'];
                    $this->view->s_domingo_entrada = $_POST['s_domingo_entrada'];
                    $this->view->s_domingo_saida = $_POST['s_domingo_saida'];
                
                
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

                        /*$count = 1;   
                        $usuarioExiste = $colaboradores->usuarioExiste();
                        while ($usuarioExiste > 0) {
                            $usuario = $baseUsuario . $count;
                            $count++;
                        }*/ //->>>> SE USUÁRIO JÁ EXISTE, ACRESCENTA +1 no nome (Verificar se está sendo criado no backend)  
                    }

                    $colaboradores->inserir();
                    header('location: /?sucesso=inserir');
                }   

            } catch (\Exception $e) {
                echo 'Exceção capturada: ', $e->getMessage(), "\n";
            }
        }

        //valida e define o padrão de expressão regular para um endereço de e-mail válido
        public function validarEmail($email) {
            $email = trim($email);
            $padrao = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

            if (preg_match($padrao, $email)) {
                return false; 
            } else {
                return true; 
            }
        }

        //editar os dados do colaborador
        public function editar() {
            
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
   
                    //valida se é um email válido
                    $email = $_POST['email'];
                    $this->view->verificaEmail = $this->validarEmail($email);
    
                    //validação do Nome letra maiúscula 
                    $nome = $_POST["nome"];
                    if (preg_match("/^[A-Z][a-z]+ [A-Z][a-z]+$/", $nome) || preg_match("/^[A-Z][a-z]+(?: [A-Z][a-z]+)+$/", $nome)) {
                        $baseUsuario = strtolower(str_replace(" ", "_", $nome));
    
                        /*$count = 1;   
                        $usuarioExiste = $colaboradores->usuarioExiste();
                        while ($usuarioExiste > 0) {
                            $usuario = $baseUsuario . $count;
                            $count++;
                        }*/ //->>>> SE USUÁRIO JÁ EXISTE, ACRESCENTA +1 no nome (Verificar se está sendo criado no backend)  
                    }
                    
                    $colaboradores->alterarDados();
                    header('location: /?sucesso=alterar');
                } else {
                    echo "Não caiu ";
                }

            } catch (\Exception $e) {
                echo 'Exceção capturada: ', $e->getMessage(), "\n";
            }
        }




    }