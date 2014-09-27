<?php
// -- DEPENDENCIES
require_once(dirname(__FILE__)."/P1DbObject.php");

// -- CONSTANTS
// Db table name
defined("ALBUM_TABLE_NAME") ? null : define("ALBUM_TABLE_NAME", "Album");
// Db keys
defined("ALBUM_ID_DB_KEY") ? null : define("ALBUM_ID_DB_KEY", "albumid");
defined("ALBUM_TITLE_DB_KEY") ? null : define("ALBUM_TITLE_DB_KEY", "title");
defined("ALBUM_CREATED_DB_KEY") ? null : define("ALBUM_CREATED_DB_KEY", "created");
defined("ALBUM_LAST_UPDATED_DB_KEY") ? null : define("ALBUM_LAST_UPDATED_DB_KEY", "lastupdated");
defined("ALBUM_USERNAME_DB_KEY") ? null : define("ALBUM_USERNAME_DB_KEY", "username");

class Album extends P1DbObject {
  // -- CLASS VARS
  protected static $tableName = ALBUM_TABLE_NAME;

  protected static $primaryKeys = array(ALBUM_ID_DB_KEY);

  // -- CONSTANTS
  const ID_KEY = ALBUM_ID_DB_KEY;
  const TITLE_KEY = ALBUM_TITLE_DB_KEY;
  const CREATED_KEY = ALBUM_CREATED_DB_KEY;
  const LAST_UPDATED_KEY = ALBUM_LAST_UPDATED_DB_KEY;
  const USERNAME_KEY = ALBUM_USERNAME_DB_KEY;

  // -- INSTANCE VARS
  private
    $albumId,
    $title,
    $created,
    $lastUpdated,
    $userName;

  public static function create(
      $title,
      $created,
      $lastUpdated,
      $userName) {
    return static::createObject(
      array(
        self::TITLE_KEY => $title,
        self::CREATED_KEY => $created,
        self::LAST_UPDATED_KEY => $lastUpdated,
        self::USERNAME_KEY => $userName,
      )
    ); 
  }

  /**
   * Fetch all albums owned by user specified by $username.
   *
   * @param username : username of user
   * @return array:Album
   */
  public static function fetchByUsername($username) {
    return static::getObjectsByParams(
      array(
        self::USERNAME_KEY => $username,
      )
    ); 
  }

  public static function fetchByAlbumId($album_id) {
    return static::getObjectByPrimaryKey(
      array(
        self::ID_KEY => $album_id,
      )
    );
  }

  // -- PROTECTED FUNCTIONS
  protected function initInstanceVars($params) {
    $this->albumId = $params[self::ID_KEY];
    $this->title = $params[self::TITLE_KEY];
    $this->created = $params[self::CREATED_KEY];
    $this->lastUpdated = $params[self::LAST_UPDATED_KEY];
    $this->userName = $params[self::USERNAME_KEY];
  }

  protected function getDbFields() {
    return array(
      self::ID_KEY => $this->albumId,
      self::TITLE_KEY => $this->title,
      self::CREATED_KEY => $this->created,
      self::LAST_UPDATED_KEY => $this->lastUpdated,
      self::USERNAME_KEY => $this->userName,
    );
  }

  protected function getPrimaryKeys() {
    return array(
      self::ID_KEY => $this->albumId,
    );
  }

  protected function createObjectCallback($init_params) {
    $album_id = mysql_insert_id();
    $init_params = $init_params[self::ID_KEY] = $album_id;
    return $init_params;
  }

  // -- PUBLIC FUNCTIONS
  // Getters
  public function getAlbumId() {
    return $this->albumId;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getCreated() {
    return $this->created;
  }

  public function getLastUpdated() {
    return $this->lastUpdated;
  }

  public function getUserName() {
    return $this->userName;
  }

  // Setters
  /**
   * Set lastUpdated time to new time.
   *
   * @param time : string formatted in sql's datetime style
   */
  public function setLastUpdated($time) {
    $this->lastUpdated = $time;
  }
}
