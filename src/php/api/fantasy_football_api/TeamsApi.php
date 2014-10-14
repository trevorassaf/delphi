<?php

// -- DEPENDENCIES
require_once(dirname(__FILE__)."/FantasyFootballApi.php");

abstract class TeamsResultMode {
  const INVALID_RESP = 0;
  const SUCCESSFUL_RESP = 1;
}

final class TeamsResult {

  const CITY = "City";
  const CONFERENCE = "Conference";
  const DIVISION = "Division";
  const FULL_NAME = "FullName";
  const KEY = "Key";
  const NAME = "Name";

  private
    $city,
    $conference,
    $division,
    $fullName,
    $key,
    $name;

  public static function createFromJsonString($json_str) {
    $result_array = json_decode($json_str, true);
    if ($result_array == null) {
      throw new Exception("invalid scores-by-week-result");
    }

    $result_struct_array = array();
    foreach ($result_array as $result) {
      $result_struct_array[] = self::createFromArray($result); 
    }

    return $result_struct_array;
  }

  public static function createFromArray($result_array) {
    return new self(
      $result_array[self::CITY],
      $result_array[self::CONFERENCE],
      $result_array[self::DIVISION],
      $result_array[self::FULL_NAME],
      $result_array[self::KEY],
      $result_array[self::NAME]
    );
  }

  private function __construct(
      $city,
      $conference,
      $division,
      $fullName,
      $key,
      $name) {
    $this->city = $city;
    $this->conference = $conference;
    $this->division = $division;
    $this->fullName = $fullName;
    $this->key = $key;
    $this->name = $name;
  }

  public function getCity() {
    return $this->city;
  }

  public function getConference() {
    return $this->conference;
  }

  public function getDivision() {
    return $this->division;
  }

  public function getFullName() {
    return $this->fullName;
  }

  public function getKey() {
    return $this->key;
  }

  public function getName() {
    return $this->name;
  }
}

class TeamsApi extends FantasyFootballApi {

  const METHOD_NAME = "Teams";

  private
    $seasonKey,
    $resultArray;

  public function __construct($seasonKey) {
    $this->seasonKey = $seasonKey;  
    parent::__construct();
  }

  protected function validateAndCacheResponse($response) {
    try {
      $this->resultArray = TeamsResult::createFromJsonString($response);
    } catch (Exception $e) {
      $this->resultMode = TeamsResultMode::INVALID_RESP;
      return false;
    } 

    $this->resultMode = TeamsResultMode::SUCCESSFUL_RESP;
    return true;
  }

  protected function genUrlSuffix() {
    return self::METHOD_NAME . "/" . $this->seasonKey;
  }

  public function getResultArray() {
    return $this->resultArray;
  }

  public function getSeasonKey() {
    return $this->seasonKey;
  }
}

