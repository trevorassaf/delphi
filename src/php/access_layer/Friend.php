<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject.php");
require_once(dirname(__FILE__)."/exceptions/DuplicateFriendRequestException.php");

class Friend extends DelphiObject {
// -- CLASS CONSTANTS
  const FRIEND_TABLE_NAME = "Friends";
  const REQUESTINGUSERID_DB_KEY = "requestingUserId";
  const APPROVINGUSERID_DB_KEY = "approvingUserId";

  // -- CLASS VARS
  protected static $tableName = FRIEND_TABLE_NAME;

// -- INSTANCE VARS	
  private
    $requestingUserId,
    $approvingUserId;

  public static function create($requestingUserId, $approvingUserId) {
    // Ensure Friend record does not already exist.
    $query = self::genCheckExistingFriendRecordQuery($requestingUserId, $approvingUserId);
    if (0 != static::$database->fetchArraysFromQuery($query)) {
      throw new DuplicateFriendRequestException($requestingUserId, $approvingUserId);
    }

    return static::createObject(
      array(
        self::REQUESTINGUSERID_DB_KEY => $requestingUserId,
        self::APPROVINGUSERID_DB_KEY => $approvingUserId,
      )
    );
  }
  
  private static function genCheckExistingFriendRecordQuery($requestingUserId, $approvingUserId) {
    return 
      "SELECT COUNT(*) FROM " . self::$tableName
      . " WHERE (" . self::REQUESTINGUSERID_DB_KEY . "=" . $this->requestingUserId 
      . " AND " . self::APPROVINGUSERID_DB_KEY . "=" . $this->approvingUserId
      . ") OR " . self::REQUESTINGUSERID_DB_KEY . "=" . $this->approvingUserId
      . " AND " . self::APPROVINGUSERID_DB_KEY . "=" . $this->requestingUserId;
  }


  public static function fetchFriends($userId) {
    // Fetch Friends from db
    $query = genFetchFriendsQuery($userId); 
    $friend_records = static::$database->fetchArraysFromQuery($query);

    // Deserialize Friend assocs
    $friends = array();
    foreach ($friend_records as $rec) {
      $friends[] = new static($rec);
    }
    return $friends;
  }

  private static function genFetchFriendsQuery($userId) {
    return
      "SELECT * FROM " . self::$tableName
      . " WHERE (" . self::REQUESTINGUSERID_DB_KEY . "=" . $userId . ") OR ("
      . self::APPROVINGUSERID_DB_KEY . "=" . $userId . ")";
  }

  public static function deleteFriends($userId) {
    // Delete Friends from db
    $query = genDeleteFriendsQuery($userId);     
    static::$database->query($query);
  }

  private static function genDeleteFriendsQuery($userId) {
    return 
      "DELETE * FROM " . self::$tableName
      . " WHERE " . self::REQUESTINGUSERID_DB_KEY . "=" . $userId 
      . " OR " . self::APPROVINGUSERID_DB_KEY . "=" . $userId;
  }

  protected function initAuxillaryInstanceVars($params) {
    $this->requestingUserId = $params[self::REQUESTINGUSERID_DB_KEY];	
    $this->approvingUserId = $params[self::APPROVINGUSERID_DB_KEY];	
  }

  protected function getAuxillaryDbFields() {
    return array(
        self::REQUESTINGUSERID_DB_KEY => $this->requestingUserId,
        self::APPROVINGUSERID_DB_KEY => $this->approvingUserId,
    );
  } 

  // -- Getters
  public function getRequestingUserId() { 
		return $this->requestingUserId;
	}
  public function getApprovingUserId() { 
		return $this->approvingUserId;
  }
}
