<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/ApiRequest.php");

abstract class IncommingApiReq extends ApiRequest {

  public function process() {
    $this->isValidResult = $this->validateRequest();      
    $this->cacheRequestParameters();
  }

  protected abstract function validateRequest();

  protected abstract function cacheRequestParameters();
}
