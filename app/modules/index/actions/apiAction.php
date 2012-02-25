<?php
class api extends gfAction {
	
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
    	if(gfFW::Router()->getParam(0)) {
            if(!$this->Model()->issetLinkDb(gfFW::Router()->getParam(0))) {
                do {
                    $skrot = '';
                    $skrot = $this->Model()->genLink();

                } while($this->Model()->issetDb($skrot));
                echo 'xxx';
                $this->Model()->add(gfFW::Router()->getParam(0), $skrot);
                $this -> Templates()->skrot = 'http://kroc.pl/'.$skrot;
            } else {
                $skrot = $this->Model()->getShort(gfFW::Router()->getParam(0));
                $this -> Templates()->skrot = $skrot;
            }
        }

    	$this -> Templates() -> displayMini();
    }
    
}
?>