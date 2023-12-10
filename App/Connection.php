<?php
    namespace App;
    class Connection {

        private $host = 'localhost';
        private $dbname = 'sistema-colaborador';
        private $user = 'postgres';
        private $pass = 'terrydamasio';

        public function getDb() {
            try {
                $conn = new \PDO(
                    "pgsql:host=$this->host;dbname=$this->dbname", 
                    $this->user, 
                    $this->pass
                );

                return $conn;

            } catch(\PDOException $e) {
                echo "Database Connection Error: <br>" . $e->getMessage() . " - " . $e->getCode();
            }
        }
    }