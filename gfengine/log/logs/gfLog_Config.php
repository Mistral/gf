<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.logs.gfLog_Config
 * 
 */

require_once gf_CORE_PATH.'/log/gfLog_Abstract.php';

class gfLog_Config extends gfLog_Abstract {
    const CONFIG_SET     = 1;
    const CONFIG_GET     = 2;
    const CONFIG_LOADED  = 3;
    const CONFIG_UPDATED = 4;
    const CONFIG_REMOVED = 5;
}