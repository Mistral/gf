<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfSession
 * 
 */

class gfSession {
	
    public function getSID() {
    	if($this -> getSession('SID')) {
    		return $this -> getSession('SID');
    	} else {
    		return false;
    	}
    }
    
    public function setSessionValueEx($sValue, $sParam1, $sParam2, $sParam3 = '', $sParam4 = '') {
    	if($sParam3 != '' && $sParam4 = '') {
    		$_SESSION[$sParam1][$sParam2][$sParam3] = $sValue;
    		
    	} else if ($sParam4 != '') {
    		$_SESSION[$sParam1][$sParam2][$sParam3][$sParam4] = $sValue;
		
    	} else {
    		$_SESSION[$sParam1][$sParam2] = $sValue;
    		
    	}
    }
    
    public function getSessionValueEx($sParam1, $sParam2, $sParam3 = '', $sParam4 =  '') {
    	if(@$sParam3 != '' && @$sParam4 = '') {
    		return $_SESSION[$sParam1][$sParam2][$sParam3];
    	} else if(@$sParam4 != '') {
    		return $_SESSION[$sParam1][$sParam2][$sParam3][$sParam4];
    	} else {
    		return $_SESSION[$sParam1][$sParam2];
    	}
    }
    
    public function getSession($sName) {
    	if(@$_SESSION[$sName]) {
    		return $_SESSION[$sName];
    	} else {
    		return false;
    	}
    }
    
    public function setSessionValue($sName, $sValue) {
        $_SESSION[$sName] = $sValue;
        
    }
}
