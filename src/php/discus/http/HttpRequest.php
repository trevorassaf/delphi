<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../Request.php");

abstract class HttpRequestMethod {
  const GET = "GET";
  const POST = "POST";
}

class HttpRequest extends Request {

  public function __construct($url, $params) {
    parent::__construct(RequestType::HTTP, $url, $params);
  }
}

class HttpRequestBuilder {

  const CONTENT = "content";
  const METHOD = "method";
  const HEADER = "heder";
  const USER_AGENT = "user_agent";
  const PROXY = "proxy";
  const REQUEST_FULLURI = "request_fulluri";
  const FOLLOW_LOCATION = "follow_location";
  const MAX_REDIRECTS = "max_redirects";
  const PROTOCOL_VERSION = "protocol_version";
  const TIMEOUT = "timeout";
  const IGNORE_ERRORS = "ignore_errors";

  protected
    $method,
    $header,
    $userAgent,
    $content,
    $proxy,
    $requestFulluri,
    $followLocation,
    $maxRedirects,
    $protocolVersion,
    $timeout,
    $ignoreErrors,
    $url;

  public function build() {
    $params = $this->genParams();
    return new HttpRequest($this->url, $params);
  }

  protected function genParamsWithContent() {
    $params = $this->genParams();
    if (isset($this->content)) {
      $params[self::CONTENT] = http_build_query($this->content);
    }
    return $params;
  }

  protected function genParams() {
    // Configure http params
    $params = array();
    if (isset($this->method)) {
      $params[self::METHOD] = $this->method;
    }

    if (isset($this->header)) {
      $params[self::HEADER] = $this->header;
    }

    if (isset($this->userAgent)) {
      $params[self::USER_AGENT] = $this->agent;
    }

    if (isset($this->userAgent)) {
      $params[self::PROXY] = $this->proxy;
    }

    if (isset($this->requestFulluri)) {
      $params[self::REQUEST_FULLURI] = $this->requestFulluri;
    }

    if (isset($this->followLocation)) {
      $params[self::FOLLOW_LOCATION] = $this->followLocation;
    }

    if (isset($this->maxRedirects)) {
      $params[self::MAX_REDIRECTS] = $this->maxRedirects;
    }

    if (isset($this->protocolVersion)) {
      $params[self::PROTOCOL_VERSION] = $this->protocolVersion;
    }

    if (isset($this->timeout)) {
      $params[self::TIMEOUT] = $this->timeout;
    }

    if (isset($this->ignoreErrors)) {
      $params[self::IGNORE_ERRORS] = $this->ignoreErrors;
    }
    
    return $params;  
  }

  // -- PUBLIC FUNCTIONS
  public function setMethod($method) {
    $this->method = $method;
    return $this;
  }

  public function setHeader($header) {
    $this->header = $header;
    return $this;
  }

  public function userAgent($user_agent) {
    $this->userAgent = $user_agent;
    return $this;
  }

  public function setProxy($proxy) {
    $this->proxy = $proxy;
    return $this;
  }

  public function setContent($content) {
    $this->content = $content;
    return $this;
  }

  public function setContentParam($key, $value) {
    if (!isset($this->content)) {
      $this->content = array();
    }

    $this->content[$key] = $value;
    return $this;
  }

  public function isContentParamSet($key) {
    if (!isset($this->content)) {
      $this->content = array();
    }

    return isset($this->content[$key]);
  }

  public function getContentParam($key) {
    if (!$this->isContentParamSet($key)) {
      throw new Exception("content param is not set: key: {$key}");
    }

    return $this->content[$key];
  }

  public function deleteContentParam($key) {
    if (!$this->isContentParamSet($key)) {
      throw new Exception("content param is not set: key: {$key}");
    }
    
    unset($this->content[$key]); 
  }

  public function setRequestFulluri($requestFulluri) {
    $this->requestFulluri = $requestFulluri;
    return $this;
  }

  public function setFollowLocation($follow_location) {
    $this->followLocation = $follow_location;
    return $this;
  }

  public function setMaxRedirects($max_redirects) {
    $this->maxRedirects = $max_redirects;
    return $this;
  }

  public function setProtocolVersion($protocolVersion) {
    $this->protocolVersion = $protocolVersion;
    return $this;
  }

  public function setTimeout($timeout) {
    $this->timeout = $timeout;
    return $this;
  }

  public function setIgnoreErrors($ignoreErrors) {
    $this->ignoreErrors = $ignoreErrors;
    return $this;
  }

  public function setUrl($url) {
    $this->url = $url;
    return $this;
  }
}
