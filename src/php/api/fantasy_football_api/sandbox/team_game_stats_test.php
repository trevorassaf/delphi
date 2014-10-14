<?php

require_once(dirname(__FILE__)."/../TeamGameStatsApi.php");

$api = new TeamGameStatsApi(1, 2012, "REG"); 
$api->process();
