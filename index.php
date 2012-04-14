<?php

include('class.aggrgtr.php');

$aggrgtr = new Aggrgtr();
//echo $aggrgtr->getUrl();
print_r( $aggrgtr->loadPlug( "twitter" ) );
