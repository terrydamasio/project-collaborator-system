<?php
    namespace App\Models;
    
    use MF\Model\Model;

    class Administradores extends Model{
        private $id_adm;
        private $usuario;
        private $senha;

        public function __get($name)
        {
            return $this->$name;
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
        }

        public function autenticar() {
            $query = "select id_adm, usuario, senha from administradores where usuario = :usuario and senha = :senha";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":usuario", $this->__get('usuario'));
            $stmt->bindValue(":senha", $this->__get('senha'));
            $stmt->execute();

            return $stmt;
        }   
    }