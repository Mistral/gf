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
    private $alibs;
    private $ahelpers;
    protected $helper;
    private $view;
    protected $lang;
    private $model;

    public function addView() {
        require_once(gf_CORE_PATH.'/gfView.php');
        $this->view = new gfView();
    }

    public function addModel() {
        require_once(gf_CORE_PATH.'/gfModel.php');
        require_once(gf_CORE_PATH.'/gfModelForm.php');
        require_once(gf_APP_PATH.'/models/'.gf::router()->getController().'.php');
        $model = gf::router()->getController().'Model';
        $this->model = new $model();
        if($this->model->getType() != 'standard') {
            $this->model->addValider();
        }
    }

    public function addLang() {
        require_once(gf_APP_PATH.'/langs/'.gfRegister::get('language').'/'.gf::router()->getController().'.php');
        $this->lang = $lang;
        $this->view()->addLang($lang);
    }


    protected function addLib($action, array $libs) {
        if($action == gf::router()->getAction()) {
            $this->alibs[$action] = $libs;
            if(count($this->alibs[gf::router()->getAction()]) > 0) {
                foreach($this->alibs[gf::router()->getAction()] as $lib) {
                    if($this->loadLib($lib)) {
                        $this->lib[$lib] = new $lib();
                    }
                }
            }
        }
    }
    
    private function loadLib($lib) {
        if($this->isLib(gf_LIBS_PATH.'/'.$lib)) {
            require_once(gf_LIBS_PATH.'/'.$lib.'.php');
            return true;
        } else if($this->isLib(gf_APP_PATH.'/libs/'.$lib)) {
            require_once(gf_APP_PATH.'/libs/'.$lib.'.php');
            return true;
        }
        return false;
    }

    private function isLib($lib) {
        if(is_file($lib.'.php')) {
            return true;
        }
        return false;
    }

    protected function addHelper($action, array $helpers) {
        if($action == gf::router()->getAction()) {
            $this->ahelpers[$action] = $helpers;
            if(count($this->ahelpers[gf::router()->getAction()]) > 0) {
                foreach($this->ahelpers[gf::router()->getAction()] as $helper) {
                    if($this->loadHelper($helper)) {
                        $this->helper[$helper] = new $helper();
                    }
                }
            }
        }
    }

    private function loadHelper($helper) {
        if($this->isHelper(gf_LIBS_PATH.'/helpers/'.$helper)) {
            require_once(gf_LIBS_PATH.'/helpers/'.$helper.'.php');
            return true;
        } else if($this->isHelper(gf_APP_PATH.'/libs/helpers/'.$helper)) {
            require_once(gf_APP_PATH.'/libs/helpers/'.$helper.'.php');
            return true;
        }
        return false;
    }

    private function isHelper($helper) {
        if(is_file($helper.'.php')) {
            return true;
        }
        return false;
    }

    protected function Model() {
        return $this->model;
    }

    protected function view() {
        return $this->view;
    }

    protected function render() {
        $this->view->render();
    }

}
