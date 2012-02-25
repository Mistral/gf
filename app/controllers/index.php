<?php
class indexController extends gfAction {

    public $actions = array('index');

    public function setup() {
        $this->addLib('index', array('gfValidate'));
        //$this->addHelper('index', array('time', 'form'));
    }
    public function index() {
        echo $this->lib['gfValidate']->b();
    }
}
?>
