<?php

class Aggrgtr {

    public $plugDir;

    private $data;

    function __construct() {
        $this->data = array(
            "username" => "gibson",
            "count" => 5
        );
        $this->plugDir = dirname( __FILE__ ) . "/plugs/";
    }

    private function loadPlug($service) {
        $service .= ".json";
        if (file_exists($this->plugDir . $service)) {
            $load = json_decode( file_get_contents( $this->plugDir . $service ) );
        }
        return $load;
    }

    public function buildUrl($service) {
        $plug = $this->loadPlug($service);
        foreach($plug->opts as $opt => $val) {
            $plug->url = preg_replace('$'.$opt, (string)$this->data[$val], $plug->url);
        }
        // // "http://twitter.com/statuses/user_timeline/" . $this->username . ".json?count=" . $this->count;
        return $plug->url;
    }

}

