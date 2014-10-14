<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class SchedulesResultMode {

  const INVALID_RESP = 0;
  const SUCCESSFUL_RESP = 1;
}

final class SchedulesResult {

  const AWAY_TEAM = "AwayTeam";
  const DATE = "Date";
  const HOME_TEAM = "HomeTeam";
  const SEASON = "Season";
  const WEEK = "Week";
  const POINT_SPREAD = "PointSpread";
  const OVER_UNDER = "OverUnder";

  private
    $awayTeam,
    $date,
    $homeTeam,
    $season,
    $week,
    $pointSpread,
    $overUnder;

  public static function createFromJsonString($json_str) {
    $result_array = json_decode($json_str, true);
    if ($result_array == null) {
      throw new Exception("invalid scores-by-week-result");
    }

    $result_struct_array = array();
    foreach ($result_array as $result) {
      $result_struct_array[] = self::createFromArray($result); 
    }

    return $result_struct_array;
  }

  public static function createFromArray($result_array) {
    return new self(
      $result_array[self::AWAY_TEAM],
      $result_array[self::DATE],
      $result_array[self::HOME_TEAM],
      $result_array[self::SEASON],
      $result_array[self::WEEK],
      $result_array[self::POINT_SPREAD],
      $result_array[self::OVER_UNDER]
    );
  } 

  private function __construct(
      $away_team,
      $date,
      $home_team,
      $season,
      $week,
      $point_spread,
      $over_under) {
    $this->awayTeam = $away_team;
    $this->date = $date;
    $this->homeTeam = $home_team;
    $this->season = $season;
    $this->week = $week;
    $this->pointSpread = $point_spread;
    $this->overUnder = $over_under;
  }

  public function getAwayTeam() {
    return $this->awayTeam;
  }

  public function getDate() {
    return $this->date;
  }  

  public function getHomeTeam() {
    return $this->homeTeam;
  }

  public function getSeason() {
    return $this->season;
  }

  public function getWeek() {
    return $this->week;
  }

  public function getPointSpread() {
    return $this->pointSpread;
  }

  public function getOverUnder() {
    return $this->overUnder;
  }
}

class SchedulesApi extends FantasyFootballApi {

  const METHOD_NAME = "Schedules";

  private
    $yearNum,
    $seasonSuffix,
    $resultArray;

  public function __construct($year_num, $season_suffix) {
    $this->yearNum = $year_num;
    $this->seasonSuffix = $season_suffix;    
    parent::__construct();
  }

  protected function validateAndCacheResponse($response) {
    try {
      $this->resultArray = SchedulesResult::createFromJsonString($response);
    } catch (Exception $e) {
      $this->resultMode = SchedulesResultMode::SUCCESSFUL_RESP;
      return false;
    }

    $this->resultMode = SchedulesResultMode::SUCCESSFUL_RESP;
    return true;
  }

  protected function genUrlSuffix() {
    $year_season_str = 
        FantasyFootballApi::genSeasonQueryString(
          $this->yearNum, $this->seasonSuffix);
    return self::METHOD_NAME . "/" . $year_season_str;
  }

  public function getResultArray() {
    return $this->resultArray;
  }
}
