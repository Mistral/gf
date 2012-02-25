<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.gfTemplates
 * 
 */

class gfView {

    private $configs;
    
    public function __construct() {
        if(!gfRegister::get('template')) {
            $this->setTemplate('default');
        } else {
            $this->setTemplate(gfRegister::get('template'));
        }
    }
    
    private function setTemplate($template) {
        $this->configs['template'] = $template;
    }
    
    public function getTemplate() {
        return $this->configs['template'];
    }
    
    public function display() {
        $templates = $this;
        $aModules = gfFW::Router() -> getModules();
        $sPath = gf_SYSTEM_PATH.'/apps/modules/'.$aModules['controller'].'/templates/'.$this -> aConfigs['template'].'/'.$aModules['action'].'Template'.$this -> aConfigs['type_file'];
        $sPathIndex = gf_SYSTEM_PATH.'/apps/web/'.$this -> aConfigs['template'].'/index'.$this -> aConfigs['type_file'];
        include($sPathIndex);
    }
   
    public function displayShort($aModules) {
    	$templates = $this;
        $sPath = gf_SYSTEM_PATH.'/apps/modules/'.$aModules['controller'].'/templates/'.$this -> aConfigs['template'].'/'.$aModules['action'].'Template'.$this -> aConfigs['type_file'];
        include($sPath);
    	$this -> _aFlash = array();
    }
    
	public function displayMini() {
    	$templates = $this;
    	$aModules = gfFW::Router() -> getModules();
        $sPath = gf_SYSTEM_PATH.'/apps/modules/'.$aModules['controller'].'/templates/'.$this -> aConfigs['template'].'/'.$aModules['action'].'Template'.$this -> aConfigs['type_file'];
        include($sPath);
    	$this -> _aFlash = array();
    }

    public function displaySelectedTemplates($sFile) {
        $templates = $this;
        $aModules = gfFW::Router() -> getModules();
        $sPathIndex = gf_SYSTEM_PATH.'/apps/web/'.$this -> aConfigs['template'].'/index'.$this -> aConfigs['type_file'];
        include($sPathIndex);
        gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_FILE_LOADED, gfLog::STATUS_SUCCESS, $sPathIndex, gfDebugg::getTime());
        $this -> _aFlash = array();
    }
}
