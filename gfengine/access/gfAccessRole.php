<?php
abstract class gfAccessRole {
	abstract public function __construct();
	abstract public function setName($sName);
	abstract public function allow($mModule, $mAction);
	abstract public function allowId($iId);
	abstract public function disallow($mModule, $mAction);
	abstract public function disallowId($iId);
}
?>