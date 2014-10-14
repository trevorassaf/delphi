<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../OutgoingApiReq.php");
require_once(dirname(__FILE__)."/../../discus/http/GetRequest.php");

abstract class ResponseFormat {
  const XML = "XML";
  const JSON = "JSON";
}

abstract class FantasyFootballApi extends OutgoingApiReq {

  // -- CLASS CONSTANTS
  const APIKEY_VALUE = "94134631-49C0-4079-A011-EC727A676638";
  const APIKEY_KEY = "key";
  const FANTASY_API_URL = "http://api.nfldata.apiphany.com/trial/";

  const PRE_SEASON_QUERY_SUFFIX = "PRE";
  const REGULAR_SEASON_QUERY_SUFFIX = "REG";
  const POST_SEASON_QUERY_SUFFIX = "POST";

  const PRESEASON_WEEK_MIN = 0;
  const PRESEASON_WEEK_MAX = 4;
  const REGULAR_SEASON_WEEK_MIN = 1;
  const REGULAR_SEASON_WEEK_MAX = 17;
  const POST_SEASON_WEEK_MIN = 1;
  const POST_SEASON_WEEK_MAX = 4;

  /**
   * Format of response.
   */
  private static $FORMAT = ResponseFormat::JSON;

  public static function genRegularSeasonQueryString($year_num) {
    return self::genSeasonQueryString($year_num, self::REGULAR_SEASON_QUERY_SUFFIX);
  }

  public static function genPreSeasonQueryString($year_num) {
    return self::genSeasonQueryString($year_num, self::PRE_SEASON_QUERY_SUFFIX);
  }

  public static function genPostSeasonQueryString($year_num) {
    return self::genSeasonQueryString($year_num, self::POST_SEASON_QUERY_SUFFIX);
  }

  public static function genSeasonQueryString($year_num, $season_str) {
    return "{$year_num}$season_str";
  }

  public function isValidWeekNum($week_num, $season_suffix) {
    switch ($season_suffix) {
      case FantasyFootballApi::PRE_SEASON_QUERY_SUFFIX:
        return $week_num >= self::PRESEASON_WEEK_MIN && $week_num <= self::PRESEASON_WEEK_MAX;
      case FantasyFootballApi::REGULAR_SEASON_QUERY_SUFFIX:
        return $week_num >= self::REGULAR_SEASON_WEEK_MIN && $week_num <= self::REGULAR_SEASON_WEEK_MAX;
      case FantasyFootballApi::POST_SEASON_QUERY_SUFFIX:
        return $week_num >= self::POST_SEASON_WEEK_MIN && $week_num <= self::POST_SEASON_WEEK_MAX;
      default:
        return false;  
    }
  }

  public function __construct() {
    $url = self::FANTASY_API_URL . self::$FORMAT . "/" . $this->genUrlSuffix();
    $request_builder = new GetRequestBuilder();
    $request_builder->setUrl($url);
    $request_builder->setContentParam(self::APIKEY_KEY, self::APIKEY_VALUE);
    $request = $request_builder->build();
    parent::__construct($request);
  }

  protected abstract function genUrlSuffix(); 
}
