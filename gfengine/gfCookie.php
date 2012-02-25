<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfCookie
 * 
 */

class gfCookie {
	
	public function setCookie($sName, $sValue, $iExpire) {
		setcookie($sName, $sValue, mktime() + $iExpire);
	}
	
	public function getCookie($sName) {
		if($this -> issetCookie($sName)) {
			return $_COOKIE[$sName];
		} else {
			return false;
		}
	}
	
	public function issetCookie($sName) {
		if(isset($_COOKIE[$sName])) {
			return true;
		} else {
			return false;
		}
	}
	
	public function unsetCookie($sName) {
		unset($_COOKIE[$sName]);
	}
	
}
