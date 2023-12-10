<?php
    namespace App\Models;
    
    use MF\Model\Model;

    class Cargos extends Model{
        private $id_cargo;
        private $id_funcao;
        private $nome_cargo;
        private $nome_funcao;

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        //listar cargos
        public function getCargos() {
            try{
                $query = "SELECT id_cargo, nome_cargo FROM cargos";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
    
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }

        //listar funcoes
        public function getFuncoes() {
            try{
                $query = "SELECT id_funcao, nome_funcao FROM funcoes";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
        
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } catch(\Exception $e) {
                echo $e->getCode() . '<br>' . $e->getMessage();
            }
        }
    }