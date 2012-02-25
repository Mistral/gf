<?php
class gfEvent {

    private $events;

    public function add($event, $params) {
        $this->events[$event] = $params;
    }

    public function exist($event) {
        if(isset($this->events[$event])) {
            return true;
        }
        return false;
    }

    public function get($event) {
        if(isset($this->events[$event])) {
            return $this->events[$event];
        }
        return false;
    }

}
?>
