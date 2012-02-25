<?php
if(!defined('gf_PATH')) {
    die('No script access');
}
/**
 * @version 2.0
 * @author Dawid Stec - Mistral
 * @subpackage gfFW.gfengine.gf
 * 
 */
class gf {

    private static $instance = NULL;

    private static $controller;

    private static $db;

    public static $router;

    public static $request;

    public static $event;
    
    private function __construct() {

        require_once(gf_CORE_PATH.'/gfRequest.php');
        require_once(gf_CORE_PATH.'/gfEvent.php');
        require_once(gf_CORE_PATH.'/gfRouter.php');
        
        self::$request = new gfRequest($_POST, $_GET, $_FILES, $_SESSION, $_COOKIE, $_SERVER);
        self::$event = new gfEvent();
    	self::$router = new gfRouter(self::$request->getGet());
    	
    }

    public static function init() {
        if(self::$instance === NULL) {
            self::$instance = new gf();
        }
        return self::$instance;
    }
    
    public static function run() {
        
       require_once(gf_CORE_PATH.'/gfDispatcher.php');

       $dispatcher = new gfDispatcher(self::$router);
        
    }
}
?>