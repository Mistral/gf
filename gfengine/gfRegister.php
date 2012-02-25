<?php
if(!defined('gf_PATH')) {
    die('No script access');
}

/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfRegister
 * 
 */

class gfRegister {
	
	private static $values = array();
	
	public static function set($sName, $sValue) {
		self::$values[$sName] = $sValue;
	}
	
	public static function get($sName) {
		return self::$values[$sName];
	}
	
}
?>