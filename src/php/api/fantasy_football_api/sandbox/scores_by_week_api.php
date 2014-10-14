<?php

require_once(dirname(__FILE__)."/../ScoresByWeekApi.php");

$api = new ScoresByWeekApi(1, 2012, "REG"); 
$api->process();
var_dump($api->getResultArray());
