<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../api/fantasy_football_api/CurrentWeekApi.php");
require_once(dirname(__FILE__)."/../api/fantasy_football_api/CurrentSeasonYearApi.php");
require_once(dirname(__FILE__)."/../api/fantasy_football_api/TeamsApi.php");
require_once(dirname(__FILE__)."/../api/fantasy_football_api/SchedulesApi.php");
require_once(dirname(__FILE__)."/../access_layer/SeasonAdminInfo.php");
require_once(dirname(__FILE__)."/../access_layer/Team.php");
require_once(dirname(__FILE__)."/../access_layer/Game.php");

// -- FUNCTIONS
function updateSeasonConfiguration($current_week, $current_year) {
  $season_info = SeasonAdminInfo::fetchMostRecentSeasonInfo(); 
  
  // Insert new record
  if ($season_info == null || $season_info->getCurrentWeek() != $current_week || 
      $season_info->getCurrentYear() != $current_year) {
    $season_info = SeasonAdminInfo::create($current_week, $current_year);
    updateTeams($season_info->getSeasonKey());
    updateGameSchedule($season_info->getSeasonKey());
    return;
  }

  // Update timestamp for existing season-admin-info
  $season_info->save();
}

function updateGameSchedule($seasonKey) {
  $api = new SchedulesApi($seasonKey);
  $api->process();
  $result_array = $api->getResultArray();
  $games = array();
  $timestamp = explode("-", $result_array[0]->getDate()); 
  $timestamp = $timestamp[0];
  var_dump($timestamp);
  $date_format = date('Y-m-d G:i:s', (int)$timestamp);
  var_dump($date_format);
  foreach ($result_array as $result) {
    $timestamp = explode("-", $result->getDate());
    $date_format = date('Y-m-d G:i:s', (int)($timestamp[0]));
    $games[] = Game::create(
      $date_format,
      $result->getHomeTeamKey(),
      $result->getAwayTeamKey(),
      0,
      0,
      0,
      GameStatus::SCHEDULED,
      0,
      $seasonKey
    );
  }
  
  var_dump($games);
}

function updateTeams($season_key) {
  $api = new TeamsApi($season_key); 
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

  // var_dump($teams);
}

function fetchInfoAndUpdateSeasonConfiguration() {
  $current_week_api = new CurrentWeekApi();
  $current_week_api->process();
  $current_week = $current_week_api->getCurrentWeek();

  $current_year_api = new CurrentSeasonYearApi();
  $current_year_api->process();
  $current_year = $current_year_api->getCurrentSeasonYear();

  updateSeasonConfiguration($current_week, $current_year);
}

function main() {
  fetchInfoAndUpdateSeasonConfiguration();
}

// -- MAIN
main();
