<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class CurrentSeasonYearResultModeApi {

  const INVALID_RESPONSE = 0;
  const VALID_RESPONSE = 1;
}

class CurrentSeasonYearApi extends FantasyFootballApi {
  
  const METHOD_NAME = "CurrentSeason";

  protected function validateAndCacheResponse($response) {
    if (!is_numeric($response)) {
      $this->resultMode = CurrentSeasonYearResultModeApi::INVALID_RESPONSE;
      return false;   
    }

    $this->resultMode = CurrentSeasonYearResultModeApi::VALID_RESPONSE;
    return true;
  }

  protected function genUrlSuffix() {
    return self::METHOD_NAME;
  }

  public function getCurrentSeasonYear() {
    return $this->currentSeasonYear;
  }
}
