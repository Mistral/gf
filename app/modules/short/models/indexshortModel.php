<?php
class indexshortModel extends gfModel {
	
    public function showUser($uid) {
        return $uid;
    }
    
    public function createMail($sName, $sLoginKey, $sMsg) {
    	$sMsg = str_ireplace('{name}', $sName, $sMsg);
    	$sMsg = str_ireplace('{login_key}', $sLoginKey, $sMsg);
    	return $sMsg;
    }
    
}
?>