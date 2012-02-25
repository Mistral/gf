<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gfRequest
 * 
 */

class gfRequest {
	
    private $request = array('post' 	=> array(),
                            'get'  	=> array(),
                            'files' 	=> array(),
                            'session' 	=> array(),
			    'cookie' 	=> array(),
			    'server' 	=> array()
                            );
	
    public function __construct($post, $get, $files, $session, $cookie, $server) {
		
	$this->setPost($post);
	$this->setGet($get);
	$this->setFiles($files);
	$this->setSession($session);
	$this->setCookie($cookie);
	$this->setServer($server);
		
	return true;
    }
	
    private function setPost($post) {
	$this->request['post'] =  $post;
    }
	
    private function setGet($get) {
	$this->request['get'] = $get;
    }
	
    private function setFiles($files) {
	$this->request['files'] = $files;
    }
	
    private function setSession($session) {
	$this->request['session'] = $session;
    }
	
    private function setCookie($cookie) {
	$this->request['cookie'] = $cookie;
    }
	
    private function setServer($server) {
	$this->request['server'] = $server;
    }
	
    public function getPost() {
	return $this->request['post'];
    }
	
    public function getGet() {
    	return $this->request['get'];
    }
	
    public function getFiles() {
	return $this->request['files'];
    }
	
    public function getSession() {
	return $this->request['session'];
    }
	
    public function getCookie() {
	return $this->request['cookie'];
    }
	
    public function getServer() {
	return $this->request['server'];
    }
	
    public function getVarGet($key) {
	return $this->request['get'][$key];
    }
    
    public function getVarPost($key) {
	return $this->request['post'][$key];
    }
	
    public function getReferer() {
	if($this->request['server']['HTTP_REFERER']) {
            return $this->request['server']['HTTP_REFERER'];
	}
    }
	
    public function getIp() {
	if($this->request['server']['REMOTE_ADDR']) {
            return $this->request['server']['REMOTE_ADDR'];
	}
    }
	
    public function getBrowser() {
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
	$platform = 'Unknown';
	$version= '';
	
	if (preg_match('/linux/i', $u_agent)) {
	    $platform = 'linux';
	} elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	    $platform = 'mac';
	} elseif (preg_match('/windows|win32/i', $u_agent)) {
	    $platform = 'windows';
	}
	    
	if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
	    $bname = 'Internet Explorer'; 
	    $ub = 'MSIE'; 
	} elseif(preg_match('/Firefox/i',$u_agent)) { 
	    $bname = 'Mozilla Firefox'; 
	    $ub = 'Firefox'; 
	} elseif(preg_match('/Chrome/i',$u_agent)) { 
	    $bname = 'Google Chrome'; 
	    $ub = 'Chrome'; 
	} elseif(preg_match('/Safari/i',$u_agent)) { 
	    $bname = 'Apple Safari'; 
	    $ub = 'Safari'; 
	} elseif(preg_match('/Opera/i',$u_agent)) { 
	    $bname = 'Opera'; 
	    $ub = 'Opera'; 
	} elseif(preg_match('/Netscape/i',$u_agent)) { 
	    $bname = 'Netscape'; 
	    $ub = 'Netscape'; 
	} 
	    
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {

	}

	$i = count($matches['browser']);
	    
	if ($i != 1) {
	    if (strripos($u_agent, 'version') < strripos($u_agent, $ub)) {
	        $version = $matches['version'][0];
	    } else {
	        $version = $matches['version'][1];
            }
	} else {
	    $version= $matches['version'][0];
        }
	    
	if ($version == NULL || $version == '') {
            $version = 'unknown';
	}
	    
	return array(
	    'userAgent' => $u_agent,
	    'name'      => $bname,
	    'version'   => $version,
	    'platform'  => $platform,
            'pattern'   => $pattern
        );
    }
	
    public function getMethod() {
	if($this->request['server']['REQUEST_METHOD']) {
            return $this->request['server']['REQUEST_METHOD'];
	}
    }
	
    public function getServerName() {
	if($this->request['server']['SERVER_NAME']) {
            return $this->request['server']['SERVER_NAME'];
	}
    }
	
    public function getArguments() {
	if($this->request['server']['argv']) {
            return $this->request['server']['argv'];
	}
    }
	
    public function isAjaxRequest() {		
	if($this->request['server']['HTTP_X_REQUESTED_WITH']) {
            if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {				
		return true;				
            }			
	}
	return false;
    }
	
}