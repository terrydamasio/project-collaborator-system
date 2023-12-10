<?php
    namespace MF\Controller;

    class HTTPResponse {

        private $statusCode;
        private $headers = [];
        private $body;
    
        public function __construct($statusCode, $body = null) {
            $this->statusCode = $statusCode;
            $this->body = $body;
        }
    
        public function setHeader($name, $value) {
            $this->headers[$name] = $value;
        }
    
        public function send() {
            // Define o código de status
            http_response_code($this->statusCode);
    
            // Define os cabeçalhos
            foreach ($this->headers as $name => $value) {
                header("$name: $value");
            }
    
            // Envia o corpo da resposta
            echo $this->body;
        }
    
        // Métodos para criar respostas comuns
    
        public static function success($body = null) {
            return new self(200, $body);
        }
    
        public static function created($body = null) {
            return new self(201, $body);
        }
    
        public static function badRequest($message = 'Bad Request') {
            return new self(400, $message);
        }
    
        public static function unauthorized($message = 'Unauthorized') {
            return new self(401, $message);
        }
    
        public static function forbidden($message = 'Forbidden') {
            return new self(403, $message);
        }
    
        public static function notFound($message = 'Not Found') {
            return new self(404, $message);
        }
    
        public static function internalServerError($message = 'Internal Server Error') {
            return new self(500, $message);
        }
    
        // Adicione mais métodos conforme necessário para outros códigos de status
    }
    
    //Exemplo de utilização:
    /* 
        $response = HTTPResponse::notFound('Variável não foi achada.');
        $response->send();
    */