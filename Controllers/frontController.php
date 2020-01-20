<?php
    require_once __DIR__ . "/frontControllerInterface.php";
    require_once __DIR__ . "/homeController.php";
    require_once __DIR__ . "/searchController.php";
    require_once __DIR__ . "/profileController.php";
    require_once __DIR__ . "/loginController.php";
    require_once __DIR__ . "/usercreationController.php";
    require_once __DIR__ . "/logoutController.php";
    require_once __DIR__ . "/favoritesController.php";

    class FrontController implements FrontControllerInterface {
        protected $controller = 'HomeController';
        protected $action = 'home';
        protected $params = array();
        protected $basePath = "Pokedex/";

        public function __construct(array $options = array()) {
            if (empty($options)) {
                $this->parseUri();
            }
            else {
                if (isset($options['controller'])) {
                    $this->setController($options['controller']);
                }

                if (isset($options['action'])) {
                    $this->setAction($options['action']);
                }

                if (isset($options['params'])) {
                    $this->setParams($options['params']);
                }
            }
        }

        protected function parseUri () {
            //trim leading and trailing /
            $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            //replace non-alphanumerics with ""
            $path = preg_replace('/[^a-zA-Z0-9 | \/]/', "", $path);
            //remove basepath from uri
            if (strpos($path, $this->basePath) === 0) {
                $path = substr($path, strlen($this->basePath));
            }
            //make array of substrings
            @list($controller, $action, $params) = explode('/', $path, 3);

            if(isset($controller)) {
                $this->setController($controller);
            }

            if(isset($action)) {
                $this->setAction($action);
            }

            if(isset($params)) {
                $this->setParams(explode('/', $params));
            }

        }

        public function setController($controller) {
            $controller = ucfirst(strtolower($controller)) . 'Controller';
            if(!class_exists($controller)) {
                throw new InvalidArgumentException("The controller '$controller' has not been defined.");
            }

            $this->controller = $controller;
            //for method chaining
            return $this;
        }

        public function setAction($action) {
            $reflector = new ReflectionClass($this->controller);
            if (!$reflector->hasMethod($action)){
                throw new InvalidArgumentException("The controller action '$action' has not been defined.");
            }

            $this->action = $action;
            return $this;
        }

        public function setParams(array $params) {
            $this->params = $params;
            return $this;
        }

        public function run() {
            call_user_func_array(array(new $this->controller, $this->action), $this->params);
        }
    }