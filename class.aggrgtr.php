<?php

class Aggrgtr {

    public $plugDir;

    private $data;

    public function __construct() {
        $this->data = array(
            "username" => "",
            "count" => 5, // Makes the default resultset a set of 5.
            "id" => 0
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

        if( strstr( $url , "rss" ) ) $load = $this->XMLtoJSON( $url );
        else $load = json_decode(file_get_contents($url));
        $html = "";

        for($i = 0; $i < sizeof($load); $i++) {
            foreach ($plug->display as $item) {
                // TODO: Make this grab the value via PHP object
                $val = explode(":", $item->loc);

                if($val[2]) {
                    $val = $load[$i]->$val[0]->$val[1]->$val[2];
                }

                if($val[1]) {
                    $val = $load[$i]->$val[0]->$val[1];
                }
                else {
                    $val = $load[$i]->$val[0];
                }

                echo $val;

                $html .= str_replace("%0", $val, $item->html) . "<br />\n";
            }
        }

        $html .= "<br />";

        return $html;
    }

    function XMLtoJSON($source) {
        $rss = file_get_contents( $source );
        $rss = str_replace( array( "\n", "\r", "\t" ), '', $rss );
        $rss = trim( str_replace( '"', "'", $rss ) );
        $load = simplexml_load_string( $rss );
        $json = json_encode( $load );

//        print_r($json);

        return $json;
    }

    public function getSome($service, $userOrID) {
        // This kills me. Fuck. Bad tenach, bad.
        if( is_int( $userOrID ) ) $this->data['id'] = $userOrID;
        else $this->data['username'] = $userOrID;
        $html = $this->loadPlug($service);

        echo $html;
    }

}

