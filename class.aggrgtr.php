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

        for ($i = 1; $i <= sizeof($plug->opts); $i++) {
            $opt = $plug->opts[$i-1];
            $plug->url = str_replace("%$i", $this->data[$opt], $plug->url);
        }

        return $plug->url;
    }

}

