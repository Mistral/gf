<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.core.db.gfMySQL
 * 
 */

gfRunner::addRequire (gf_SYSTEM_LIBS_CORE_PATH.'/exception/gfMySQL_Exception.php', array('infile' => __FILE__, 'inline' => __LINE__));

interface gfMySQL_interface {
    public function getPrefix();
    public function prepare($sQuery);
}

interface gfMySQL_Statement_interface {
    public function execute();
    public function fetchRow();
    public function fetchAssoc();
    public function addParam($sBind, $sName, $cType);
    public function fetchArrayAll();
    public function fetchArray();
    public function getInsertId();
    public function getAffectedRows();
    public function cache();
}

gfRunner::setConstans('gfMySQL_PARAM_INT', 1, array('infile' => __FILE__, 'inline' => __LINE__));
gfRunner::setConstans('gfMySQL_PARAM_STR', 2, array('infile' => __FILE__, 'inline' => __LINE__));

class gfMySQL implements gfMySQL_interface {

    private $rDbh;

    protected $__aData;

    public function __construct() {
        $this -> __aData = array('host' => gfConfigFW::getConfig('mysql_host'), 'user' => gfConfigFW::getConfig('mysql_user'), 'password' => gfConfigFW::getConfig('mysql_password'), 'database' => gfConfigFW::getConfig('mysql_database'), 'prefix' => gfConfigFW::getConfig('mysql_prefix'));
        $this -> __connect();
    }

    protected function __connect() {
        if(!$this -> __aData['host']) {
            $this -> init();
        }
        $this -> rDbh = mysql_connect($this -> __aData['host'], $this -> __aData['user'], $this -> __aData['password']);
        mysql_select_db($this -> __aData['database']);
		mysql_query("SET character_set_client='utf8'");
		mysql_query("SET character_set_connection='utf8'");
		mysql_query("SET character_set_results='utf8'");
		mysql_query("SET character_set_server='utf8'");
        if(!$this -> rDbh) {
            throw new gfMySQL_Exception('Nie moĹĽna nawiÄ…zaÄ‡ poĹ‚Ä…czenia z bazÄ… danych MySQL', 001);
        }
    }

    public function getPrefix() {
        return $this -> __aData['prefix'];
    }

    public function prepare($sQuery) {
        if(!$this -> rDbh) {
            $this -> __connect();
        }
        return new gfMySQL_Statement($this -> rDbh, $sQuery);
    }
}
class gfMySQL_Statement implements gfMySQL_Statement_interface {

    private $_sResult;

    private $_sQuery;

    private $_rDbh;

    private $_aParams = array();
    
    private $oCache;

    public function __construct($rDbh, $sQuery) {
        $this -> _sQuery = $sQuery;
        $this -> _rDbh = $rDbh;
        $this -> oCache = gfRunner::registerClass('gfCacheMySQL', 'object', '__construct()', gf_SYSTEM_LIBS_CORE_PATH.'/cache/gfCacheMySQL.php',  array('infile' => __FILE__, 'inline' => __LINE__));
        gfRunner::registerStaticClass('gfFiltre', 'static', 'instance()', gf_SYSTEM_LIBS_CORE_PATH.'/gfFiltre.php', array('infile' => __FILE__, 'inline' => __LINE__, 'status' => 0));
        if(!$this -> _rDbh) {
            throw new gfMySQL_Exception('Nie moĹĽna skopiowaÄ‡ uchwytu bazy danych MySQL', 002);
        }
    }

