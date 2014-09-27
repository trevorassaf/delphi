<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

class User extends DatabaseObject {
// -- CLASS CONSTANTS
  const USER_TABLE_NAME = "Users";
  const ID_DB_KEY = "id";
  const FBID_DB_KEY = "fbId";
  const USERNAM_DB_KEY = "username";
  const FIRSTNAME_DB_KEY = "firstName";
  const LASTNAME_DB_KEY = "lastName";
  const BIRTHDATE_DB_KEY = "birthdate";
  const SEX_DB_KEY = "sex";
  const BALANCE_DB_KEY = "balance";
  const ISADMIN_DB_KEY = "isAdmin";

  // -- CLASS VARS
  protected static $tableName = self::USER_TABLE_NAME;

  protected static $uniqueKeys = array(self::ID_DB_KEY, self::USERNAM_DB_KEY, self::FBID_DB_KEY);  

  // -- INSTANCE VARS	
  private
    $id,
    $fbId,
    $username,
    $firstName,
    $lastName,
    $birthdate,
    $sex,
    $balance,
    $isAdmin;

  public static function create(
      $fbId,
      $username,
      $firstName,
      $lastName,
      $birthdate,
      $sex,
      $balance,
      $isAdmin) {
    return static::createObject(
      array(
        self::FBID_DB_KEY => $fbId,
        self::USERNAM_DB_KEY => $username,
        self::FIRSTNAME_DB_KEY => $firstName,
        self::LASTNAME_DB_KEY => $lastName,
        self::BIRTHDATE_DB_KEY => $birthdate,
        self::SEX_DB_KEY => $sex,
        self::BALANCE_DB_KEY => $balance,
        self::ISADMIN_DB_KEY => $isAdmin,
      )
    );
  }

  public static function fetchById($id) {
    return static::getObjectByUniqueKey(self::ID_DB_KEY, $id);
  }

  public static function fetchByUsername($username) {
    return static::getObjectByUniqueKey(self::USERNAM_DB_KEY, $username);
  }

  public static function fetchByFbId($fbId) {
    return static::getObjectByUniqueKey(self::FBID_DB_KEY, $fbId);
  }

  protected function getPrimaryKeys() {
    return array(static::ID_DB_KEY => $this->id);
  }

  protected function initInstanceVars($params) {
    $this->id = $params[self::ID_DB_KEY];	
    $this->fbId = $params[self::FBID_DB_KEY];	
    $this->username = $params[self::USERNAM_DB_KEY];	
    $this->firstName = $params[self::FIRSTNAME_DB_KEY];	
    $this->lastName = $params[self::LASTNAME_DB_KEY];	
    $this->birthdate = $params[self::BIRTHDATE_DB_KEY];	
    $this->sex = $params[self::SEX_DB_KEY];	
    $this->balance = $params[self::BALANCE_DB_KEY];	
    $this->isAdmin = $params[self::ISADMIN_DB_KEY];	
  }

  protected function getDbFields() {
    return array(
        self::ID_DB_KEY => $this->id,
        self::FBID_DB_KEY => $this->fbId,
        self::USERNAM_DB_KEY => $this->username,
        self::FIRSTNAME_DB_KEY => $this->firstName,
        self::LASTNAME_DB_KEY => $this->lastName,
        self::BIRTHDATE_DB_KEY => $this->birthdate,
        self::SEX_DB_KEY => $this->sex,
        self::BALANCE_DB_KEY => $this->balance,
        self::ISADMIN_DB_KEY => $this->isAdmin,
    );
  } 

  protected function createObjectCallback($init_params) {
    $id = mysql_insert_id();
    $init_params[self::ID_DB_KEY] = $id;
    return $init_params;
  }

  // -- Getters
  public function getId() { 
		return $this->id;
	}
  public function getFbId() { 
		return $this->fbId;
	}
  public function getUsername() { 
		return $this->username;
	}
  public function getFirstName() { 
		return $this->firstName;
	}
  public function getLastName() { 
		return $this->lastName;
	}
  public function getBirthdate() { 
		return $this->birthdate;
	}
  public function getSex() { 
		return $this->sex;
	}
  public function getBalance() { 
		return $this->balance;
	}
  public function getIsAdmin() { 
		return $this->isAdmin;
  }

  // -- Setters
  public function enableAdminPriviliges() {
    $this->isAdmin = true;
  }

  public function revokeAdminPriviliges() {
    $this->isAdmin = false;
  }
}
