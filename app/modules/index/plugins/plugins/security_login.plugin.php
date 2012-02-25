<?php
class security_login implements gfPlugin {
	public function update(gfPluginAble $oPluginAble) {
		if($oPluginAble->getStatus() == 1) {
			echo 'PLUGIN SECURITY_LOGIN!!!!!!!!!!!!<br />';
		}
	}
}