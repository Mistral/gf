<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.logs.gfLog_Action
 * 
 */

require_once gf_CORE_PATH.'/log/gfLog_Abstract.php';

class gfLog_Action extends gfLog_Abstract {
    
    const ADD_USER_LIB      = 201;
    const ADD_USER_HELPER   = 202;
    const ADD_LIB           = 203;
    const ADD_HELPER        = 204;
    const EXEC              = 205;
    const ADD_LANG          = 206;
    const ADD_MODEL         = 207;
    const INIT_VIEW         = 208;
    
}
