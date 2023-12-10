<?php
    namespace MF\Init;

use App\Route;
use MF\Controller\HTTPResponse;

    abstract class Bootstrap {
        private $routes;

        abstract protected function initRoutes();

        public function __construct()
        {
            $this->initRoutes();
            $this->run($this->getUrl());
        }

        public function getRoutes() {
            return $this->routes;
        }

        public function setRoutes(array $routes) {
            $this->routes = $routes;
        }

        protected function run($url) {
            foreach($this->getRoutes() as $key => $route) {
                
                if($url == $route['route']) {
                    $class = "App\\Controllers\\" . ucfirst($route['controller']); // -> App\Controllers\[Controller]

                    $controller = new $class; // -> $controller = new App\Controllers\[Controller];
                    
                    $action = $route['action'];

                    $controller->$action();

                } /*else {
                    $response = HTTPResponse::notFound('Erro: 404 Recurso não encontrado.');
                    $response->send();
                }*/
            }
        }

        //capturar url
        protected function getUrl() { 
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            //$_SERVER captura todos os dados do servidor
            //parse_url retorna um array especificando os seus componentes
        }
    }


?> 