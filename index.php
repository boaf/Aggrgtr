<?php
error_reporting(E_ALL);

include('class.aggrgtr.php');

$aggrgtr = new Aggrgtr();
var_dump($aggrgtr->buildUrl("twitter"));