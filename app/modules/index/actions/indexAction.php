<?php
class index extends gfAction {
	
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
    	if(@$_POST['link']) {
            if(!$this -> Model() -> issetLinkDb($_POST['link'])) {
                do {
                    $skrot = $this -> Model() -> genLink();
                } while($this->Model()->issetDb($skrot));

                $this -> Templates()->good = 3;
                $this -> Templates()->link = $_POST['link'];
                $this -> Templates()->skrot = $skrot;
                $this->Model()->add($_POST['link'], $skrot);
            } else {
                $this -> Templates()->good = 3;
                $skrot = $this->Model()->getShort($_POST['link']);
				 $this -> Templates()->link = $_POST['link'];
                $this -> Templates()->skrot = $skrot;
            }
        }
    	$this -> Templates() -> display();
    }
}
?>