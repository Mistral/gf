<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfRewriter
 * 
 */
class gfRewriter {

    private $_sRulesUse = 'example';
    private $_aRules = array();

    private $url;

    public function __construct($url) {
        require_once gf_APP_PATH.'/configs/rewriterules.php';
        
        $this->url = $url;
        
        if(!empty ($aRules)) {
            foreach(@$aRules as $k => $v) {
                $this -> setRules($v['name'], $v['pattern'], $v['open']);
            }
            return true;
        }
        return false;
    }

    public function setRules($sName, $sPattern, $aOpen) {
        if($aOpen['params'] != NULL) {
            $aArrayOfParams = array();
            foreach ($aOpen['params'] as $pattern) {
                if(preg_match($pattern, $url, $match)) {
                    $aArrayOfParams[] = $match[0];
                }
            }
            $aOpen['params'] = (array) $aArrayOfParams;
        }
        $this -> _aRules[$sName] = array('pattern' => $sPattern, 'open' => array('controller' => $aOpen['controller'], 'action' => $aOpen['action'], 'params' => $aOpen['params']));
        return true;
    }

    public function getRules($sName) {
        if($this -> existRules($sName)) {
            return $this -> _aRules[$sName];
        } else {
            return false;
        }
    }

    public function existRules($sName) {
        if($this -> _aRules[$sName]) {
            return true;
        } else {
            return false;
        }
    }

    private function _setRulesUse($sName) {
        $this -> _sRulesUse = $sName;
    }

    public function getRulesUse() {
        return $this -> _sRulesUse;
    }

    public function isRewriteRules($sInput) {
        foreach($this -> _aRules as $k => $v) {
            if(preg_match($v['pattern'], $sInput)) {
                $this -> _setRulesUse($k);
                return true;
            }
        }
        return false;
    }
}
