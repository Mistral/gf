<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 1.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gf
 * 
 */
class gf {

    private static $instance = NULL;

    public static $router;

    public static $request;

    public static $cookie;
    
    private function __construct() {

        require_once(gf_CORE_PATH.'/gfRequest.php');
        require_once(gf_CORE_PATH.'/gfEvent.php');
        require_once(gf_CORE_PATH.'/gfRouter.php');
        
        self::$request = new gfRequest($_POST, $_GET, $_FILES, $_SESSION, $_COOKIE, $_SERVER);
    	self::$router = new gfRouter(self::$request->getGet());
    	
    }

    public static function init() {
        if(self::$instance === NULL) {
            self::$instance = new gf();
        }
        return self::$instance;
    }

    public static function router() {
        return self::$router;
    }

    public static function request() {
        return self::$request;
    }

    public static function event() {
        return self::$request;
    }

    public static function cookie() {
        return self::$cookie;
    }
    
    public static function run() {
        
       require_once(gf_CORE_PATH.'/gfDispatcher.php');

       $dispatcher = new gfDispatcher(self::$router);
        
    }
}
?>