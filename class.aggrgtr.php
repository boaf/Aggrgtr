<?php
error_reporting(E_ALL);

class Aggrgtr {

    private $username;
    private $count;
    private $url;

    function loadPluginInfo($jsonProperties) {

    }

    function getUrl() {
        $this->url = "http://twitter.com/statuses/user_timeline/" . $this->username . ".json?count=" . $this->count;
        return $this->url;
    }

}

