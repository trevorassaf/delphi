<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

class Team extends DatabaseObject {
// -- CLASS CONSTANTS
  const TEAM_TABLE_NAME = "Teams";
  const ID_DB_KEY = "id";
  const NAME_DB_KEY = "name";
  const CITY_DB_KEY = "city";
  const CITYABBREVIATION_DB_KEY = "cityAbbreviation";
  const STATE_DB_KEY = "state";

  // -- CLASS VARS
  protected static $tableName = self::TEAM_TABLE_NAME;

  protected static $uniqueKeys = array(self::ID_DB_KEY, self::NAME_DB_KEY);

// -- INSTANCE VARS	
  private
    $id,
    $name,
    $city,
    $cityAbbreviation,
    $state;

  public static function create(
      $name,
      $city,
      $cityAbbreviation,
      $state) {
    return static::createObject(
      array(
        self::NAME_DB_KEY => $name,
        self::CITY_DB_KEY => $city,
        self::CITYABBREVIATION_DB_KEY => $cityAbbreviation,
        self::STATE_DB_KEY => $state,
      )
    );
  }

  public static function fetchByName($name) {
    return static::getObjectByUniqueKey(self::NAME_DB_KEY, $name);
  }

  public static function fetchById($id) {
    return static::getObjectByUniqueKey(self::ID_DB_KEY, $id);
  }

  protected function getPrimaryKeys() {
    return array(self::ID_DB_KEY => $this->id);
  }

  protected function createObjectCallback($init_params) {
    $id = mysql_insert_id();
    $init_params[self::ID_DB_KEY] = $id;
    return $init_params;
  }

  protected function initInstanceVars($params) {
    $this->id = $params[self::ID_DB_KEY];	
    $this->name = $params[self::NAME_DB_KEY];	
    $this->city = $params[self::CITY_DB_KEY];	
    $this->cityAbbreviation = $params[self::CITYABBREVIATION_DB_KEY];	
    $this->state = $params[self::STATE_DB_KEY];	
  }

  protected function getDbFields() {
    return array(
        self::ID_DB_KEY => $this->id,
        self::NAME_DB_KEY => $this->name,
        self::CITY_DB_KEY => $this->city,
        self::CITYABBREVIATION_DB_KEY => $this->cityAbbreviation,
        self::STATE_DB_KEY => $this->state,
    );
  } 

  // -- Getters
  public function getId() { 
		return $this->id;
	}
  public function getName() { 
		return $this->name;
	}
  public function getCity() { 
		return $this->city;
	}
  public function getCityAbbreviation() { 
		return $this->cityAbbreviation;
	}
  public function getState() { 
		return $this->state;
	}
}
