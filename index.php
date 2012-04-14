<?php

error_reporting(E_ALL);

class Aggrgtr {
    
    private $username = "gibson";
    private $count = 5;
    private $url;
    
    function getUrl() {
        $this->url = "http://twitter.com/statuses/user_timeline/" . $this->username . ".json?count=" . $this->count;
        return $this->url;
    }
    
}

$aggrgtr = new Aggrgtr();
echo $aggrgtr->getUrl();