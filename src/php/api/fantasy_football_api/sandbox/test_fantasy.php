<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../CheckGamesInProgressApi.php");

$api = new CheckIfGameIsInProgressApi();
$api->process();
var_dump($api->areGamesInProgress());
