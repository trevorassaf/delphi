<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject");

class Season extends DelphiObject {
// -- CLASS CONSTANTS
  const SEASON_TABLE_NAME = "Seasons";
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

// -- INSTANCE VARS	
  private
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

  protected function initAuxillaryInstanceVars($params) {
    $this->teamId = $params[self::TEAMID_DB_KEY];	
    $this->wins = $params[self::WINS_DB_KEY];	
    $this->losses = $params[self::LOSSES_DB_KEY];	
    $this->ties = $params[self::TIES_DB_KEY];	
    $this->gamesPlayed = $params[self::GAMESPLAYED_DB_KEY];	
  }

  protected function getAuxillaryDbFields() {
    return array(
        self::TEAMID_DB_KEY => $this->teamId,
        self::WINS_DB_KEY => $this->wins,
        self::LOSSES_DB_KEY => $this->losses,
        self::TIES_DB_KEY => $this->ties,
        self::GAMESPLAYED_DB_KEY => $this->gamesPlayed,
    );
  } 

  // -- Getters
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
