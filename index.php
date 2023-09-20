<?php
 include('errors/404.php');
 include('controllers/request.php');
 include('database/request.php');

 date_default_timezone_set('Europe/Moscow');
 
  class Router
  {
    public function __construct($data, $controllers) {
        $this->controller = null;
        $this->method = null;
        $this->argument = null;
        if(count($data) < 2 || count($data) > 3){
            $this->controller = new HttpError404();
            $this->method = 'show_message';
        }else{
            foreach($controllers as $controller){
                if($data[0] == $controller->name){
                    $method = $data[1];
                    if(method_exists($controller, $method)){
                        $this->controller = $controller;
                        $this->method = $method;
                        if(count($data) > 2){
                            $this->argument = $data[2];
                        }
                    }
                }
            }
            if(!$this->controller && !$this->method){
                $this->controller = new HttpError404();
                $this->method = 'show_message';
            }
        }
    }
    public function run(){
        $method = $this->method;
        $argument = $this->argument;
        if($argument){
            $result = $this->controller->$method($argument);
        }else{
            $result = $this->controller->$method();
        }
        print(json_encode($result));
    }
  }

  $controllers = [new ControllerRequest(new ModelRequest())];
  $router = new Router(explode('/', $_GET['path']), $controllers);
  $router->run();
?>