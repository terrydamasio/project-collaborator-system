<?php
    namespace App\Models;
    
    use MF\Model\Model;

    class Colaboradores extends Model{
        private $matricula;
        private $cpf;
        private $ativo;
        private $nome;
        private $data_nascimento;
        private $data_admissao;
        private $email;
        private $data_rescisao;
        private $usuario;
        private $segunda_entrada;
        private $segunda_saida;
        private $terca_entrada;
        private $terca_saida;
        private $quarta_entrada;
        private $quarta_saida;
        private $quinta_entrada;
        private $quinta_saida;
        private $sexta_entrada;
        private $sexta_saida;
        private $sabado_entrada;
        private $sabado_saida;
        private $domingo_entrada;
        private $domingo_saida;
        private $cargo;
        private $funcao;

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        //inserir
        public function inserir() {
            try {
                $query = "insert into colaboradores(cpf, ativo, nome, data_nascimento, data_admissao, email, data_rescisao, usuario, segunda_entrada, segunda_saida, terca_entrada, terca_saida, quarta_entrada, quarta_saida, quinta_entrada, quinta_saida, sexta_entrada, sexta_saida, sabado_entrada, sabado_saida, domingo_entrada, domingo_saida, cargo, funcao) values(:cpf, :ativo, :nome, :data_nascimento, :data_admissao, :email, :data_rescisao, :usuario, :segunda_entrada, :segunda_saida, :terca_entrada, :terca_saida, :quarta_entrada, :quarta_saida, :quinta_entrada, :quinta_saida, :sexta_entrada, :sexta_saida, :sabado_entrada, :sabado_saida, :domingo_entrada, :domingo_saida, :cargo, :funcao)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':cpf', $this->__get('cpf'));
                $stmt->bindValue(':ativo', $this->__get('ativo'));
                $stmt->bindValue(':nome', $this->__get('nome'));
                $stmt->bindValue(':data_nascimento', $this->__get('data_nascimento'));
                $stmt->bindValue(':data_admissao', $this->__get('data_admissao'));
                $stmt->bindValue(':email', $this->__get('email'));
                $stmt->bindValue(':data_rescisao', $this->__get('data_rescisao'));
                $stmt->bindValue(':usuario', $this->__get('usuario'));
                $stmt->bindValue(':segunda_entrada', $this->__get('segunda_entrada'));
                $stmt->bindValue(':segunda_saida', $this->__get('segunda_saida'));
                $stmt->bindValue(':terca_entrada', $this->__get('terca_entrada'));
                $stmt->bindValue(':terca_saida', $this->__get('terca_saida'));
                $stmt->bindValue(':quarta_entrada', $this->__get('quarta_entrada'));
                $stmt->bindValue(':quarta_saida', $this->__get('quarta_saida'));
                $stmt->bindValue(':quinta_entrada', $this->__get('quinta_entrada'));
                $stmt->bindValue(':quinta_saida', $this->__get('quinta_saida'));
                $stmt->bindValue(':sexta_entrada', $this->__get('sexta_entrada'));
                $stmt->bindValue(':sexta_saida', $this->__get('sexta_saida'));
                $stmt->bindValue(':sabado_entrada', $this->__get('sabado_entrada'));
                $stmt->bindValue(':sabado_saida', $this->__get('sabado_saida'));
                $stmt->bindValue(':domingo_entrada', $this->__get('domingo_entrada'));
                $stmt->bindValue(':domingo_saida', $this->__get('domingo_saida'));
                $stmt->bindValue(':cargo', $this->__get('cargo'));
                $stmt->bindValue(':funcao', $this->__get('funcao'));
                $stmt->execute();

                return $this;
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        //verificar se cpf existe no banco
        public function existeCPF() {
            try {
                $query = "select cpf from colaboradores where cpf = :cpf";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':cpf', $this->__get('cpf'));
                $stmt->execute();

                return $stmt;
                
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        //verifica se usuario existe no banco
        public function usuarioExiste() {
            try {
                $query = "select count(*) from colaboradores where usuario = ':usuario'";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':usuario', $this->__get('usuario'));
                $stmt->execute();

                return $stmt;
                
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        //listar colaboradores
        public function getColaboradores() {
            try {
                $query = "  select 
                               count(*) as total
                            from colaboradores
                            inner join cargos 
                            on colaboradores.cargo = cargos.id_cargo";

                $stmt = $this->db->prepare($query);
                $stmt->execute();

                return $stmt->fetch(\PDO::FETCH_ASSOC);
                
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        //listar colaboradores por pagina
        public function getColaboradoresPorPagina($limit, $offset) {
            try {
                $query = "  select 
                                colaboradores.matricula, 
                                colaboradores.nome, 
                                colaboradores.email, 
                                cargos.nome_cargo
                            from 
                                colaboradores
                            inner join 
                                cargos 
                            on 
                                colaboradores.cargo = cargos.id_cargo
                            order by 
                                matricula asc
                            limit 
                                $limit
                            offset 
                                $offset";

                $stmt = $this->db->prepare($query);
                $stmt->execute();

                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        //editar
        //remover


    }