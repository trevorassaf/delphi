<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

abstract class DelphiObject extends DatabaseObject {

  // Db keys
  const ID_KEY = "id";
  const CREATED_TIME = "created_time";
  const LAST_UPDATED_TIME = "last_updated_time";

  protected static $uniqueKeys = array(self::ID_KEY);

  private
    $id,
    $createdTime,
    $lastUpdatedTime;

  protected static function createFundamentalVars() {
    $datetime = self::genDateTime();
    return array(
      self::CREATED_TIME => $datetime,
      self::LAST_UPDATED_TIME => $datetime,
    );
  }

  public static function fetchById($id) {
    return static::getObjectByUniqueKey(self::ID_KEY, $id);
  }

  public static function genDateTime() {
    return date("Y-m-d H:i:s");
  }

  protected abstract function initAuxillaryInstanceVars($params);
  protected abstract function getAuxillaryDbFields();

  protected function createObjectCallback($init_params) {
    $id = mysql_insert_id();
    $init_params[self::ID_KEY] = $id;
    return $init_params;
  }

  protected function getPrimaryKeys() {
    return array(self::ID_KEY => $this->id);
  }

  protected function initInstanceVars($params) {
    $this->id = $params[self::ID_KEY];
    $this->createdTime = $params[self::CREATED_TIME];
    $this->lastUpdatedTime = $params[self::LAST_UPDATED_TIME];

    $this->initAuxillaryInstanceVars($params);
  }

  protected function getDbFields() {
    $fields = $this->getAuxillaryDbFields();
    $fields[self::ID_KEY] = $this->id;
    $fields[self::CREATED_TIME] = $this->createdTime;
    $fields[self::LAST_UPDATED_TIME] = $this->lastUpdatedTime;
    return $fields;
  }

  public function save() {
    $this->lastUpdatedTime = self::genDateTime();
    parent::save();
  }
  
  public function getId() {
    return $this->id;
  }

  public function getCreatedTime() {
    return $this->createdTime;
  }

  public function getLastUpdatedTime() {
    return $this->lastUpdatedTime;
  }
}
