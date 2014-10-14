<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class CurrentWeekResultMode {

  const INVALID_RESPONSE = 0;
  const WEEK_NUMBER_OUT_OF_RANGE = 1;
  const VALID_RESPONSE = 2;
}

class CurrentWeekApi extends FantasyFootballApi {

  const METHOD_NAME = "CurrentWeek";

  const MIN_WEEK_NUM = 1;
  const MAX_REGULAR_SEASON_WEEK_NUM = 17;
  const MAX_WEEK_NUM = 21;

  private 
    $weekNum,
    $isRegularSeason;

  protected function validateAndCacheResponse($response) {
    if (!is_numeric($response)) {
      $this->resultMode = CurrentWeekResultModeApi::INVALID_RESPONSE;
      return false;   
    }

    $this->weekNum = (int)$response;

    if (self::MIN_WEEK_NUM > $this->weekNum || self::MAX_WEEK_NUM < $this->weekNum) {
      $this->resultMode = CurrentWeekResultMode::WEEK_NUMBER_OUT_OF_RANGE;
      return false;
    }

    $this->resultMode = VALID_RESPONSE;
    $this->isRegularSeason = $this->weekNum > self::MAX_REGULAR_SEASON_WEEK_NUM;
  }

  protected abstract function genUrlSuffix() {
    return self::METHOD_NAME;
  }

  public function getCurrentWeek() {
    return $this->weekNum;
  }
}
