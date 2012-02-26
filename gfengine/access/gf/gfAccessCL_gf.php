<?php
require_once(gf_CORE_PATH.'/access/gfAccessCL.php');

class gfAccessCL_gf extends gfAccessCL {
	
	private $_aRoles = array();
	
	private function _sumRoles($oRole, $oRoleParent) {
		$aAllowedRole = $oRole -> getAllowed();
		if($oRoleParent != NULL) {
			$aAllowedRoleParent = $oRoleParent -> getAllowed();
			$aArrayOfNewAllow = $aAllowedRoleParent;
		}
		
		if($oRoleParent != NULL) {
			foreach($aAllowedRole['allowed_modules'] as $v) {
				foreach($aAllowedRoleParent['allowed_modules'] as $v1) {
					if($v[0] == $v1[0]) {
						if($v[1] == $v1[1]) {
							//
						} else {
							$aArrayOfNewAllow['allowed_modules'][] = $v;
						}
					} else {
						$aArrayOfNewAllow['allowed_modules'][] = $v;
					}
				}
			}
			foreach($aAllowedRole['allowed_id'] as $v) {
				foreach($aAllowedRoleParent['allowed_id'] as $v1) {
					if($v == $v1) {
						//
					} else {
						$aArrayOfNewAllow['allowed_id'][$v] = $v;
					}
				}
			}
		} else {
			
			foreach($aAllowedRole['allowed_id'] as $v) {
				$aArrayOfNewAllow['allowed_id'][$v] = $v;
			}
			
			foreach($aAllowedRole['allowed_modules'] as $v) {
				$aArrayOfNewAllow['allowed_modules'][] = $v;
			}
		}
				
		return $aArrayOfNewAllow;
		
	}
	
	public function addRole(gfAccessRole $oRole, gfAccessRole $oRoleParent = NULL) {
		foreach($this -> _aRoles as $v) {
			if($v === $oRole) {
				return false;
			}
		}
		$oRole -> updateAllowed($this->_sumRoles($oRole, $oRoleParent));
		$this -> _aRoles[$oRole->getName()] = $oRole;
		return true;
	}
	
	
	public function delRole(gfAccessRole $oRole) {
		foreach($this -> _aRoles as $k => $v) {
			if($v === $oRole) {
				unset($this -> _aRoles[$k]);
			}
		}
	}
	
	public function isAllowedRole($oUserRole, $sModule, $sAction) {
		if($this -> _aRoles[$oUserRole->getName()] -> isAllowed($sModule, $sAction)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function isAllowedIdRole($oUserRole, $iId) {
		if($this -> _aRoles[$oUserRole->getName()] -> isAllowedId($iId)) {
			return true;
		} else {
			return false;
		}
	}
	
}
?>