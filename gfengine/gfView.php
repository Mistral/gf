<?php
if(!defined('gf_PATH')) {
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
    private $lang;
    
    public function __construct() {
        if(!gfRegister::get('template')) {
            $this->setTemplate('default');
        } else {
            $this->setTemplate(gfRegister::get('template'));
        }
    }

    public function addLang($lang) {
        $this->lang = $lang;
    }
    
    private function setTemplate($template) {
        $this->configs['template'] = $template;
    }
    
    public function getTemplate() {
        return $this->configs['template'];
    }
    
    public function render() {
        $view = $this;
        $content = gf_APP_PATH.'/views/'.$this->getTemplate().'/'.gf::router()->getController().'/'.gf::router()->getAction().'.php';
        $index = gf_APP_PATH.'/web/'.$this->getTemplate().'/index.php';
        include($index);
    }
    
    public function renderPartial() {
    	$view = $this;
        $content = gf_APP_PATH.'/views/'.$this->getTemplate().'/'.gf::router()->getController().'/'.gf::router()->getAction().'.php';
        include($content);
    }

    public function renderCustom($sFile) {
        $view = $this;
        $content = gf_APP_PATH.'/views/'.$this->getTemplate().'/'.gf::router()->getController().'/'.$file.'.php';
        include($content);
    }
}
