<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfCookie
 * 
 */

class gfCookie {
	
	public function set($sName, $sValue, $iExpire) {
		setcookie($sName, $sValue, mktime() + $iExpire);
	}
	
	public function get($sName) {
		if($this -> is($sName)) {
			return $_COOKIE[$sName];
		} else {
			return false;
		}
	}
	
	public function is($sName) {
		if(isset($_COOKIE[$sName])) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($sName) {
		unset($_COOKIE[$sName]);
	}
	
}
