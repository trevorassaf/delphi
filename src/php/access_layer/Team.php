<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject.php");

class Team extends DelphiObject {
// -- CLASS CONSTANTS
  const TEAM_TABLE_NAME = "Teams";
  const NAME_DB_KEY = "name";
  const FULL_NAME_DB_KEY = "full_name";
  const CITY_DB_KEY = "city";
  const KEY_DB_KEY = "team_key";
  const DIVISION_DB_KEY = "division";
  const CONFERENCE_DB_KEY = "conference";
  const SEASON_DB_KEY = "season_key";

  // -- CLASS VARS
  protected static $tableName = self::TEAM_TABLE_NAME;

  protected static $uniqueKeys = array(
    DelphiObject::ID_KEY,
    self::NAME_DB_KEY,
    self::FULL_NAME_DB_KEY,
    self::KEY_DB_KEY,
  );

// -- INSTANCE VARS	
  private
    $name,
    $fullName,
    $city,
    $key,
    $division,
    $conference,
    $season;

  public static function create(
      $name,
      $fullName,
      $city,
      $key,
      $division,
      $conference,
      $season) {
    $create_vars = static::createFundamentalVars();  
    $create_vars[self::NAME_DB_KEY] = $name;
    $create_vars[self::FULL_NAME_DB_KEY] = $fullName;
    $create_vars[self::CITY_DB_KEY] = $city;
    $create_vars[self::KEY_DB_KEY] = $key;
    $create_vars[self::DIVISION_DB_KEY] = $division;
    $create_vars[self::CONFERENCE_DB_KEY] = $conference;
    $create_vars[self::SEASON_DB_KEY] = $season;
    return static::createObject($create_vars); 
  }

  protected function initAuxillaryInstanceVars($params) {
    $this->name = $params[self::NAME_DB_KEY];	
    $this->fullName = $params[self::FULL_NAME_DB_KEY];
    $this->city = $params[self::CITY_DB_KEY];	
    $this->key = $params[self::KEY_DB_KEY];
    $this->division = $params[self::DIVISION_DB_KEY];
    $this->conference = $params[self::CONFERENCE_DB_KEY];
    $this->season = $params[self::SEASON_DB_KEY];
  }

  protected function getAuxillaryDbFields() {
    return array(
      self::NAME_DB_KEY => $this->name,
      self::FULL_NAME_DB_KEY => $this->fullName,
      self::CITY_DB_KEY => $this->city,
      self::KEY_DB_KEY => $this->key,
      self::DIVISION_DB_KEY => $this->division,
      self::CONFERENCE_DB_KEY => $this->conference,
      self::SEASON_DB_KEY => $this->season,
    );
  } 

  // -- Getters
  public function getName() { 
		return $this->name;
	}

  public function getFullName() {
    return $this->fullName;
  }

  public function getCity() { 
		return $this->city;
	}

  public function getTeamKey() {
    return $this->key;
  }

  public function getDivision() {
    return $this->division;
  }

  public function getConference() {
    return $this->conference;
  }

  public function getSeasonKey() {
    return $this->season;
  }
}
