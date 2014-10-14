<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject.php");

class SeasonAdminInfo extends DelphiObject {

  // -- CLASS CONSTANTS
  const SEASON_ADMIN_INFO_TABLE_NAME = "SeasonAdminInfo";
  const CURRENT_WEEK_KEY = "current_week";
  const CURRENT_YEAR_KEY = "current_year";
  const SEASONKEY_KEY = "season_key";

  protected static $tableName = self::SEASON_ADMIN_INFO_TABLE_NAME;

  // -- INSTANCE VARS
  private
    $currentWeek,
    $currentYear,
    $seasonKey;

  public static function create(
      $currentWeek,
      $currentYear) {
    $fund_vars = parent::createFundamentalVars();
    $fund_vars[self::CURRENT_WEEK_KEY] = $currentWeek;
    $fund_vars[self::CURRENT_YEAR_KEY] = $currentYear;
    $fund_vars[self::SEASONKEY_KEY] = 
        FantasyFootballApi::genSeasonKey($currentWeek, $currentYear);
    return static::createObject($fund_vars);
  }

  public static function fetchMostRecentSeasonInfo() {
    $query = self::genFetchMostRecentSeasonInfoQuery();
    $result_array = static::$database->fetchArraysFromQuery($query);
    if (empty($result_array)) {
      return null;
    }

    return new static($result_array[0]);
  }

  private static function genFetchMostRecentSeasonInfoQuery() {
    return "
      SELECT * 
        FROM SeasonAdminInfo
        WHERE current_year =
          (SELECT MAX(current_year) FROM SeasonAdminInfo)
        ORDER BY current_week DESC
        LIMIT 1;";
  }

  private static function genSeasonKey($year, $week) {
    
  }

  protected function initAuxillaryInstanceVars($params) {
    $this->currentWeek = $params[self::CURRENT_WEEK_KEY];
    $this->currentYear = $params[self::CURRENT_YEAR_KEY];
    $this->seasonKey = $params[self::SEASONKEY_KEY];
  }

  protected function getAuxillaryDbFields() {
    return array(
      self::CURRENT_WEEK_KEY => $this->currentWeek,
      self::CURRENT_YEAR_KEY => $this->currentYear,
      self::SEASONKEY_KEY => $this->seasonKey,
    );
  }

  public function getCurrentWeek() {
    return $this->currentWeek;
  }

  public function getCurrentYear() {
    return $this->currentYear;
  }

  public function getSeasonKey() {
    return $this->seasonKey;
  }
}
