<?php
error_reporting(E_ALL);

class Aggrgtr {

    private $username;
    private $count;
    private $url;

    function loadPlug($plugName) {
        $load = file_get_contents($plug_dir . $plugname . '.json');
    }

    function getUrl() {
        $this->url = "http://twitter.com/statuses/user_timeline/" . $this->username . ".json?count=" . $this->count;
        return $this->url;
    }

}

