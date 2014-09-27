<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

class Season extends DatabaseObject {
// -- CLASS CONSTANTS
  const SEASON_TABLE_NAME = "Seasons";
  const ID_DB_KEY = "id";
  const TEAMID_DB_KEY = "teamId";
  const WINS_DB_KEY = "wins";
  const LOSSES_DB_KEY = "losses";
  const TIES_DB_KEY = "ties";
  const GAMESPLAYED_DB_KEY = "gamesPlayed";

  // Default valus
  const WINS_DEFAULT_VALUE = 0;
  const LOSSES_DEFAULT_VALUE = 0;
  const TIES_DEFAULT_VALUE = 0;
  const GAMES_PLAYED_DEFAULT_VALUE = 0;

  // -- CLASS VARS
  protected static $tableName = self::SEASON_TABLE_NAME;

  protected static $uniqueKeys = array(self::ID_DB_KEY);

// -- INSTANCE VARS	
  private
    $id,
    $teamId,
    $wins,
    $losses,
    $ties,
    $gamesPlayed,

  public static function createDefault($teamId) {
    return static::createObject(
      self::TEAMID_DB_KEY => $teamId,
      self::WINS_DB_KEY => self::WINS_DEFAULT_VALUE,
      self::LOSSES_DB_KEY => self::LOSSES_DEFAULT_VALUE,
      self::TIES_DB_KEY => self::TIES_DEFAULT_VALUE,
      self::GAMESPLAYED_DB_KEY => self::GAMES_PLAYED_DEFAULT_VALUE,
    );  
  }  

  public static function create(
      $teamId,
      $wins,
      $losses,
      $ties,
      $gamesPlayed) {
    return static::createObject(
      array(
        self::TEAMID_DB_KEY => $teamId,
        self::WINS_DB_KEY => $wins,
        self::LOSSES_DB_KEY => $losses,
        self::TIES_DB_KEY => $ties,
        self::GAMESPLAYED_DB_KEY => $gamesPlayed,
      )
    );
  }

  public static function fetchByTeamId($id) {
    return static::getObjectByUniqueKeys(self::ID_DB_KEY, $id);
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
    $this->teamId = $params[self::TEAMID_DB_KEY];	
    $this->wins = $params[self::WINS_DB_KEY];	
    $this->losses = $params[self::LOSSES_DB_KEY];	
    $this->ties = $params[self::TIES_DB_KEY];	
    $this->gamesPlayed = $params[self::GAMESPLAYED_DB_KEY];	
  }

  protected function getDbFields() {
    return array(
        self::ID_DB_KEY => $this->id,
        self::TEAMID_DB_KEY => $this->teamId,
        self::WINS_DB_KEY => $this->wins,
        self::LOSSES_DB_KEY => $this->losses,
        self::TIES_DB_KEY => $this->ties,
        self::GAMESPLAYED_DB_KEY => $this->gamesPlayed,
    );
  } 

  // -- Getters
  public function getId() { 
		return $this->id;
	}
  public function getTeamId() { 
		return $this->teamId;
	}
  public function getWins() { 
		return $this->wins;
	}
  public function getLosses() { 
		return $this->losses;
	}
  public function getTies() { 
		return $this->ties;
	}
  public function getGamesPlayed() { 
		return $this->gamesPlayed;
	}
}
