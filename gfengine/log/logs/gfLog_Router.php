<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.logs.gfLog_Router
 * 
 */

require_once gf_CORE_PATH.'/log/gfLog_Abstract.php';

class gfLog_Router extends gfLog_Abstract {
    const CONNECT_REWRITER = 301;
    const SET_CONTROLLER = 302;
    const SET_ACTION = 303;
    const SET_PARAMS = 304;
    const SEND_OPEN = 305;
    const CREATE_URL = 306;
    const CREATE_FORM = 307;
}