    public function execute() {
        $sQuery = $this -> _sQuery;
        if(!empty($this -> _aParams)) {
            foreach($this -> _aParams as $index => $name) {
                $sQuery = str_replace($index, $name, $sQuery);
            }
        }
        if($this -> oCache -> __iState == 0 || $this -> oCache -> __iState == 2) {
            $this -> _sResult = mysql_query($sQuery, $this -> _rDbh) or die(mysql_error($this -> _rDbh).gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_SEND_QUERY, gfLog::STATUS_ERROR, $sQuery.'_|_'.mysql_error($this -> _rDbh), gfDebugg::getTime()));
            if($this -> _sResult) {
                gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_SEND_QUERY, gfLog::STATUS_SUCCESS, $sQuery, gfDebugg::getTime());
            }
            if($this -> oCache -> __iState == 2) {
                while($aValue = mysql_fetch_array($this -> _sResult, MYSQL_ASSOC)){
                    $sMySQLResult[] = $aValue;
                }
                $sResult = serialize($sMySQLResult);
                $sResult .= 'gfcache_time_life'.$this -> oCache -> __iLife.'gfcache_time_life';
                $this -> oCache -> sendCache($sResult);
                $this -> _aHelpArrayResult = $sMySQLResult;
            }
        } else if ($this -> oCache -> __iState == 1) {
            gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_SEND_QUERY_CACHE, gfLog::STATUS_SUCCESS, $sQuery, gfDebugg::getTime());
            $this -> _sResult = $this -> oCache -> __sBuffor;
        } else {
            gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_CACHE, gfLog::STATUS_ERROR, 'Error status in __iState', gfDebugg::getTime());
        }
        if(!$this -> _sResult) {
            throw new gfMySQL_Exception('Nie moĹĽna wykonaÄ‡ zapytania do bazy danych MySQL.', 003);
        }
        return $this;
    }

    public function cache() {
    	return $this -> oCache;
    }
    
    public function getInsertId() {
        if(!$this -> _rDbh) {
            throw new gfMySQL_Exception('Nie moĹĽna pobraÄ‡ ID ostatniego zapytania.', 005);
        }
        return mysql_insert_id($this -> _rDbh);
    }

    public function addParam($sBind, $sName, $cType) {
        if($cType == gfMySQL_PARAM_INT) {
            $this -> _aParams += array($sBind => gfFiltre::filtreInt($sName));
        } else {
            $this -> _aParams += array($sBind => gfFiltre::filtreString($sName));
        }
    }
    
	public function fetchRow() {
        if(!$this -> _sResult) {
            throw new gfMySQL_Exception('Nie moĹĽna pobraÄ‡ zasobĂłw ostatniego zapytania.', 004);
        }
        return mysql_fetch_row($this -> _sResult);
    }

    public function fetchAssoc() {
        if(!$this -> _sResult) {
			throw new gfMySQL_Exception('Nie moĹĽna pobraÄ‡ zasobĂłw ostatniego zapytania.', 004);
        }
        return mysql_fetch_assoc($this -> _sResult);
    }

    public function fetchArray() {
        if(!$this -> _sResult) {
			throw new gfMySQL_Exception('Nie moĹĽna pobraÄ‡ zasobĂłw ostatniego zapytania.', 004);
        }
        return mysql_fetch_array($this -> _sResult);
    }

    public function fetchArrayAll() {
        if($this -> _aHelpArrayResult) {
            return $this -> _aHelpArrayResult;
        } else {
            if($this -> oCache -> __iState == 1) {
                return $this -> _sResult;
            } else {
                $aTablica = array();
                while($aDane = mysql_fetch_array($this -> _sResult, MYSQL_ASSOC)) {
                    $aTablica[] = $aDane;
                }
                return $aTablica;
            }
        }
    }
    
	public function getNumRows() {
        if(!$this -> _sResult) {
            throw new gfMySQL_Exception('Nie moĹĽna pobraÄ‡ zasobĂłw ostatniego zapytania.', 004);
        }
        return mysql_num_rows($this -> _sResult);
    }
    
    public function getAffectedRows() {
    	if(!$this -> _sResult) {
            throw new gfMySQL_Exception('Nie moĹĽna pobraÄ‡ zasobĂłw ostatniego zapytania.', 004);
        }
        return mysql_affected_rows();
    }
}
