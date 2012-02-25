<?php
abstract class gfPluginAble {
	
	protected $_aPlugins = array();
	
	public function addPlugin(gfPlugin $oPlugin) {
		$this -> _aPlugins[] = $oPlugin;
	}
	
	public function loadPlugin($sNamePlugin) {
		$oPlugin = gfRunner::registerClass($sNamePlugin, 'object', '__construct()', gf_SYSTEM_PATH.'/apps/modules/'.gfFW::Router()->getController().'/plugins/plugins/'.$sNamePlugin.'.plugin.php', array('infile' => __FILE__, 'inline' => __LINE__));
		return $oPlugin;
	}
	
	public function delPlugin(gfPlugin $oPlugin) {
		$this -> _aPlugins = array_diff($this -> _aPlugins, array($oPlugin));
	}
	
	public function enable() {
		foreach($this -> _aPlugins as $oPlugin) {
			$oPlugin -> update($this);
		}
	}
}
//gfPluginAble::addPlugin(gfPluginAble::loadPlugin('pluginek'));
?>