<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/OperationType.php");
// Access layer
require_once(dirname(__FILE__)."/../../access_layer/User.php");
require_once(dirname(__FILE__)."/../../access_layer/Friend.php");
require_once(dirname(__FILE__)."/../../access_layer/Team.php");
require_once(dirname(__FILE__)."/../../access_layer/Season.php");
require_once(dirname(__FILE__)."/../../access_layer/Game.php");
require_once(dirname(__FILE__)."/../../access_layer/Bet.php");
require_once(dirname(__FILE__)."/../../access_layer/UserBet.php");

// -- CONSTANTS
defined("TABLE_KEY") ? null : define("TABLE_KEY", "table");
defined("OPERATION_KEY") ? null : define("OPERATION_KEY", "op");
defined("PARAMS_JSON_KEY") ? null : define("PARAMS_JSON_KEY", "json_params");

// -- FUNCTIONS

function tableCreate($table_name, $params) {
  $record = null;
  switch($table_name) {
    case User::$tableName:
      $record = User::createObject($params);
      break;
    case Team::$tableName:
      $record = Team::createObject($params);
      break;
    case Season::$tableName:
      $record = Season::createObject($params);
      break;
    case Game::$tableName:
      $record = Game::createObject($params);
      break;
    case Bet::$tableName:
      $record = Bet::createObject($params);
      break;
    case UserBet::$tableName:
      $record = UserBet::createObject($params);
      break;
    default:
      die("ERROR: bad table name in func:tableCreate()");
      break;
  } 

  var_dump($record);
}

function processRequestWithPostParams() {
  // Validate POST params
  if (!isset($_POST[TABLE_KEY])) {
    die("ERROR: set '" . TABLE_KEY . "' table key");
  } else if (!isset($_POST[OPERATION_KEY])) {
    die("ERROR: set '" . OPERATION_KEY . "' operation key"); 
  } else if (!isset($_POST[PARAMS_JSON_KEY])) {
    die("ERROR: set '" . PARAMS_JSON_KEY . "' params key");
  }

  // Capture vars
  $table_name = $_POST[TABLE_KEY];
  $operation_type = $_POST[OPERATION_KEY];
  $params = json_decode($_POST[PARAMS_JSON_KEY]); 

  switch ($op_type) {
    case OperationType::CREATE:
      tableCreate($table_name, $params);
      break;
    case OperationType::READ:
      tableRead($table_name, $params);
      break;
    case OperationType::UPDATE:
      tableUpdate($table_name, $params);
      break;
    case OperationType::DELETE:
      tableDelete($table_name, $params);
      break;  
    default:
      die("ERROR: bad op-type specified: " . $op_type);
      break;
  }
}

function main() {
  processRequestWithPostParams();
}
