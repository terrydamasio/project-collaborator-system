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
            
            $routes['autenticar'] = array(
				'route' => '/autenticar',
				'controller' => 'AuthController',
				'action' => 'autenticar'
			);

            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'IndexController',
                'action' => 'registrar'
            );

            $routes['inserir'] = array(
                'route' => '/inserir',
                'controller' => 'IndexController',
                'action' => 'inserir'
            );

            $routes['editar'] = array(
                'route' => '/editar',
                'controller' => 'IndexController',
                'action' => 'editar'
            );

            $routes['saveEdit'] = array(
                'route' => '/saveEdit',
                'controller' => 'IndexController',
                'action' => 'saveEdit'
            );

            $routes['sair'] = array(
				'route' => '/sair',
				'controller' => 'AuthController',
				'action' => 'sair'
			);

            $this->setRoutes($routes);
        }   

        
    }