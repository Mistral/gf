<?php
if (!defined('gf_PATH')) {
	die ('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfRouter
 * 
 */

class gfRouter {
	
    private $open = array('controller' => NULL, 'action' => NULL, 'params' => array());
	
    private $extpat = array ('/(\.html?)/', '/(\.xml)/', '/(\.pdf)/', '/(\.txt)/' );

    public function __construct($request) {

        if (gfConfig::getConfig('rewrite') == 0) {
            if(!$request['con']) {

                $this -> setController('index');
                $this -> setAction('index');

            } else if($request['con'] && !$request['act']) {

                $this -> setController($request['con']);
                $this -> setAction('index');

            } else {

                $this -> setController($request['con']);
                $this -> setAction($request['act']);

                $arrayGET = $request;

                unset($arrayGET['cont']);
                unset($arrayGET['act']);

                $aParams = array();

                foreach(@$arrayGET as $v) {
                    $aParams[] = $v;
                }

                $this->setParams($aParams);
            }

        } else {

            if(gfConfig::getConfig('rewrite_rules') == 1) {

                if ($request['url'] == FALSE) {

                    $this->setController('index');
                    $this->setAction('index');
                    $this->setParams(NULL);

                } else {

                    require_once gf_CORE_PATH.'/gfRewriter.php';

                    $rewriter = new gfRewriter();

                    if(gfConfig::getConfig('logs') == 1) {

                        gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'gfRewriter.php', gf_CORE_PATH, __FILE__, __LINE__));
                        gfLog::add(new gfLog_Router(gfLog_Router::CONNECT_REWRITER, 'gfRewriter'));

                    }

                    if ($rewriter->isRewriteRules($request['url'])) {

                        $aRules = $rewriter->getRules($rewriter->getRulesUse());

                        $this->setController($aRules['open']['controller']);
                        $this->setAction($aRules['open']['action']);
                        $this->setParams($aRules['open']['params']);

                    } else {

                        $sInput = $request['url'];

                        $sURL = $this->deleteExtension($sInput);

                        $aParams = $this->explodeURL($sURL);

                        $this->explodeParams($aParams);

                    }
                }
            } else {

                $sInput = $request['url'];

                if (empty($sInput)) {

                    $this->setController('index');
                    $this->setAction('index');
                    $this->setParams(NULL);

                } else {

                    $sURL = $this->deleteExtension($sInput);
                    $aParams = $this->explodeURL($sURL);
                    $this->explodeParams($aParams);

                }
            }
        }
    }

    public function setOpen($sController, $sAction, $aParams) {
		
	$this -> setController($sController);
	$this -> setAction($sAction);
	$this -> setParams($aParams);	
			
    }
	
    public function createURL($sController, $sAction, $aParams = array(), $extension = '') {
		
	$sURL = gf_DOMAIN;
		
	if(gfConfig::getConfig('rewrite') == 1) {
			
            $sURL .= '/'.$sController.'/'.$sAction;
			
            if(!empty($aParams)) {
                foreach($aParams as $v) {
                    $sURL .= '/'.$v;			
                } 
            }
                    
            if($extension != '') {
                $sURL .= $extension;
            }
			
	} else {
			
            $sURL .= '/index.php?con='.$sController.'&act='.$sAction;
                    
            if(!empty($aParams)) {
                foreach($aParams as $k => $v) {
                    $sURL .= '&'.($k+1).'='.$v;
                }
            }	
        }
		
	return $sURL;
		
    }
	
    public function createFormURL($sController, $sAction, $aParams = array(), $extension = '') {
		
	if(gfConfig::getConfig('rewrite') == 1) {
			
            $sURL = '/'.$sController.'/'.$sAction;
            if(!empty($aParams)) {
                foreach($aParams as $v) {
                    $sURL .= '/'.$v;			
                }
            }
            
            if($extension != '') {
                $sURL .= $extension;
            }
			
	} else {
			
            $sURL = '?con='.$sController.'&act='.$sAction;
			
            if(!empty($aParams)) {
                foreach($aParams as $v) {
                    $sURL .= '/'.$v;			
                }
            }
			
	}
		
	return $sURL;
		
    }
	
    public function getModules() {		
	return $this->open;		
    }
	
    public function getController() {
	return $this->open['controller'];
    }
	
    public function getAction() {
	return $this->open['action'];
    }
	
    public function getParams() {
        if(!empty($this->open['params'])) {
            return $this->open['params'];
        } else {
            return false;
        }
    }
	
    public function getParam($iId) {
        if(!empty($this->open['params'][$iId - 1])) {
            return $this->open['params'][$iId - 1];
        } else {
            return false;
        }
    }
	
    public function setParams($sValue) {
	$this->open['params'] = $sValue;
    }
	
    public function setAction($sValue) {
	$this->open['action'] = $sValue;
    }
	
    public function setController($sValue) {
	$this->open['controller'] = $sValue;
    }
	
    private function explodeURL($sURL) {
	$aArray = explode('/', $sURL, 3);
	return $aArray[2];
    }
	
    private function deleteExtension($sInput) {
	$sInput = preg_replace($this->extpat[0], '', $sInput);
	return $sInput;
    }
	
    private function explodeParams($sParams = '') {
		
	if (!empty($sParams)) {
			
            $params = explode('/', $sParams);
			
            $this->setParams($params);
	}
		
    }
		
}
