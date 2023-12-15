<?php
    namespace App\Models;
    
    use MF\Model\Model;

    class Pontos extends Model{
        private $id;
        private $data_entrada;
        private $primeira_entrada;
        private $segunda_entrada;
        private $primeira_saida;
        private $segunda_saida;
        private $matricula_usuario;

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        //inserir colaborador
        public function selectPonto() {
            try {
                $query = "SELECT *
                FROM pontos 
                WHERE matricula_usuario = :matricula_usuario 
                ORDER BY id DESC
                LIMIT 1";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':matricula_usuario', $this->__get('matricula'));
                $stmt->execute();

                return $stmt;
                
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        public function updatePonto() {
            try {
                $query = "UPDATE pontos SET primeira_saida = :horario_atual 
                    WHERE id = :id
                    LIMIT 1";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':horario_atual', $this->__get('horario_atual'));
                $stmt->bindValue(':id', $this->__get('id'));
                $stmt->execute();

                return $stmt;
                
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        public function criarRegistroUsuario() {
            try {
                $query = "insert into pontos(data_entrada, primeira_entrada, matricula_usuario) values(:data_entrada, :primeira_entrada,  :matricula)";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':data_entrada', $this->__get('data_entrada'));
                $stmt->bindValue(':primeira_entrada', $this->__get('horario_atual'));
                $stmt->bindValue(':matricula', $this->__get('matricula'));
                $stmt->execute();

                return $stmt;
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

    }