<?php
    namespace App;
    use MF\Init\Bootstrap;

    class Route extends Bootstrap {

        //criar rotas
        protected function initRoutes() {

            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );

            $routes['editar'] = array(
                'route' => '/editar',
                'controller' => 'IndexController',
                'action' => 'editar'
            );

            $routes['inserirColaborador'] = array(
                'route' => '/inserirColaborador',
                'controller' => 'IndexController',
                'action' => 'inserirColaborador'
            );

            $routes['inserir'] = array(
                'route' => '/inserir',
                'controller' => 'IndexController',
                'action' => 'inserir'
            );

            $this->setRoutes($routes);
        }   

        
    }