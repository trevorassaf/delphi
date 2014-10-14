<?php

require_once(dirname(__FILE__)."/../SchedulesApi.php");

$api = new SchedulesApi(2012, "REG");
$api->process();
var_dump($api->getResultArray());
