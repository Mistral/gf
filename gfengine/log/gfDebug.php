<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.debugg.gfDebug
 * 
 */

class gfDebugg {
    
    private static $_aInfo = array();
    	
	
    public static function start() {
        self::$_aInfo['start'] = @number_format(microtime(), 6);
    }
    
    public static function getTime() {
        return number_format(microtime() - self::$_aInfo['start'], 6);
    }
    
    public static function addReqiure($sPath, $iTime, $iID) {
        self::$_aInfo['reqiure_file'][] = array('file' => $sPath['file'], 'infile' => $sPath['infile'], 'inline' => $sPath['inline'], 'time' => $iTime, 'id' => $iID);
        return true;
    }
    
    public static function addClass($aInfo, $iTime, $iID) {
        self::$_aInfo['class_initialize'][] = array('class' => $aInfo['class'], 'file' => $aInfo['file'], 'class_type' => $aInfo['class_type'], 'method' => $aInfo['method'], 'infile' => $aInfo['infile'], 'inline' => $aInfo['inline'], 'time' => $iTime, 'id' => $iID);
        return true;
    }
    
    public static function addQuery($sQuery, $iTime, $iID) {
        self::$_aInfo['send_query'][] = array('query' => $sQuery, 'time' => $iTime, 'id' => $iID);
        return true;
    }
    
    public static function addQueryCache($sQuery, $iTime, $iID) {
        self::$_aInfo['send_query_cache'][] = array('query' => $sQuery, 'time' => $iTime, 'id' => $iID);
        return true;
    }
    
    public static function addConst($sName, $iTime, $iID) {
        self::$_aInfo['set_const'][] = array('name' => $sName['name'], 'value' => $sName['value'], 'infile' => $sName['infile'], 'inline' => $sName['inline'], 'time' => $iTime, 'id' => $iID);
        return true;
    }
    
    public static function addSessions($sName, $iTime, $iID) {
        self::$_aInfo['sessions'][] = array('session' => $sName, 'time' => $iTime, 'id' => $iID);
        return true;
    }
    
    public static function stop() {
        self::$_aInfo['stop'] = @number_format(microtime(), 6);
        self::$_aInfo['time'] = self::$_aInfo['stop'] - self::$_aInfo['start'];
    }
    
    public static function getGenerateTime() {
        return self::$_aInfo['time'];
    }
    
    public static function getInfo() {
        print_r(self::$_aInfo);
    }
}