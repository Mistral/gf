<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec
 * @subpackage gfFW.libs.core.exception.gfRouter_Exception
 * 
 */

gfRunner::addRequire(gf_SYSTEM_LIBS_CORE_PATH.'/exception/gfException_Abstract.php', array('infile' => __FILE__, 'inline' => __LINE__));
    
class gfRouter_Exception extends gfException_Abstract {
	public function __construct($iCode = '', $sMessage = '', $aSolutions = array(), $sType = '') {
        parent::__construct($iCode, $sMessage, $aSolutions, 'gfRouter');
    }
}