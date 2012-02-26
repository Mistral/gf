<?php
class indexController extends gfAction {

    public $actions = array('index');

    public function setup() {
        $this->addLib('index', array('gfValidate'));
        //$this->addHelper('index', array('time', 'form'));
    }
    public function index() {
        if($_POST) {
            if($this->Model()->validFormIndex()) {
                $this->view()->msg = 'success';
            } else {
                $this->view()->msg = 'fail';
            }
        }
        $this->render();

    }
}
?>
