<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 2.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.gfLog
 * 
 */
 
class gfLog {

	private static $aLogs = array();

    public static function loadAll() {
        require_once gf_LOGS_PATH.'/gfLog_Constant.php';
        require_once gf_LOGS_PATH.'/gfLog_Action.php';
        require_once gf_LOGS_PATH.'/gfLog_Class.php';
        require_once gf_LOGS_PATH.'/gfLog_Core.php';
        require_once gf_LOGS_PATH.'/gfLog_File.php';
        require_once gf_LOGS_PATH.'/gfLog_Rewriter.php';
        require_once gf_LOGS_PATH.'/gfLog_Router.php';
        require_once gf_LOGS_PATH.'/gfLog_Session.php';
        require_once gf_LOGS_PATH.'/gfLog_Template.php';
        require_once gf_LOGS_PATH.'/gfLog_Config.php';
    }

	public static function add(gfLog_Abstract $log) {
		self::$aLogs['all'][] = $log;
		self::$aLogs[$log->getId()][] = $log;
	}
	
}