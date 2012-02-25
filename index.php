<?php
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.index
 * 
 */
session_start();
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('gf_PATH', dirname(__FILE__));
define('gf_LIBS_PATH', gf_PATH.'/libs');
define('gf_CORE_PATH', gf_PATH.'/gfengine');
define('gf_LOGS_PATH', gf_CORE_PATH.'/log/logs');
define('gf_DOMAIN', str_replace('/index.php', '', $_SERVER['PHP_SELF']));
define('gf_APP_PATH', gf_PATH.'/app');

require_once(gf_CORE_PATH.'/log/gfLog.php');

gfLog::loadAll();

require_once(gf_CORE_PATH.'/gfConfig.php');

gfConfig::loadConfigs();

if(gfConfig::getConfig('logs') == 1) {
    
    gfLog::add(new gfLog_Config(gfLog_Config::CONFIG_LOADED, 'configs.ini', gf_CORE_PATH, __FILE__, 23));
    
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_PATH', gf_PATH, __FILE__, 10, gf_PATH));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_CORE_PATH', gf_PATH, __FILE__, 12, gf_CORE_PATH));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_LIBS_PATH', gf_PATH, __FILE__, 11, gf_LIBS_PATH));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_LOGS_PATH', gf_PATH, __FILE__, 13, gf_LOGS_PATH));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_DOMAIN', gf_PATH, __FILE__, 14, gf_DOMAIN));
    gfLog::add(new gfLog_Constant(gfLog_Constant::CONST_SET, 'gf_APP_PATH', gf_PATH, __FILE__, 15, gf_APP_PATH));
    
    gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'gfLog.php', gf_CORE_PATH.'/log', __FILE__, 17));
    gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'gfConfig.php', gf_CORE_PATH, __FILE__, 21));
    
    gfLog::add(new gfLog_Session(gfLog_Session::SESSION_STARTED, 'session_start()', gf_PATH, __FILE__, 8));
}

if(gfConfig::getConfig('functions_use_functions') == 1) {
    require_once gf_APP_PATH.'/functions/functions.php';
    if(gfConfig::getConfig('logs') == 1) {
        gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'functions.php', gf_APP_PATH.'/functions', __FILE__, __LINE__));
    }
}

if(gfConfig::getConfig('functions_use_classes') == 1) {
    require_once gf_APP_PATH.'/functions/classes.php';
    if(gfConfig::getConfig('logs') == 1) {
        gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'classes.php', gf_APP_PATH.'/functions', __FILE__, __LINE__));
    }
}
require_once(gf_CORE_PATH.'/gf.php');
gf::init();

if(gfConfig::getConfig('setters_core') == 1) {
    require_once gf_CORE_PATH.'/gfRegister.php';
    require_once gf_APP_PATH.'/setters_core/setTemplate.php';
    require_once gf_APP_PATH.'/setters_core/setLanguage.php';

    if(gfConfig::getConfig('logs') == 1) {
        gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'functions.php', gf_APP_PATH.'/functions', __FILE__, __LINE__));
        gfLog::add(new gfLog_File(gfLog_File::FILE_REQUIRED, 'classes.php', gf_APP_PATH.'/functions', __FILE__, __LINE__));    
    }
}

if(gfConfig::getConfig('filters') == 1) {
	gf::Filter() -> runFilterPre();
}

gf::run();

if(gfConfig::getConfig('filters') == 1) {
	gf::Filter() -> runFilterPost();
}

ob_end_flush();
?>
