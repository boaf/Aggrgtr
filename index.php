<?php
error_reporting(E_ALL);

include('class.aggrgtr.php');

$aggrgtr = new Aggrgtr();
//echo $aggrgtr->getUrl();
var_dump( $aggrgtr->buildUrl( "twitter" ) );
