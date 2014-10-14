<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

class SeasonAdminInfo extends DatabaseObject {

  // -- CLASS CONSTANTS
  const SEASON_ADMIN_INFO_TABLE_NAME = "SeasonAdminInfo";
  const ID_KEY = "id";
  const CURRENT_WEEK_KEY = "current_week";
  const CURRENT_YEAR_KEY = "current_year";
  const LAST_UPDATE_TIME_KEY = "last_update_time";

  const ID_VALUE = "0";

  protected static $tableName = self::SEASON_ADMIN_INFO_TABLE_NAME;

  protected static $uniqueKeys = array(self::ID_KEY);

  // -- INSTANCE VARS
  private
    $id,
    $currentWeek,
    $currentYear,
    $lastUpdatedTime;

  public static function create(
      $currentWeek,
      $currentYear) {
    return static::createObject(
      array(
        self::ID_KEY => self::ID_VALUE,
        self::CURRENT_WEEK => $current_week,
        self::CURRENT_YEAR => $current_year,
        self::LAST_UPDATE_TIME => self::genLastUpdatedTime(),
      )
    ); 
  }

  public static function fetch() {
    return static::getObjectByUniqueKeys(self::ID_KEY, self::ID_VALUE); 
  }

  private static function genLastUpdatedTime() {
    return date("Y-m-d H:i:s");
  }

  protected function getPrimaryKeys() {
    return array(self::ID_KEY, $this->id);
  }

  protected function initInstanceVars($params) {
    $this->id = $params[self::ID_KEY];
    $this->currentWeek = $params[self::CURRENT_WEEK_KEY];
    $this->currentYear = $params[self::CURRENT_YEAR_KEY];
    $this->lastUpdatedTime = $params[self::LAST_UPDATE_TIME_KEY];
  }

  protected function getDbFields() {
    return array(
      self::ID_KEY => $this->id,
      self::CURRENT_WEEK_KEY => $this->currentWeek,
      self::CURRENT_YEAR_KEY => $this->currentYear,
      self::LAST_UPDATE_TIME_KEY => $this->lastUpdatedTime,
    );
  }

  public function getId() {
    return $this->id;
  }

  public function getCurrentWeek() {
    return $this->currentWeek;
  }

  public function getCurrentYear() {
    return $this->currentYear;
  }

  public function getLastUpdatedTime() {
    return $this->lastUpdatedTime;
  }

  public function setCurrentWeek($current_week) {
    $this->currentWeek = $current_week;
  }

  public function setCurrentYear($current_year) {
    $this->currentYear = $current_year;
  } 

  public function save() {
    $this->lastUpdatedTime = self::genLastUpdatedTime();
    parent::save();
  }
}
