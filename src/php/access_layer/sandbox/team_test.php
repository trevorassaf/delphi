<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../Team.php");

$team = Team::create(
  "49\'ers",
  "San Franciso",
  "SF",
  "California"
);

var_dump($team);
$team->delete();
