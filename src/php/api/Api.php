<?php

// -- DEPENDENCIES

abstract class ApiRequest {

  protected
    $isValidResult,
    $resultMode;

  public function __construct() {
    $this->isValidResponse = false;
    $this->resultMode = null;
  }

  abstract function process();

  public function isValidResponse() {
    return $this->isValidResponse;
  }

  public function getResultMode() {
    return $this->resultMode;
  }
}
