<?php
class gfDispatcher {

    private $data;
    private $controller;
    private $action;
    private $o_controller;

    public function  __construct($router) {
        $this->data = $router->getModules();
        if($this->isController($this->data['controller'])) {
            $this->setController($this->data['controller']);
            $this->setAction($this->data['action']);
        } else {
            if(gfConfig::getConfig('show_errors' == 1)) {
                $this->setController('error');
                $this->setAction('index');
            } else {
                $this->setController('index');
                $this->setAction('index');
            }
        }

        if($this->load()) {
            
            $this->o_controller->setup();
            $this->o_controller->{$this->action}();
        } else {
            $this->setController('error');
            $this->setAction('index');
            $this->load();
        }

    }
    
    public function load() {
        require_once(gf_APP_PATH.'/controllers/'.$this->controller.'.php');

        if(gfConfig::getConfig('logs') == 1) {
            gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, $this->controller.'.php', gf_APP_PATH.'/controllers/', __FILE__, __LINE__));
        }
        $con = $this->controller.'Controller';
        $this->o_controller = new $con();
        if(method_exists($this->o_controller, $this->action)) {
            $vars = get_object_vars($this->o_controller);
            if(in_array($this->action, $vars['actions'])) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function isController($controller) {
        if(is_file(gf_APP_PATH.'/controllers/'.$controller.'.php')) {
            return true;
        }
    }



}
?>
