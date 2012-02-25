<?php
class gfEvent {
    
    private static $events;
    private static $libs;

    public static function add($event, $params) {
        self::$events[$event] = $params;
    }

    public static function exist($event) {
        if(isset(self::$events[$event])) {
            return true;
        }
        return false;
    }

    public static function get($event) {
        if(isset(self::$events[$event])) {
            return self::$events[$event];
        }
        return false;
    }

    public static function addLib($lib) {
        self::$libs[] = $lib;
    }

    public static function isLib($lib) {
        if(in_array($lib, self::$libs)) {
            return true;
        }
        return false;
    }

}
?>
