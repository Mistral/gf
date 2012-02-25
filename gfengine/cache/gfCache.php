<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}

/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.core.cache.gfCache
 * 
 */

gfRunner::addRequire(gf_SYSTEM_LIBS_CORE_PATH.'/cache/gfCacheAbstract.php', array('infile' => __FILE__, 'inline' => __LINE__));

class gfCache extends gfCacheAbstract {    
    
    public function sendCache($sContent) {
        file_put_contents(gf_CACHE_DIR.'/'.$this -> __sSystem.'/'.sha1($this -> __sFile).'.gfcache', $sContent);
    }
    
    public function cache($sFile, $iLife = 0) {
        $this -> __sFile = $sFile;
        $this -> __iLife = $iLife;
        if(@file_exists(gf_CACHE_DIR.'/'.$this -> __sSystem.'/'.sha1($sFile).'.gfcache')) {
            $rContentFile = file_get_contents(gf_CACHE_DIR.'/'.$this -> __sSystem.'/'.sha1($sFile).'.gfcache');
            if(preg_match('/(gfcache_time_life)(\d.*)(gfcache_time_life)/', $rContentFile, $matches)) {
                $rChanged = preg_replace('/(gfcache_time_life)(\d.*)(gfcache_time_life)/', '', $rContentFile);
                preg_match('/[0-9]+/', $matches[0], $matches_2);
            }
            $iLife = @$matches_2[0];
            if(mktime() > $iLife) {
                $this -> __iState = 2;
            } else {
                $this -> __iState = 1;
                $this -> __sBuffor = unserialize($rChanged);
            }
        } else {
            $this -> __iState = 2;
        }
    }
    
    public function removeCache($sFile) {
        if(file_exists(gf_CACHE_DIR.'/'.$this -> __sSystem.'/'.sha1($sFile).'.gfcache')) {
            unlink(gf_CACHE_DIR.'/'.$this -> __sSystem.'/'.sha1($sFile).'.gfcache');
        } else {
            gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_CACHE, gfLog::STATUS_ERROR, $sFile.'can\'t remove. File no exist', gfDebugg::getTime());
        }
    }
}
