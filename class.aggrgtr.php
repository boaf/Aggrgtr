<?php
error_reporting(E_ALL);

class Aggrgtr {

    public $plugDir = dirname( __FILE__ ) . "/plugs/";

    private $username;
    private $count;
    private $url;

    function loadPlug($plugName) {
        $plugName .= ".json";
        if( file_exiss( $this->plugDir . $plugName ) {
            $load = json_decode( file_get_contents( $this->plugDir . $plugName ) );
        }
        return $load;
    }

    function getUrl() {
        $this->url = "http://twitter.com/statuses/user_timeline/" . $this->username . ".json?count=" . $this->count;
        return $this->url;
    }

}

