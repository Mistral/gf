<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.core.log.gfLog_Abstract
 * 
 */
 
abstract class gfLog_Abstract {

	protected $aInfo;
    
        public function __construct($iId, $sName, $sPath = '', $sFile = '', $iLine = 0, $addon = '') {
            $this->setInfo($iId, $sName, $sPath, $sFile, $iLine, $addon);
        }
	
	public function setId($iId) {
		$this->aInfo['id'] = $iId;
	}
	
	public function setName($sName) {
		$this->aInfo['name'] = $sName;
	}
	
	public function getId() {
		return $this->aInfo['id'];
	}
	
	public function getName() {
		return $this->aInfo['name'];
	}
	
	public function setPath($sPath) {
		$this->aInfo['path'] = $sPath;
	}
	
	public function getPath() {
		return $this->aInfo['path'];
	}
	
	public function setFile($sFile) {
		$this->aInfo['file'] = $sFile;
	}
	
	public function getFile() {
		return $this->aInfo['file'];
	}
	
	public function setLine($iLine) {
		$this->aInfo['line'] = $iLine;
	}
	
	public function getLine() {
		return $this->aInfo['line'];
	}
	
	public function setAddon($addon) {
		$this->aInfo['addon'] = $addon;
	}
	
	public function getAddon() {
		return $this->aInfo['addon'];
	}
	
	public function setInfo($iId, $sName, $sPath = '', $sFile = '', $iLine = 0, $addon = '') {
		$this->setId($iId);
		$this->setName($sName);
		$this->setPath($sPath);
		$this->setFile($sFile);
		$this->setLine($iLine);
		$this->setAddon($addon);
	}
	
	public function getInfo() {
		return $this->aInfo;
	}
	
	
}