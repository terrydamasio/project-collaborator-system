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

            $routes['registrarPonto'] = array(
                'route' => '/registrarPonto',
                'controller' => 'IndexController',
                'action' => 'registrarPonto'
            );

            $routes['login'] = array(
				'route' => '/login',
				'controller' => 'IndexController',
				'action' => 'login'
			);

            $routes['autenticar'] = array(
				'route' => '/autenticar',
				'controller' => 'AuthController',
				'action' => 'autenticar'
			);
            

            $routes['lista'] = array(
                'route' => '/lista',
                'controller' => 'AppController',
                'action' => 'lista'
            );

            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'AppController',
                'action' => 'registrar'
            );

            $routes['inserir'] = array(
                'route' => '/inserir',
                'controller' => 'AppController',
                'action' => 'inserir'
            );

            $routes['editar'] = array(
                'route' => '/editar',
                'controller' => 'AppController',
                'action' => 'editar'
            );

            $routes['saveEdit'] = array(
                'route' => '/saveEdit',
                'controller' => 'AppController',
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