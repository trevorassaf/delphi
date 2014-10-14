<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../api/fantasy_football_api/TeamsApi.php");
require_once(dirname(__FILE__)."/../access_layer/Team.php");

$api = new TeamsApi(2013, "REG");
$api->process();

$result_array = $api->getResultArray();
$teams = array();
foreach ($result_array as $result) {
  $teams[] = Team::create(
    $result->getName(),
    $result->getFullName(),
    $result->getCity(),
    $result->getKey(),
    $result->getDivision(),
    $result->getConference(),
    $api->getSeasonKey()
  );
}

var_dump($teams);
