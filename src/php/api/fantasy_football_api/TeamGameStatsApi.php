<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class TeamGameStatsResultMode {

  const SUCCESSFUL_RESP = 0;
  const INVALID_RESP = 1;
}

class TeamGameStatsResultStruct {

  private

}

class ScoresByWeekApi extends FantasyFootballApi {

  const METHOD_NAME = "ScoresByWeek";

  const PRESEASON_WEEK_MIN = 0;
  const PRESEASON_WEEK_MAX = 4;
  const REGULAR_SEASON_WEEK_MIN = 1;
  const REGULAR_SEASON_WEEK_MAX = 17;
  const POST_SEASON_WEEK_MIN = 1;
  const POST_SEASON_WEEK_MAX = 4;


  private
    $weekNum,
    $yearNum,
    $seasonSuffix;

  public function __construct($week_num, $year_num, $season_suffix) {
    // Check valid week num
    if (!FantasyFootballAp::isValidWeekNum($week_num, $season_suffix)) {
      throw new Exception("invalid week-num/season-suffix combination");
    }

    $this->weekNum = $week_num;
    $this->yearNum = $year_num;
    $this->seasonSuffix = $season_suffix;    
    parent::__construct();
  }

  protected function validateAndCacheResponse($response) {
    
  }

  protected function genUrlSuffix() {
    $year_season_str = 
        FantasyFootballApi::genSeasonQueryString(
            $this->yearNum, $this->seasonSuffix);
    return self::METHOD_NAME . "/" . $year_season_str . "/" . $this->weekNum;
  }

}
