<?php
abstract class gfAccessCL {
	abstract public function addRole(gfAccessRole $oRole, gfAccessRole $oRoleParent = NULL);
	abstract public function delRole(gfAccessRole $oRole);
	abstract public function isAllowedRole($oUserRole, $sModule, $sAction);
	abstract public function isAllowedIdRole($oUserRole, $iId);
}
?>