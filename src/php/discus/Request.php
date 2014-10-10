<?php

abstract class RequestType {

  const HTTP = "http";
  const HTTPS = "https";
}

class Request {
  
  private
    $type,
    $url,
    $params;

  public function __construct($type, $url, $params) {
    $this->type = $type;
    $this->url = $url;
    $this->params = $params;
  }

  /**
  * Execute request and return result.
  *
  * @return string : request result
  */
  public function execute() {
    $context_options = array(
      $this->type => $this->params, 
    );
    $request_context = stream_context_create($context_options);
    return file_get_contents($this->url, null, $request_context);
  }
}

class RequestBuilder {

  protected
    $type,
    $url,
    $params;

  public function build() {
    return new Request($type, $url, $params);
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function setParams($params) {
    $this->params = $params;
  }
}
