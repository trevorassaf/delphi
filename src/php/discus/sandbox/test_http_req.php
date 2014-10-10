<?php

require_once(dirname(__FILE__)."/../http/GetRequest.php");

$api_key = "94134631-49C0-4079-A011-EC727A676638";
$week = 1;

$builder = new GetRequestBuilder();
$url = sprintf("http://api.nfldata.apiphany.com/trial/JSON/ScoresByWeek/2014REG/%s", $week);

$builder->setUrl($url);
$builder->setContentParam("key", $api_key);
$request = $builder->build();
$result = $request->execute();
var_dump($result);
