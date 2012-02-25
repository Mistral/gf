<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.core.cache.gfCacheAbstract
 * 
 */

gfRunner::setConstans('gf_CACHE_DIR', gf_SYSTEM_PATH.'/apps/cache', array('infile' => __FILE__, 'inline' => __LINE__));

abstract class gfCacheAbstract {
    
    public $__iState = 0;
    public $__sBuffor;
    protected $__sFile;
    protected $__sSystem;
    public $__iLife = 0;
    
    abstract public function sendCache($sContent);
    abstract public function cache($sFile, $iLife = 0);
    abstract public function removeCache($sFile);
    
}
