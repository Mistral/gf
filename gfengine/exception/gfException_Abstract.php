<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec
 * @subpackage gfFW.libs.core.exception.gfException
 * 
 */

abstract class gfException_Abstract {

	protected $iCode;
	protected $sMessage;
	protected $aSolutions;
	protected $sType;

    public function __construct($iCode = '', $sMessage = '', $aSolutions = array(), $sType = '') {
        if($iCode == '') {
		
		} else {
			$this -> setCode($iCode);
			$this -> setMessage($sMessage);
			$this -> addSolutions($aSolutions);
			$this -> setType($sType);
		}
    }
	
	public function setCode($iCode = 000) {
	
		$this -> iCode = $iCode;
		
		return true;
	}
	
	public function setMessage($sMessage) {
	
		$this -> sMessage = $sMessage;
		
		return true;
	}
	
	public function setType($sType) {
	
		$this->sType = $sType;
		
		return true;
	
	}
	
	public function addSolutions($aSolutions) {
	
		$this -> aSolutions = $aSolutions;
		
		return true;
	}
	
	public function addSolution($sSolution) {
	
		$this-> aSolutions[] = $sSolution;
		
		return true;
		
	}
	
	public function getCode() {
		return $this->iCode;
	}
	
	public function getMessage() {
		return $this->sMessage;
	}
	
	public function getType() {
		return $this->sType;
	}
	
	public function getSolutions() {
		return $this->aSolutions;
	}

}
?>