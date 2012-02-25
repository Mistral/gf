<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.log.logs.gfLog_File
 * 
 */

require_once gf_CORE_PATH.'/log/gfLog_Abstract.php';

class gfLog_File extends gfLog_Abstract {
    const FILE_REQUIRED = 1;
    const FILE_INCLUDED = 2;
    const FILE_CHANGED  = 3;
    const FILE_DELETED  = 4;
    const FILE_CREATED  = 5;
    const FILE_MOVED    = 6;
}