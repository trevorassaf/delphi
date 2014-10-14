<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class ScoresByWeekResultMode {

  const SUCCESSFUL_RESP = 0;
  const INVALID_RESP = 1;
}

final class ScoresByWeekResult {

  const AWAY_SCORE = "AwayScore";
  const AWAY_TEAM = "AwayTeam";
  const HOME_SCORE = "HomeScore";
  const HOME_TEAM = "HomeTeam";
  const GAME_KEY = "GameKey";
  const HAS_STARTED = "HasStarted";
  const IS_IN_PROGRESS = "IsInProgress";
  const IS_OVERTIME = "IsOvertime";
  const IS_OVER = "IsOver";
  const TIME_REMAINING = "TimeRemaining";
  const WEEK = "Week";

  private
    $awayScore,
    $awayTeam,
    $homeScore,
    $homeTeam,
    $gameKey,
    $hasStarted,
    $isInProgress,
    $isOvertime,
    $isOver,
    $timeRemaining,
    $week;

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
      $result_array[self::AWAY_SCORE],
      $result_array[self::AWAY_TEAM],
      $result_array[self::HOME_SCORE],
      $result_array[self::HOME_TEAM],
      $result_array[self::GAME_KEY],
      $result_array[self::HAS_STARTED],
      $result_array[self::IS_IN_PROGRESS],
      $result_array[self::IS_OVERTIME],
      $result_array[self::IS_OVER],
      $result_array[self::TIME_REMAINING],
      $result_array[self::WEEK]
    ); 
  }

  public function __construct(
      $away_score,
      $away_team,
      $home_score,
      $home_team,
      $game_key,
      $has_started,
      $is_in_progress,
      $is_overtime,
      $is_over,
      $time_remaining,
      $week) {
    $this->awayScore = $away_score;
    $this->awayTeam = $away_team;
    $this->homeScore = $home_score;
    $this->homeTeam = $home_team;
    $this->gameKey = $game_key;
    $this->hasStarted = $has_started;
    $this->isInProgress = $is_in_progress;
    $this->isOvertime = $is_overtime;
    $this->isOver = $is_over;
    $this->timeRemaining = $time_remaining;
    $this->week = $week;
  }

  public function getAwayScore() {
    return $this->awayScore;
  }

  public function getAwayTeam() {
    return $this->awayTeam;
  }

  public function getHomeScore() {
    return $this->homeScore;
  }

  public function getHomeTeam() {
    return $this->homeTeam;
  }

  public function getGameKey() {
    return $this->gameKey;
  }

  public function getHasStarted() {
    return $this->hasStarted;
  }

  public function isInProgress() {
    return $this->isInProgress;
  }

  public function isOver() {
    return $this->isOver;
  }

  public function isOvertime() {
    return $this->isOvertime;
  }

  public function getWeek() {
    return $this->week;
  }

  public function getTimeRemaining() {
    return $this->timeRemaining;
  }
}

class ScoresByWeekApi extends FantasyFootballApi {

  const METHOD_NAME = "ScoresByWeek";


  private
    $weekNum,
    $yearNum,
    $seasonSuffix,
    $resultArray;

  public function __construct($week_num, $year_num, $season_suffix) {
    // Check valid week num
    if (!FantasyFootballApi::isValidWeekNum($week_num, $season_suffix)) {
      throw new Exception("invalid week-num/season-suffix combination");
    }

    $this->weekNum = $week_num;
    $this->yearNum = $year_num;
    $this->seasonSuffix = $season_suffix;    
    parent::__construct();
  }

  protected function validateAndCacheResponse($response) {
    try {
      $this->resultArray = ScoresByWeekResult::createFromJsonString($response); 
    } catch (Exception $e) {
      $this->resultMode = ScoresByWeekResultMode::INVALID_RESP;
      return false;
    }

    $this->resultMode = ScoresByWeekResultMode::SUCCESSFUL_RESP;
    return true;
  }

  protected function genUrlSuffix() {
    $year_season_str = 
        FantasyFootballApi::genSeasonQueryString(
            $this->yearNum, $this->seasonSuffix);
    return self::METHOD_NAME . "/" . $year_season_str . "/" . $this->weekNum;
  }

  public function getResultArray() {
    return $this->resultArray;
  }

}
