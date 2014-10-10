<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/HttpRequest.php");

class GetRequestBuilder extends HttpRequestBuilder {

  public function build() {
    $this->method = HttpRequestMethod::GET;
    $params = $this->genParams();

    $url = $this->url;
    if (isset($this->content)) {
      $content_string = http_build_query($this->content);
      $url .= "?" . $content_string; 
    }

    return new HttpRequest($url, $params);
  }
}
