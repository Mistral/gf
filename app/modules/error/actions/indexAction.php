<?php
class indexAction extends gfAction {
	
    public $helpers 		= array(); // Helper
    public $libs 		= array(); // Lib
    public $userLibs		= array(); // ULib
    public $userHelpers 	= array(); // UHelper
    public $plugins		= array(); // Plugin
    
    public function __construct() {
    	parent::__construct();
        $this->doSetup();
    }

    public function index() {
    	$this -> view() -> display();
    }
}
?>