<?php
error_reporting(E_ALL);

include('class.aggrgtr.php');

$aggrgtr = new Aggrgtr();

//Format is "service", "username or ID"
$aggrgtr->getSome("twitter", "gibson");
