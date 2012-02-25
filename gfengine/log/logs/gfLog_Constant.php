<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.logs.gfLog_Constant
 * 
 */

require_once gf_CORE_PATH.'/log/gfLog_Abstract.php';

class gfLog_Constant extends gfLog_Abstract {
    const CONST_SET = 1;
    const CONST_UNSET = 2;
}