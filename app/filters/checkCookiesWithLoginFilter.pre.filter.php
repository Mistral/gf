<?php
class checkCookiesWithLoginFilterPRE { // name of filter PRE before execute action

	public function run() { // method name must be "run" otherwise filter arent good work
		if(gfFW::Session()->isLogin()) {
			return true;
		} else {
			if(gfFW::Cookies()->issetCookie('auth_code') && gfFW::Cookies() -> issetCookie('name')) {
				$oStmt = gfFW::MySQL()->prepare('SELECT `id, `name`, `password`, `ip_registered`, `access` FROM `'.gfFW::MySQL()->getPrefix().'users` WHERE `name` = :1');
				$oStmt -> addparam(':1', gfFW::Cookies()->getCookie('name'), gfDB_MySQL_PARAM_STR);
				$aFetch = $oStmt -> execute() -> fetch_array();
				if(sha1($aFetch['name'].$aFetch['password'].$aFetch['ip_registered']) == sha1(gfFW::Cookies()->getCookie('auth_code'))) {
					$this -> Session() -> setName($aFetch['name']);
    				$this -> Session() -> setUserID($aFetch['id']);
    				$this -> Session() -> setAccess($aFetch['access']);
    				$this -> Session() -> setLogin();
    				$this -> _setLastLoginAndIP($aFetch['id']);
				} else {
					gfFW::Cookies()->unsetCookie('auth_code');
					gfFW::Cookies()->unsetCookie('name');
				}
			} else {
				return true;
			}
		}
	}
	
	private function _setLastLoginAndIP($iId) {
		$oStmt = gfFW::MySQL()->prepare('UPDATE `'.gfFW::MySQL()->getPrefix().'users` SET `last_login` = :1, `ip_lastlogin` = :2 WHERE `id` = :3');
    	$oStmt -> addParam(':1', mktime(), gfDB_MySQL_PARAM_INT);
    	$oStmt -> addParam(':2', $_SERVER['REMOTE_ADDR'], gfDB_MySQL_PARAM_STR);
    	$oStmt -> addParam(':3', $iId, gfDB_MySQL_PARAM_INT);
    	$oStmt -> execute();
	}
	
}