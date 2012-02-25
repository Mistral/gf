<?php
class login extends gfPluginAble {
	
	private $iStatus;
	
	public function setStatus($iStatus) {
		$this->iStatus = $iStatus;
	}
	
	public function check() {
		$this->enable();
	}
	
	public function getStatus() {
		return $this->iStatus;
	}
	
}