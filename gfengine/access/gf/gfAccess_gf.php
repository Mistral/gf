<?php
require_once(gf_CORE_PATH.'/access/gfAccess.php');

class gfAccess_gf extends gfAccess {

    private $_oAccessCL;
    private $_aAccessRole = array();

    public function __construct() {

        require_once(gf_CORE_PATH.'/access/'.gfConfig::getConfig('use_access').'/gfAccessRole_'.gfConfig::getConfig('use_access').'.php');
        require_once(gf_CORE_PATH.'/access/'.gfConfig::getConfig('use_access').'/gfAccessCL_'.gfConfig::getConfig('use_access').'.php');

        $this -> _oAccessCL = new gfAccessCL_gf();
        $this -> _oAccessRole = new gfAccessRole_gf();

    }

    public function AccessControlList() {
        return $this -> _oAccessCL;
    }

    public function addAccessRole() {
        $this -> _aAccessRole[] = new gfAccessRole_gf();
        return end($this -> _aAccessRole);
    }

}
?>