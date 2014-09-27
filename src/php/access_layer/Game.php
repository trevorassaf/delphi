<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/warehouse/DatabaseObject.php");

class Game extends DatabaseObject {
// -- CLASS CONSTANTS
  const GAME_TABLE_NAME = "Games";
  const ID_DB_KEY = "id";
  const DATE_DB_KEY = "date";
  const HOMETEAMID_DB_KEY = "homeTeamId";
  const AWAYTEAMID_DB_KEY = "awayTeamId";
  const HOMETEAMSCORE_DB_KEY = "homeTeamScore";
  const AWAYTEAMSCORE_DB_KEY = "awayTeamScore";
  const PERIOD_DB_KEY = "period";
  const STATUS_DB_KEY = "status";
  const GAMETIM_DB_KEY = "gameTime";
  const SEASONID_DB_KEY = "seasonId";

  // -- CLASS VARS
  protected static $tableName = self::GAME_TABLE_NAME;

  protected static $uniqueKeys = array(self::ID_DB_KEY, self::SEASONID_DB_KEY);

// -- INSTANCE VARS	
  private
    $id,
    $date,
    $homeTeamId,
    $awayTeamId,
    $homeTeamScore,
    $awayTeamScore,
    $period,
    $status,
    $gameTime,
    $seasonId;

  public static function create(
      $date,
      $homeTeamId,
      $awayTeamId,
      $homeTeamScore,
      $awayTeamScore,
      $period,
      $status,
      $gameTime,
      $seasonId) {
    return static::createObject(
      array(
        self::DATE_DB_KEY => $date,
        self::HOMETEAMID_DB_KEY => $homeTeamId,
        self::AWAYTEAMID_DB_KEY => $awayTeamId,
        self::HOMETEAMSCORE_DB_KEY => $homeTeamScore,
        self::AWAYTEAMSCORE_DB_KEY => $awayTeamScore,
        self::PERIOD_DB_KEY => $period,
        self::STATUS_DB_KEY => $status,
        self::GAMETIM_DB_KEY => $gameTime,
        self::SEASONID_DB_KEY => $seasonId,
      )
    );    
  }

  public static function fetchById($id) {
    return static::getObjectByUniqueKey(self::ID_DB_KEY, $id);
  }

  public static function genSqlTime() {
    return date('Y-m-d G:s:i');
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
    $this->date = $params[self::DATE_DB_KEY];	
    $this->homeTeamId = $params[self::HOMETEAMID_DB_KEY];	
    $this->awayTeamId = $params[self::AWAYTEAMID_DB_KEY];	
    $this->homeTeamScore = $params[self::HOMETEAMSCORE_DB_KEY];	
    $this->awayTeamScore = $params[self::AWAYTEAMSCORE_DB_KEY];	
    $this->period = $params[self::PERIOD_DB_KEY];	
    $this->status = $params[self::STATUS_DB_KEY];	
    $this->gameTime = $params[self::GAMETIM_DB_KEY];	
    $this->seasonId = $params[self::SEASONID_DB_KEY];
  }

  protected function getDbFields() {
    return array(
        self::ID_DB_KEY => $this->id,
        self::DATE_DB_KEY => $this->date,
        self::HOMETEAMID_DB_KEY => $this->homeTeamId,
        self::AWAYTEAMID_DB_KEY => $this->awayTeamId,
        self::HOMETEAMSCORE_DB_KEY => $this->homeTeamScore,
        self::AWAYTEAMSCORE_DB_KEY => $this->awayTeamScore,
        self::PERIOD_DB_KEY => $this->period,
        self::STATUS_DB_KEY => $this->status,
        self::GAMETIM_DB_KEY => $this->gameTime,
        self::SEASONID_DB_KEY => $this->seasonId,
    );
  } 

  // -- Getters
  public function getId() { 
		return $this->id;
	}
  public function getDate() { 
		return $this->date;
	}
  public function getHomeTeamId() { 
		return $this->homeTeamId;
	}
  public function getAwayTeamId() { 
		return $this->awayTeamId;
	}
  public function getHomeTeamScore() { 
		return $this->homeTeamScore;
	}
  public function getAwayTeamScore() { 
		return $this->awayTeamScore;
	}
  public function getPeriod() { 
		return $this->period;
	}
  public function getStatus() { 
		return $this->status;
	}
  public function getGameTim() { 
		return $this->gameTime;
  }
  public function getSeasonId() {
    return $this->seasonId;
  }
}
