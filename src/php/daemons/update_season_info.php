<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../api/fanasy_football_api/CurrentWeekApi.php");
require_once(dirname(__FILE__)."/../api/fanasy_football_api/CurrentSeasonYearApi.php");
require_once(dirname(__FILE__)."/../access_layer/SeasonAdminInfo.php");

// -- FUNCTIONS
function updateSeasonConfiguration($current_week, $current_year) {
  $season_info = SeasonAdminInfo::fetch(); 
  $season_info->setCurrentWeek($current_week);
  $season_info->setCurrentYear($current_year);
  $season_info->save();
}

function fetchInfoAndUpdateSeasonConfiguration() {
  $current_week_api = new CurrentWeekApi();
  $current_week_api->process();
  $current_week = $current_week_api->getCurrentWeek();

  $current_year_api = new CurrentSeasonYearApi();
  $current_year_api->process();
  $current_year = $current_year_api->getCurrentSeasonYear();

  $update_time = date('Y-m-d H:i:s');

  updateSeasonConfiguration($current_week, $current_year, $update_time);
}

function main() {
  fetchInfoAndUpdateSeasonConfiguration();
}

// -- MAIN
main();
