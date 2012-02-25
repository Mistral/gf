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

class gfException extends Exception {

	private $iCode;
	private $sMessage;
	private $aSolutions;
	private $sType;

    public function __construct(gfException_Abstract $e) {
        $this -> setCode($e->getCode());
		$this -> setMessage($e->getMessage());
		$this -> addSolutions($e->getSolutions());
		$this -> addSolution('Look at <strong>/docs/errors.txt</strong> to find code error');
		$this -> setType($e->getType());
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
	
		$this->aSolutions[] = $sSolution;
		
		return true;
		
	}
	
	public function getSolutions() {
		$sOutput = '<ul>';
			
		foreach($this->aSolutions as $solution) {
			$sOutput = '<li>'. $solution .'</li>';
		}
		
		$sOutput = '</ul>';
		
		return $sOutput;
	}
    
    public function __toString() {
        return 'Exception <strong>'.$this->sType.'</strong><br />Unexpected error #<font color="red">' . $this -> iCode . '</font>, info about this error: ' . $this -> sMessage . '. This problem may be resolved by doing this ways:<br \> '.$this->getSolutions();
    }

}
?>