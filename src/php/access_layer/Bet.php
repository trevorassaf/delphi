<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/DelphiObject.php");

class Bet extends DelphiObject {
  
  // -- CLASS CONSTANTS
  const BET_TABLE_NAME = "Bets";
  const GAMEID_DB_KEY = "gameId";
  const TEAMID_DB_KEY = "teamId";
  const BETTINGUSERID_DB_KEY = "bettingUserId";
  const BETTINGUSERHANDICAP_DB_KEY = "bettingUserHandicap";
  const WAGER_DB_KEY = "wager";
  const CANCELLATIONPENALTY_DB_KEY = "cancellationPenalty";
  const STATUS_DB_KEY = "status";

  // -- CLASS VARS
  protected static $tableName = self::BET_TABLE_NAME;

// -- INSTANCE VARS	
  private
    $gameId,
    $teamId,
    $bettingUserId,
    $bettingUserHandicap,
    $wager,
    $cancellationPenalty,
    $status;

  public static function create(
      $gameId,
      $teamId,
      $bettingUserId,
      $bettingUserHandicap,
      $wager,
      $cancellationPenalty,
      $status) {
    return static::createObject(
      array(
        self::GAMEID_DB_KEY => $gameId,
        self::TEAMID_DB_KEY => $teamId,
        self::BETTINGUSERID_DB_KEY => $bettingUserId,
        self::BETTINGUSERHANDICAP_DB_KEY => $getBettingUserHandicap,
        self::wager => $wager,
        self::CANCELLATIONPENALTY_DB_KEY => $cancellationPenalty,
        self::STATUS_DB_KEY => $status,
      )
    ); 
  }

  protected function initInstanceVars($params) {
    $this->gameId = $params[self::GAMEID_DB_KEY];	
    $this->teamId = $params[self::TEAMID_DB_KEY];	
    $this->bettingUserId = $params[self::BETTINGUSERID_DB_KEY];	
    $this->bettingUserHandicap = $params[self::BETTINGUSERHANDICAP_DB_KEY];	
    $this->wager = $params[self::WAGER_DB_KEY];	
    $this->cancellationPenalty = $params[self::CANCELLATIONPENALTY_DB_KEY];	
    $this->status = $params[self::STATUS_DB_KEY];	
  }

  protected function getDbFields() {
    return array(
        self::GAMEID_DB_KEY => $this->gameId,
        self::TEAMID_DB_KEY => $this->teamId,
        self::BETTINGUSERID_DB_KEY => $this->bettingUserId,
        self::BETTINGUSERHANDICAP_DB_KEY => $this->bettingUserHandicap,
        self::WAGER_DB_KEY => $this->wager,
        self::CANCELLATIONPENALTY_DB_KEY => $this->cancellationPenalty,
        self::STATUS_DB_KEY => $this->status,
    );
  } 

  // -- Getters
  public  public function getGameId() { 
		return $this->gameId;
	}
  public function getTeamId() { 
		return $this->teamId;
	}
  public function getBettingUserId() { 
		return $this->bettingUserId;
	}
  public function getBettingUserHandicap() { 
		return $this->bettingUserHandicap;
	}
  public function getWager() { 
		return $this->wager;
	}
  public function getCancellationPenalty() { 
		return $this->cancellationPenalty;
	}
  public function getStatus() { 
		return $this->status;
	}
}
