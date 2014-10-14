<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject.php");

abstract class GameStatus {

  const SCHEDULED = "scheduled"; 
  const COMPLETED = "completed";
  const IN_PROGRESS = "in_progress";
  const CANCELLED = "cancelled";
  const RESCHEDULED = "rescheduled";
}

class Game extends DelphiObject {
// -- CLASS CONSTANTS
  const GAME_TABLE_NAME = "Games";
  const DATE_DB_KEY = "date";
  const HOMETEAMID_DB_KEY = "homeTeamKey";
  const AWAYTEAMID_DB_KEY = "awayTeamKey";
  const HOMETEAMSCORE_DB_KEY = "homeTeamScore";
  const AWAYTEAMSCORE_DB_KEY = "awayTeamScore";
  const PERIOD_DB_KEY = "period";
  const STATUS_DB_KEY = "status";
  const GAMETIM_DB_KEY = "gameTime";
  const SEASONID_DB_KEY = "seasonKey";

  // -- CLASS VARS
  protected static $tableName = self::GAME_TABLE_NAME;

// -- INSTANCE VARS	
  private
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
    $create_vars = parent::createFundamentalVars();
    $create_vars[self::DATE_DB_KEY] = $date;
    $create_vars[self::HOMETEAMID_DB_KEY] = $homeTeamId;
    $create_vars[self::AWAYTEAMID_DB_KEY] = $awayTeamId;
    $create_vars[self::HOMETEAMSCORE_DB_KEY] = $homeTeamScore;
    $create_vars[self::AWAYTEAMSCORE_DB_KEY] = $awayTeamScore;
    $create_vars[self::PERIOD_DB_KEY] = $period;
    $create_vars[self::STATUS_DB_KEY] = $status;
    $create_vars[self::GAMETIM_DB_KEY] = $gameTime;
    $create_vars[self::SEASONID_DB_KEY] = $seasonId;

    return static::createObject($create_vars);
  }

  protected function initAuxillaryInstanceVars($params) {
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

  protected function getAuxillaryDbFields() {
    return array(
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
  public function getDate() { 
		return $this->date;
	}
  public function getHomeTeamKey() { 
		return $this->homeTeamId;
	}
  public function getAwayTeamKey() { 
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
  public function getSeasonKey() {
    return $this->seasonId;
  }
}
