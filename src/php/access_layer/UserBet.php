<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject.php");

class UserBet extends DelphiObject {
// -- CLASS CONSTANTS
  const USERBET_TABLE_NAME = "UserBets";
  const USERID_DB_KEY = "userId";
  const BETID_DB_KEY = "betId";

  // -- CLASS VARS
  protected static $tableName = self::USERBET_TABLE_NAME;

// -- INSTANCE VARS	
  private
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
  
  public static function fetchByBetId($betId) {
    return static::getObjectsByParams(
      array(
        self::BETID_DB_KEY => $betId,
      )
    );
  }

  protected function initAuxillaryInstanceVars($params) {
    $this->userId = $params[self::USERID_DB_KEY];	
    $this->betId = $params[self::BETID_DB_KEY];	
  }

  protected function getAuxillaryDbFields() {
    return array(
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
