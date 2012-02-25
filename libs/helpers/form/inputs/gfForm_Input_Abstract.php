<?php
if(!defined('gf_SYSTEM_PATH')) {
    die('No script access');
}
/**
 * @version 0.4
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.libs.libraries.helpers.form.inputs.gfForm_Input_Abstract
 * 
 */
    
abstract class xfForm_Input_Abstract {
	
	const TEXT 		= 'text';
	const PASSWORD 	= 'password';
	const TEXTAREA 	= 'textarea';
	const SELECT 	= 'select';
	const CHECKBOX 	= 'checkbox';
	const BUTTON 	= 'button';
	const SUBMIT	= 'submit';
	const RESET 	= 'reset';
	const FILE 		= 'file';
	
	protected $_aCode = array();
	
	public function setName($sNameOfInput) {
		$this -> _aCode['name'] = trim($sNameOfInput);
	}
	
	public function setId($sId) {
		$this -> _aCode['id'] = trim($sId);
	}
	
	public function setClass($sNameClass) {
		$this -> _aCode['class'] = trim($sNameClass);
	}
	
	public function setDesc($sDesc) {
		$this -> _aCode['desc'] = trim($sDesc);
	}
	
	public function addStyle($sStyle) {
		$this -> _aCode['style'] = $sStyle;
	}
	
	public function addEvent($sEventsName, $do) {
		$this -> _aCode['event'] = array($sEventsName => $do);
	}
	
	abstract public function build();
	
	public function addType($cType) {
		$this -> _aCode['type'] = $cType;
	}
	
	
}