<?php

// -- DEPENDENCIES

abstract class ApiRequest {

  private
    $isValidResult,
    $resultMode;

  public function __construct() {
    $this->isValidResult = false;
    $this->resultMode = null;
  }

  abstract function process();

  public function isValidResult() {
    return $this->isValidResult;
  }

  public function getResultMode() {
    return $this->resultMode;
  }
}
