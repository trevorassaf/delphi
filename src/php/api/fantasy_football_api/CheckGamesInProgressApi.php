<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class ResponseType {

  const TRUE = "true";
  const FALSE = "false";
}

abstract class CheckIfGameIsInProgressResultMode {

  const INVALID_RESPONSE = 0;
  const VALID_RESPONSE = 1;
}

class CheckIfGameIsInProgressApi extends FantasyFootballApi {

  const METHOD_NAME = "AreAnyGamesInProgress";

  private $areGamesInProgress;

  protected function validateAndCacheResponse($response) {
    switch ($response) {
      case ResponseType::TRUE:
        $this->areGamesInProgress = true;
        break;
      case ResponseType::FALSE:
        $this->areGamesInProgress = false; 
        break;
      default:
        $this->resultMode = CheckIfGameIsInProgressResultMode::INVALID_RESPONSE;
        return false;
    }

    $this->resultMode = checkIfGamesIsInProgressResultMode::VALID_RESPONSE;
    return true;
  }

  protected function genUrlSuffix() {
    return self::METHOD_NAME;
  }

  public function areGamesInProgress() {
    return $this->areGamesInProgress;
  }
}
