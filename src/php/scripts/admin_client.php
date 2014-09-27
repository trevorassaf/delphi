<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/../access_layer/User.php");

// -- CONSTANTS
defined("OPERATION_KEY") ? null : define("OPERATION_KEY", "op");
defined("TABLE_KEY") ? null : define("TABLE_KEY", "table");
defined("PARAMS_KEY") ? null : define("PARAMS_KEY", "json_params");
defined("ENDPOINT_URL") 
  ? null 
  : define("ENDPOINT_URL", "http://organicdump.com/delphi/src/php/endpoints/admin_endpoints.php");

// Table fields
$USER_FIELDS = array(
  User::ID_DB_KEY,
  User::FBID_DB_KEY,
  User::USERNAM_DB_KEY,
  User::FIRSTNAME_DB_KEY,
  User::LASTNAME_DB_KEY,
  User::BIRTHDATE_DB_KEY,
  User::SEX_DB_KEY,
  User::BALANCE_DB_KEY,
  User::ISADMIN_DB_KEY);

// -- FUNCTIONS
function userSelectTable() {
  echo "-- Select table to modify: \n";
  echo "\t - Options: Users, Teams, Seasons, Games, Bets, UserBets, Friends\n";
  echo "\t - Table: ";
  $table_name = readline();
  echo "\n";
  return $table_name;
}

function userSelectParams($table_name, $col_names) {
  $params = array();
  foreach ($col_names as $col_name) {
    echo "\t - " . $col_name . ": ";
    $value = readline();
    if ($value !== '') {
      $params[$col_name] = urlencode($value);
    }
  }
}

function tableCreate($table_name) {
  echo "-- Create new record in table: " . $table_name . "\n";
  $params = null; 
  switch ($table_name) {
    case "Users":
      global $USER_FIELDS;
      $params = userSelectParams($table_name, $USER_FIELDS); 
      break;
    default:
      die("ERROR: bad table specified: " . $table_name);
      break;  
  }
  return $params;
}

function userSelectOperationType() {
  echo "-- Select operation to perform: \n";
  echo "\t - Options: create, read, update, delete\n";
  echo "\t - Operation: ";
  $operation_type = readline();
  echo "\n";
  return $operation_type;
}

function sendRequest($table_name, $operation, $params) {
  $json_params = json_encode($params);
  $fields_string = 
    TABLE_KEY . "=" . $table_name 
    . "&" . OPERATION_KEY . "=" . $operation_type 
    . "&" . PARAMS_KEY . "=" . $json_params;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, ENDPOINT_URL);
  curl_setopt($ch, CURLOPT_POST, 3);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  $result = curl_exec($ch);
  curl_close($ch);
}

while (1) {
  // Table name
  $table_name = userSelectTable();

  // Operation type
  $operation_type = userSelectOperationType();

  $params = null;
  switch ($operation_type) {
  case "create":
    $params = tableCreate($table_name);
    break;
  default:
    die("ERROR: invalid operaiton-type: " . $operation_type);
    break;  
  }

  // Send Request
  $result = sendRequest($table_name, $operation, $params);
}

