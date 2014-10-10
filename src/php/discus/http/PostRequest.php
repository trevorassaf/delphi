<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/HttpRequest.php");

class PostRequestBuilder extends HttpRequestBuilder {

  public function build() {
    $this->method = HttpRequestMethod::POST;
    $params = $this->genParamsWithContent();
    return new HttpRequest($this->url, $params);
  }
}
