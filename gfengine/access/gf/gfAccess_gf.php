<?php
gfRunner::addRequire(gf_SYSTEM_LIBS_CORE_PATH.'/access/gfAccess.php', array('infile' => __FILE__, 'inline' => __LINE__));
class gfAccess_gf extends gfAccess {
	
	private $_oAccessCL;
	private $_aAccessRole = array();
	
	public function __construct() {
		$this -> _oAccessCL = gfRunner::registerClass('gfAccessCL_'.gfConfigFW::getConfig('use_access').'', 'object', '__construct()', gf_SYSTEM_LIBS_CORE_PATH.'/access/'.gfConfigFW::getConfig('use_access').'/gfAccessCL_'.gfConfigFW::getConfig('use_access').'.php', array('infile' => __FILE__, 'inline' => __LINE__));
		$this -> _oAccessRole = gfRunner::registerClass('gfAccessRole_'.gfConfigFW::getConfig('use_access').'', 'object', '__construct()', gf_SYSTEM_LIBS_CORE_PATH.'/access/'.gfConfigFW::getConfig('use_access').'/gfAccessRole_'.gfConfigFW::getConfig('use_access').'.php', array('infile' => __FILE__, 'inline' => __LINE__));
	}
	
	public function AccessControlList() {
		return $this -> _oAccessCL;
	}
	
	public function addAccessRole() {
		$this -> _aAccessRole[] = gfRunner::registerClass('gfAccessRole_'.gfConfigFW::getConfig('use_access').'', 'object', '__construct()', gf_SYSTEM_LIBS_CORE_PATH.'/access/'.gfConfigFW::getConfig('use_access').'/gfAccessRole_'.gfConfigFW::getConfig('use_access').'.php', array('infile' => __FILE__, 'inline' => __LINE__));
		return end($this -> _aAccessRole);
	}
	
}
?>