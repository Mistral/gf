<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.logs.gfLog_Session
 * 
 */

require_once gf_CORE_PATH.'/log/gfLog_Abstract.php';

class gfLog_Session extends gfLog_Abstract {
    const SESSION_STARTED = 1;
    const SESSION_CLOSED  = 2;
    const SESSION_SET     = 3;
    const SESSION_MODIFY  = 4;
    const SESSION_GET     = 5;
    const SESSION_UNSET   = 6;
    const SESSION_GETID   = 7;
}