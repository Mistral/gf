<?php
class contact extends gfAction {
	
    public $aHelpers 		= array();
    public $aLibraries 		= array();
    public $aUserLibs 		= array();
    public $aUserHelpers 	= array();
	public $aPlugins 		= array();
    
    public function __construct() {
    	parent::__construct();
    }
    
    public function doSetup() {
    	$this -> addObjects(); 
        $this -> addModel();
        $this -> addLanguage();
        $this -> addHelpers();
        $this -> addLibraries();
        $this -> addPlugins();
    }

    public function index() {
    	$this -> Templates() -> display();
    }
}
?>