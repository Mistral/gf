<?php
class auth_login implements gfPlugin {
	public function update(gfPluginAble $oPluginAble) {
		if($oPluginAble->getStatus() == 2) {
			echo 'PLUGIN AUTH_LOGIN!!!!!!!!!!!!<br />';
		}
	}
}