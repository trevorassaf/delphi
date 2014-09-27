<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

class UserBet extends DatabaseObject {
// -- CLASS CONSTANTS
  const USERBET_TABLE_NAME = "UserBets";
  const USERID_DB_KEY = "userId";
  const BETID_DB_KEY = "betId";
  const ID_DB_KEY = "id";

  // -- CLASS VARS
  protected static $tableName = self::USERBET_TABLE_NAME;

  protected static $uniqueKeys = self::ID_DB_KEY;

// -- INSTANCE VARS	
  private
    $id,
    $userId,
    $betId;

  public static function create($userId, $betId) {
    return static::createObject(
      array(
        self::USERID_DB_KEY => $userId,
        self::BETID_DB_KEY => $betId,
      )
    );
  }
  
  public static function fetchById($id) {
    return static::getObjectByUniqueKey(self::ID_DB_KEY, $id);
  }

  public static function fetchByUserId($userId) {
    return static::getObjectsByParams(
      array(
        self::USERID_DB_KEY => $userId,
      )  
    );
  }

  public static function fetchByBetId($betId) {
    return static::getObjectsByParams(
      array(
        self::BETID_DB_KEY => $betId,
      )
    );
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
    $this->userId = $params[self::USERID_DB_KEY];	
    $this->betId = $params[self::BETID_DB_KEY];	
  }

  protected function getDbFields() {
    return array(
        self::ID_DB_KEY => $this->id,
        self::USERID_DB_KEY => $this->userId,
        self::BETID_DB_KEY => $this->betId,
    );
  } 

  // -- Getters
  public function getUserId() { 
		return $this->userId;
	}
  public function getBetId() { 
		return $this->betId;
	}
}
