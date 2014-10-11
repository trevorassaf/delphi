<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/ApiRequest.php");

abstract class OutgointApiReq extends ApiRequest {

  private $request;

  public function __construct($request) {
    parent::__construct();
    $this->request = $request;
  }

  public function process() {
    // Perform request and process response
    $response = $this->request->execute();    
    $this->validateResponse($response);
    $this->cacheResponseData($response);
  }

  protected abstract function validateResponse($response);

  protected abstract cacheResponseData($response);
}
