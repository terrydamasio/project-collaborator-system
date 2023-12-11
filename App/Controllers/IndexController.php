<?php
    namespace App\Controllers;

    use Exception;
    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action {
        
        public function index() {
            $this->render('index', 'layout2');
        }

        public function login() {
            $this->render('login', 'layout2');
        }

    
    }