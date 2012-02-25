<?php
class indexshort extends gfAction {
	//allowed engine helpers: gfHTML_Helper
    public $aHelpers = array('gfHTML_Helper'); // helpers of templates -- only show in templates // access to this throughout: $templates -> helpers['name of helper'] -> methodOfHelpers();
    public $aLibraries = array('gfValidate'); // libraries of action -- only show in action // access to this troughout: $this -> __aLibraries['name of librarires'] -> methodOfLibraries();
    public $aUserLibs = array(); // user libraries of action -- only show in action // access to this troughout: $this -> __aLibraries['name of librarires'] -> methodOfLibraries();
    public $aUserHelpers = array(); // user helpers of templates -- only show in templates // access to this throughout: $templates -> helpers['name of helper'] -> methodOfHelpers();
	public $aPlugins = array(); // here you can past your plugin located in ../../plugins/pluginable/ access to this troughout: $this -> __aPluginAble['name_of_plugin'] -> methodOfPlugin();
    
	public function __construct() { // all method below must be! 
    	parent::__construct();
    }
    
    public function doSetup() {
    	$this -> __addObjects(); // add objects 
        $this -> __addModel(); // add model which is located in /apps/modules/actualy_controller/models/actualyModel.php -- access to this model troughout: $this -> __oModel -> methodOfModel();
        $this -> __addLanguage(); // add pack of language
        $this -> __addHelpers(); // add all helpers selected in variable of this class
        $this -> __addLibraries(); // add all librarires selected in variable of this class
        $this -> __addPlugins(); // add all plugins selected in variable of this class
    }

    public function index() {
        $this -> Templates() -> displayShort($this -> __aConfigs['open']);
    }
}
?>