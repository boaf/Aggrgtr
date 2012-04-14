<?php

class Aggrgtr {

    public $plugDir;

    private $data;

    public function __construct() {
        $this->data = array(
            "username" => "gibson",
            "count" => 5,
            "id" => 784615153
        );
        $this->plugDir = dirname( __FILE__ ) . "/plugs/";
    }

    private function buildUrl($url, $opts) {
        for ($i = 1; $i <= sizeof($opts); $i++) {
            $opt = $opts[$i-1];
            $url = str_replace("%$i", $this->data[$opt], $url);
        }
        return $url;
    }

    private function loadPlug($service) {
        $service .= ".json";
        if (file_exists($this->plugDir . $service)) {
            $plug = json_decode( file_get_contents( $this->plugDir . $service ) );
        }

        $url = $this->buildUrl($plug->url, $plug->opts);
        $load = json_decode(file_get_contents($url));
        $html = "";
        for($i = 0; $i < sizeof($load); $i++) {
            foreach ($plug->display as $item) {
                // TODO: Make this grab the value via PHP object
                $val = explode(":", $item->loc);

                if($val[1]) {
                    $val = $load[$i]->$val[0]->$val[1];
                }
                else {
                    $val = $load[$i]->$val[0];
                }

                $html .= str_replace("%0", $val, $item->html) . "<br />\n";
            }
        }

        $html .= "<br />";

        return $html;
    }

    public function getSome($service) {
        $html = $this->loadPlug($service);

        print_r($html);
    }

}

