<?php
if(!defined('gf_PATH')) {
    die('No script access');
}


class gfConfig {
	
	private static  $_aConfigs;
	
	public static function loadConfigs() {
		self::$_aConfigs = parse_ini_file(gf_APP_PATH.'/configs/configs.ini');
	}
	
	public static function setConfig($sName, $sValue) {
        
		self::$_aConfigs[$sName] = $sValue;
        
        if(gfConfig::getConfig('logs') == 1) {
            gfLog::add(new gfLog_Config(gfLog_Config::CONFIG_SET, $sName, gf_CORE_PATH, __FILE__, __LINE__, $sValue));
        }
	}
	
	public static function removeConfig($sName) {
		unset(self::$_aConfigs[$sName]);
        
        if(gfConfig::getConfig('logs') == 1) {
            gfLog::add(new gfLog_Config(gfLog_Config::CONFIG_REMOVED, $sName, gf_CORE_PATH, __FILE__, __LINE__));
        }
	}
	
	public static function getConfig($sName) {
        if(self::$_aConfigs['logs'] == 1) {
            gfLog::add(new gfLog_Config(gfLog_Config::CONFIG_GET, $sName, gf_CORE_PATH, __FILE__, __LINE__));
        }
		return self::$_aConfigs[$sName];
	}
	
	public static function updateConfig($sName, $sValue) {
		self::setConfig($sName, $sValue);
        
        if(gfConfig::getConfig('logs') == 1) {
            gfLog::add(new gfLog_Config(gfLog_Config::CONFIG_UPDATED, $sName, gf_CORE_PATH, __FILE__, __LINE__, $sValue));
        }
	}
}
?>