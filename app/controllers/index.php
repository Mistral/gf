<?php
class indexController extends gfAction {

    public $actions = array('index');

    public function setup() {
        $this->addLib('index', array('gfValidate'));
        //$this->addHelper('index', array('time', 'form'));
    }
    public function index() {
        $this->view()->b = 'cc';
        $this->view()->md = $this->Model()->x();
        $this->view()->lg = $this->lang['costam'];
        $this->view()->render();

    }
}
?>
