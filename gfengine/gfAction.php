<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfAction
 * 
 */

class gfAction {

    protected $lib;
    protected $alibs;
    protected $ahelpers;
    protected $view;
    protected $lang;


    public function addLib($action, array $libs) {
        $this->alibs[$action] = $libs;
        if(count($this->alibs[gf::router()->getAction()]) > 0) {
            foreach($this->alibs[gf::router()->getAction()] as $lib) {
                if($this->loadLib($lib)) {
                    $this->lib[$lib] = new $lib();
                }
            }
        }
    }
    
    public function loadLib($lib) {
        if($this->isLib(gf_LIBS_PATH.'/'.$lib)) {
            require_once(gf_LIBS_PATH.'/'.$lib.'.php');
            return true;
        } else if($this->isLib(gf_APP_PATH.'/libs/'.$lib)) {
            require_once(gf_APP_PATH.'/libs/'.$lib.'.php');
            return true;
        }
        return false;
    }

    public function isLib($lib) {
        if(is_file($lib.'.php')) {
            return true;
        }
        return false;
    }

    public function addHelper($action, array $helpers) {

    }

    public function view() {
        //zwraca obiekt view
    }

    public function render() {
        //generuje od razu widok
    }

}
