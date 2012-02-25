<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.core.cache.gfCacheMySQL
 * 
 */

gfRunner::addRequire(gf_SYSTEM_LIBS_CORE_PATH.'/cache/gfCache.php', array('infile' => __FILE__, 'inline' => __LINE__));

class gfCacheMySQL extends gfCache {  
	  
    public function __construct() {
        $this -> __sSystem = 'mysql';
        $this -> __iState = 0;
    }
    
}
