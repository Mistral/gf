<?php
require_once(gf_CORE_PATH.'/access/gfAccessRole.php');

class gfAccessRole_gf extends gfAccessRole {
	
	private $_aAllowed = array();
	private $_sName;
	
	public function __construct() {
		$this -> _aAllowed['allowed_id'] = array();
		$this -> _aAllowed['allowed_modules'] = array();
	}
	
	public function setName($sName) {
		$this -> _sName = $sName;
		return $this;
	}
	
	public function allow($mModule, $mAction) {
		$this -> _aAllowed['allowed_modules'][] = array($mModule, $mAction);
		return $this;
	}
	
	public function allowId($iId) {
		$this -> _aAllowed['allowed_id'][$iId] = $iId;
		return $this;
	}
	
	public function disallow($mModule, $mAction) {
		foreach($this -> _aAllowed['allowed_modules'] as $k => $v) {
			if($v[0] == $mModule && $v[1] == $mAction) {
				unset($this -> _aAllowed['allowed_modules'][$k]);
			}
		}
		return $this;
	}
	
	public function disallowId($iId) {
		unset($this -> _aAllowed['allowed_id'][$iId]);
		return $this;
	}
	
	public function getAllowed() {
		return $this -> _aAllowed;
	}
	
	public function getName() {
		return $this -> _sName;
	}
	
	public function isAllowed($mModule, $mAction) {
		foreach($this -> _aAllowed['allowed_modules'] as $v) {
			if($v[0] == 'all_modules') {
				if($v[1] == 'all_modules') {
					return true;
				} else {
					if($v[1] == $mAction) {
						return true;
					}
				}
			}
			if($v[0] == $mModule && $v[1] == $mAction) {
				return true;
			}
		}
		return false;
	}
	
	public function isAllowedId($iId) {
		if(isset($this -> _aAllowed['allowed_id'][$iId])) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updateAllowed($aArrayOfUpdatedAllowed) {
		$this -> _aAllowed = (array) $aArrayOfUpdatedAllowed;
	}
	
}
?>